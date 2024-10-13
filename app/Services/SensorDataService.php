<?php

namespace App\Services;

use App\Models\SensorData;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SensorDataService
{
    public function fetchSensorData(Request $request, int $entityId, string $entityType = 'factory', bool $json = true): array|JsonResponse
    {
        $sensorData = [];

        $sensors = $this->getSensors($request, $entityId, $entityType);

        foreach ($sensors as $sensor) {
            $sensorData[] = [
                'timestamp' => $sensor->timestamp,
                'power' => round($sensor->P1 + $sensor->P2 + $sensor->P3, 2),
                'energy' => round($sensor->E1 + $sensor->E2 + $sensor->E3, 8),
                'factory_id' => $sensor->data_file->site->factory->id ?? null,
                'site_id' => $sensor->data_file->site->id ?? null,
            ];
        }

        return $json ? response()->json($sensorData) : $sensorData;
    }

    public function fetchEnergyData(Request $request, int $entityId, string $entityType = 'factory', bool $json = true): array|JsonResponse
    {
        $sensorData = [];

        $sensors = $this->getSensors($request, $entityId, $entityType);

        $timeFrame = $request->get('startDate', '1d');

        $groupedData = match ($timeFrame) {
            '1d' => $sensors->groupBy(fn($sensor) => Carbon::parse($sensor->timestamp)->format('Y-m-d H:00:00')),
            '1w' => $sensors->groupBy(fn($sensor) => Carbon::parse($sensor->timestamp)->startOfWeek()->format('Y-m-d')),
            '1m' => $sensors->groupBy(fn($sensor) => Carbon::parse($sensor->timestamp)->format('Y-m-d')),
            '1y' => $sensors->groupBy(fn($sensor) => Carbon::parse($sensor->timestamp)->format('Y-m')),
            default => $sensors->groupBy(fn($sensor) => Carbon::parse($sensor->timestamp)->format('Y-m-d')),
        };

        foreach ($groupedData as $interval => $group) {
            $totalEnergy = $group->sum(fn($sensor) => $sensor->E1 + $sensor->E2 + $sensor->E3);

            $sensorData[] = [
                'timestamp' => $interval,
                'energy' => round($totalEnergy, 8),
                'site_id' => $group->first()->data_file->site->id ?? null,
                'factory_id' => $group->first()->data_file->site->factory->id ?? null,
            ];
        }

        return $json ? response()->json($sensorData) : $sensorData;
    }

    private function getSensors(Request $request, $entityId, $entityType)
    {
        $startDate = $request->get('startDate', '1d');
        $endDate = $request->get('endDate');

        return SensorData::when($entityType === 'site', function ($query) use ($entityId) {
            $query->whereHas('data_file.site', function ($query) use ($entityId) {
                $query->where('id', $entityId);
            });
        }, function ($query) use ($entityId) {
            $query->whereHas('data_file.site.factory', function ($query) use ($entityId) {
                $query->where('id', $entityId);
            });
        })
            ->when($endDate === null && $startDate !== 'all', function ($query) use ($startDate) {
                $query->where('timestamp', '>=', mapTimeframe($startDate));
            })
            ->when($endDate !== null, function ($query) use ($startDate, $endDate) {
                $startDate = Carbon::createFromFormat('d/m/y', $startDate)->format('Y-m-d 00:00:00');
                $endDate = Carbon::createFromFormat('d/m/y', $endDate)->format('Y-m-d 23:59:59');
                $query->whereBetween('timestamp', [$startDate, $endDate]);
            })
            ->with('data_file.site.factory')
            ->get();
    }

    public function fetchDataForReport(string $type, int $entityId, $startDate, $endDate)
    {
        if ($type === 'site') {
            $relation = 'data_file.site';
            $entity = 'site';
        } else {
            $relation = 'data_file.site.factory';
            $entity = 'factory';
        }

        $lastNDays = convertToLastNDays($startDate, $endDate);
        $days = $lastNDays['days'];

        if ($days === 1) {
            $groupBy = "DATE_FORMAT(timestamp, '%Y-%m-%d %H:00:00')";
        } elseif ($days > 1 && $days <= 30) {
            $groupBy = "DATE_FORMAT(timestamp, '%Y-%m-%d')";
        } elseif ($days > 30 && $days <= 90) {
            $groupBy = "WEEK(timestamp)";
        } elseif ($days > 90 && $days <= 365) {
            $groupBy = "DATE_FORMAT(timestamp, '%Y-%m')";
        } else {
            $groupBy = "YEAR(timestamp)";
        }

        return SensorData::with($relation)
            ->whereHas($relation, function ($query) use ($entity, $entityId) {
                $foreignKey = $entity . '_id';
                $query->where($foreignKey, $entityId);
            })
            ->whereBetween('timestamp', [$startDate, $endDate])
            ->selectRaw("
        ROUND(SUM(P1 + P2 + P3), 2) as total_power,
        ROUND(SUM(E1 + E2 + E3), 2) as total_energy,
        MAX(timestamp) as timestamp,
        $groupBy as time_bucket")
            ->groupBy('time_bucket')
            ->orderBy('timestamp')
            ->get();
    }

}
