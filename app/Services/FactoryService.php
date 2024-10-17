<?php

namespace App\Services;

use App\Models\Factory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FactoryService
{
    protected SiteService $siteService;
    protected SensorDataService $sensorDataService;

    public function __construct(SiteService $siteService, SensorDataService $sensorDataService)
    {
        $this->siteService = $siteService;
        $this->sensorDataService = $sensorDataService;
    }

    public function load(Request $request, int $userID): Collection|array
    {
        $factories = Factory::whereHas('users', function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })->with('sites.data_file.data')->get();

        foreach ($factories as $factory) {
            $factoryTotalPower = $this->fetchData($request, $factory->id, 'power', false);
            $factoryTotalEnergy = $this->fetchData($request, $factory->id, 'energy', false, 8);

            $siteNames = [];
            $siteEnergies = [];

            foreach ($factory->sites as $site) {
                $siteTotalPower = $this->siteService->fetchData($request, $site->id, 'power', 'all', false);
                $siteTotalEnergy = $this->siteService->fetchData($request, $site->id, 'energy', 'all', false, 5);

                $site->totalPower = $siteTotalPower['total'];
                $site->totalEnergy = $siteTotalEnergy['total'];
                $site->timestamp = Carbon::parse($siteTotalEnergy['latest_timestamp'])->diffForHumans();

                if ($siteTotalPower > 0 && $siteTotalEnergy > 0) {
                    $siteNames[] = $site->title;
                    $siteEnergies[] = $siteTotalEnergy;
                }
            }

            $factory->totalPower = $factoryTotalPower;
            $factory->totalEnergy = $factoryTotalEnergy;

            $factory->chartData = [
                'energyBreakdown' => array_map(function ($name, $energy) {
                    return ['value' => $energy, 'name' => $name];
                }, $siteNames, $siteEnergies),
            ];
        }

        return $factories;
    }

    public function fetchData(Request $request, int $factoryId, string $type, bool $json = true, int $precisionVal = 2): array|float|JsonResponse
    {
        $validationResult = validateAndPrepareData($type, $request, $precisionVal);
        if ($validationResult instanceof JsonResponse) {
            return $validationResult;
        }

        $columns = $validationResult['columns'];
        $precision = $validationResult['precision'];

        try {
            $factory = Factory::with([
                'sites.data_file.data' => function ($query) use ($columns) {
                    $query->select(array_merge($columns, ['data_file_id']));
                }
            ])->find($factoryId);

            if (!$factory) {
                $errorResponse = ['error' => 'Factory not found'];
                return $json ? response()->json($errorResponse, 404) : $errorResponse;
            }

            $totalValue = $factory->sites->flatMap(function ($site) {
                return $site->data_file->flatMap(function ($dataFile) {
                    return $dataFile->data;
                });
            })->sum(function ($data) use ($columns) {
                return array_sum(array_map(fn($col) => $data->$col, $columns));
            });

            $result = round($totalValue, $precision);

            return $json ? response()->json($result) : $result;
        } catch (\Exception $e) {
            \Log::error('Factory data processing error: ' . $e->getMessage());
            $errorResponse = ['error' => 'Data processing error'];
            return $json ? response()->json($errorResponse, 500) : $errorResponse;
        }
    }

    public function energyDistributionBySite(Request $request, Factory $factory)
    {
        $siteNames = [];
        $siteEnergies = [];

        foreach ($factory->sites as $site) {
            $siteTotalPower = $this->siteService->fetchData($request, $site->id, 'power', 'all', false);
            $siteTotalEnergy = $this->siteService->fetchData($request, $site->id, 'energy', 'all', false, 5);

            $site->totalPower = $siteTotalPower;
            $site->totalEnergy = $siteTotalEnergy;

            if ($siteTotalPower > 0 && $siteTotalEnergy > 0) {
                $siteNames[] = $site->title;
                $siteEnergies[] = $siteTotalEnergy;
            }
        }

        $data = [
            'distribution' => array_map(function ($name, $energy) {
                return ['value' => $energy, 'name' => $name];
            }, $siteNames, $siteEnergies),
        ];

        return $data;
    }

    public function fetchFactoryData(Request $request, Factory $factory)
    {
        $totalPower = $this->fetchData($request, $factory->id, 'power', false);
        $totalEnergy = $this->fetchData($request, $factory->id, 'energy', false, 8);
        $sensorData = $this->sensorDataService->fetchSensorData($request, $factory->id, 'factory', false);
        $energyData = $this->sensorDataService->fetchEnergyData($request, $factory->id, 'factory', false);

        $siteData = $factory->sites->map(function ($site) use ($request) {
            $sitePower = $this->siteService->fetchData($request, $site->id, 'power', 'all', false);
            $siteEnergy = $this->siteService->fetchData($request, $site->id, 'energy', 'all', false, 5);
            return [
                'siteId' => $site->id,
                'siteName' => $site->title,
                'totalPower' => $sitePower,
                'totalEnergy' => $siteEnergy,
            ];
        });

        $factoryMetrics = [
            'totalPower' => $totalPower,
            'totalEnergy' => $totalEnergy,
            'sites' => $siteData,
            'sensorData' => $sensorData,
            'energyData' => $energyData,
            'energyBreakdown' => $this->energyDistributionBySite($request, $factory),
        ];

        return response()->json([
            'factory' => $factory,
            'factoryMetrics' => $factoryMetrics,
        ]);
    }
}
