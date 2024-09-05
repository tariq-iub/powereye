<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\FactoryUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FactoryService
{
    protected SiteService $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
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

                $site->totalPower = $siteTotalPower;
                $site->totalEnergy = $siteTotalEnergy;

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
}
