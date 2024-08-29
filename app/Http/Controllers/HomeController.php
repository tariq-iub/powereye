<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\SensorData;
use App\Models\Site;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            if (in_array(Auth::user()->role->id, [1, 2])) {
                return view('dashboard.admin');
            } else {
                $userID = Auth::id();
                $factories = $this->loadFactories($request, $userID);
                $timeframeOptions = $this->getTimeframeOption();
                return view('dashboard.client', compact('factories', 'timeframeOptions'));
            }
        } else {
            redirect()->route('login');
        }
    }

    public function fetchSensorData(Request $request, int $factoryId, string $timeframe = '24hr', bool $json = true): JsonResponse|array
    {
        $sensorData = [];

        $startDate = $this->mapTimeframe($timeframe);

        $sensors = SensorData::whereHas('data_file.site.factory', function ($query) use ($factoryId) {
            $query->where('id', $factoryId);
        })
            ->when($timeframe !== 'all', function ($query) use ($startDate) {
                $query->where('timestamp', '>=', $startDate);
            })
            ->with('data_file.site.factory')
            ->get();

        foreach ($sensors as $sensor) {
            $p = $sensor->P1 + $sensor->P2 + $sensor->P3;
            $e = $sensor->E1 + $sensor->E2 + $sensor->E3;

            $sensorData[] = [
                'timestamp' => $sensor->timestamp,
                'power' => $p,
                'energy' => $e,
                'site_id' => $sensor->data_file->site->id,
                'factory_id' => $sensor->data_file->site->factory->id,
            ];
        }

        return $json ? response()->json($sensorData) : $sensorData;
    }

    public function loadFactories(Request $request, int $userID): Collection|array
    {
        $factories = Factory::with('sites.data_file.data')->get();

        foreach ($factories as $factory) {
            $factoryTotalPower = $this->getFactoryData($request, $factory->id, 'power', false);
            $factoryTotalEnergy = $this->getFactoryData($request, $factory->id, 'energy', false, 8);

            $powerData = [];
            $energyData = [];
            $siteNames = [];
            $sitePowers = [];
            $siteEnergies = [];

            foreach ($factory->sites as $site) {
                $siteTotalPower = $this->getSiteData($request, $site->id, 'power', false);
                $siteTotalEnergy = $this->getSiteData($request, $site->id, 'energy', false, 5);

                $site->totalPower = $siteTotalPower;
                $site->totalEnergy = $siteTotalEnergy;

                if ($siteTotalPower > 0 && $siteTotalEnergy > 0) {
                    $powerData[] = $siteTotalPower;
                    $energyData[] = $siteTotalEnergy;
                    $siteNames[] = $site->title;
                    $sitePowers[] = $siteTotalPower;
                    $siteEnergies[] = $siteTotalEnergy;
                }
            }

            $factory->totalPower = $factoryTotalPower;
            $factory->totalEnergy = $factoryTotalEnergy;

            $factory->chartData = [
                'dates' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                'powers' => $powerData,
                'energyBreakdown' => array_map(function ($name, $energy) {
                    return ['value' => $energy, 'name' => $name];
                }, $siteNames, $siteEnergies),
                'siteNames' => $siteNames,
                'sitePowers' => $sitePowers,
            ];
        }

        return $factories;
    }

    public function getFactoryData(Request $request, int $factoryID, string $type, bool $json = true, int $precisionVal = 2): array|float|JsonResponse
    {
        return $this->fetchData(Factory::class, $factoryID, $type, $request, $json, $precisionVal);
    }

    public function getSiteData(Request $request, int $siteID, string $type, bool $json = true, int $precisionVal = 2): array|float|JsonResponse
    {
        return $this->fetchData(Site::class, $siteID, $type, $request, $json, $precisionVal);
    }

    private function mapTimeframe(string $timeframe) {
        $currentDate = Carbon::now();
        $startDate = clone $currentDate;

        return match (strtolower($timeframe)) {
            '1d' => $startDate->subDay(),
            '1w' => $startDate->subWeek(),
            '1m' => $startDate->subMonth(),
            '1y' => $startDate->subYear(),
            'all' => $currentDate->copy()->subDays(0),
            default => $startDate->subHours(24),
        };
    }

    private function getTimeframeOption(): array {
        return [
            'Last 24 hours' => '1d',
            'Last 7 Days' => '1w',
            'Last 30 Days' => '1m',
            'Last 12 Months' => '1y',
            'All Time' => 'all',
        ];
    }

    private function fetchData(string $model, int $id, string $type, Request $request, bool $json = true, int $precisionVal = 2): array|float|JsonResponse
    {
        $relation = ($model === Site::class) ? 'data_file.data' : 'sites.data_file.data';

        $validTypes = ['power', 'energy'];
        if (!in_array($type, $validTypes)) {
            $errorResponse = ['error' => 'Invalid type provided'];
            return $json ? response()->json($errorResponse, 400) : $errorResponse;
        }

        $columns = $type === 'power' ? ['P1', 'P2', 'P3'] : ['E1', 'E2', 'E3'];
        $precision = $request->has('precision') ? $request->get('precision') : $precisionVal;

        try {
            if (!class_exists($model)) {
                $errorResponse = ['error' => 'Invalid model class'];
                return $json ? response()->json($errorResponse, 500) : $errorResponse;
            }

            $entity = $model::with([
                $relation => function ($query) use ($columns) {
                    $query->select(array_merge($columns, ['data_file_id']));
                }
            ])->find($id);

            if (!$entity) {
                $errorResponse = ['error' => 'Entity not found'];
                return $json ? response()->json($errorResponse, 404) : $errorResponse;
            }

            $totalValue = 0;

            if ($model === Factory::class) {
                $totalValue = $entity->sites->flatMap(function ($site) {
                    return $site->data_file->flatMap(function ($dataFile) {
                        return $dataFile->data;
                    });
                })->sum(function ($data) use ($columns) {
                    return array_sum(array_map(fn($col) => $data->$col, $columns));
                });
            } elseif ($model === Site::class) {
                $totalValue = $entity->data_file->flatMap(function ($dataFile) {
                    return $dataFile->data;
                })->sum(function ($data) use ($columns) {
                    return array_sum(array_map(fn($col) => $data->$col, $columns));
                });
            }

            $result = round($totalValue, $precision);

            return $json ? response()->json($result) : $result;
        } catch (\Exception $e) {
            \Log::error('Data processing error: ' . $e->getMessage());
            $errorResponse = ['error' => 'Data processing error'];
            return $json ? response()->json($errorResponse, 500) : $errorResponse;
        }
    }
}

