<?php

namespace App\Services;

use App\Models\SensorData;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SensorDataService
{
    public function fetchSensorData(int $factoryId, string $timeframe = '24hr', bool $json = true): array|JsonResponse
    {
        $sensorData = [];
        $startDate = mapTimeframe($timeframe);

        $sensors = SensorData::whereHas('data_file.site.factory', function ($query) use ($factoryId) {
            $query->where('id', $factoryId);
        })
            ->when($timeframe !== 'all', function ($query) use ($startDate) {
                $query->where('timestamp', '>=', $startDate);
            })
            ->with('data_file.site.factory')
            ->get();

        $groupedData = $sensors->groupBy(function ($sensor) {
            return Carbon::parse($sensor->timestamp)->format('Y-m-d H:00:00');
        });

        foreach ($groupedData as $hour => $group) {
            $totalEnergy = $group->sum(function ($sensor) {
                return $sensor->E1 + $sensor->E2 + $sensor->E3;
            });

            foreach ($group as $sensor) {
                $sensorData[] = [
                    'timestamp' => $sensor->timestamp,
                    'energy_timestamp' => $hour,
                    'power' => round($sensor->P1 + $sensor->P2 + $sensor->P3, 2),
                    'energy' => round($totalEnergy, 8),
                    'factory_id' => $factoryId,
                ];
            }
        }

        return $json ? response()->json($sensorData) : $sensorData;
    }
}
