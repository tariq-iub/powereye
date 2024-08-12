<?php

namespace App\Helpers;

use App\Models\Site;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Helpers
{
    public static function getTimeFrame(Request $request): array
    {
        $timeframe = $request->input('timeframe', '1');

        if ($timeframe === 'all') {
            $start = Carbon::createFromDate(0);
        } else {
            $start = Carbon::now()->subDays((int)$timeframe);
        }

        $start = Carbon::createFromDate(0);

        $end = Carbon::now();

        return [$start, $end];
    }

    public static function getStartTime(Request $request): Carbon
    {
        return self::getTimeFrame($request)[0];
    }

    public static function getTimeFrameOptions(): array
    {
        return [
            '1 Day' => '1',
            '3 Days' => '3',
            '7 Days' => '7',
            '30 Days' => '30',
            '90 Days' => '90',
            '1 Year' => '365',
            'All' => 'all'
        ];
    }

    public static function getSitesData(Request $request, string ...$cols): Collection
    {
        $start = self::getStartTime($request);
        return Site::with(['data_file.data' => function ($query) use ($start, $cols) {
            $query->select(...$cols)
                ->where('timestamp', '>=', $start);
        }])->get();
    }

    public static function getSitesAggregatedData(Request $request, array $columns, array $aggColumns, string $type, bool $json=true): JsonResponse|array
    {
        $sites = self::getSitesData($request, ...$columns);

        $sitesAggregated = [];

        foreach ($sites as $site) {
            $totals = array_fill_keys($aggColumns, 0);
            $siteTitle = $site->title;

            foreach ($site->data_file as $dataFile) {
                foreach ($dataFile->data as $data) {
                    foreach ($aggColumns as $aggCol) {
                        $totals[$aggCol] += $data->$aggCol ?? 0;
                    }
                }
            }

            $total = array_sum($totals);

            if ($total > 0) {
                $sitesAggregated[] = array_merge(['title' => $siteTitle], $totals, [$type => $total]);
            }
        }
        return  $json ? response()->json($sitesAggregated) : $sitesAggregated;
    }


    public static function getSitesPower(Request $request, bool $json=true): JsonResponse | array
    {
        return self::getSitesAggregatedData($request, ['data_file_id', 'P1', 'P2', 'P3', 'timestamp'], ['P1', 'P2', 'P3'], 'power', $json);
    }

    public static function getSitesEnergy(Request $request, bool $json): JsonResponse | array
    {
        return self::getSitesAggregatedData($request, ['data_file_id', 'E1', 'E2', 'E3', 'timestamp'], ['E1', 'E2', 'E3'], 'energy', $json);
    }


    public static function getFactoryData(Request $request, int $factoryID, string $dataType='power', bool $json=true): JsonResponse|Collection
    {
        list($startDate, $endDate) = Helpers::getTimeFrame($request);

        $sum = $dataType === 'power' ? 'sensor_data.P1 + sensor_data.P2 + sensor_data.P3' : 'sensor_data.E1 + sensor_data.E2 + sensor_data.E3';
        $alias = $dataType === 'power' ? 'total_power' : 'total_energy';

        $data = DB::table('sensor_data')
            ->join('data_files', 'sensor_data.data_file_id', '=', 'data_files.id')
            ->join('sites', 'data_files.site_id', '=', 'sites.id')
            ->join('factories', 'sites.factory_id', '=', 'factories.id')
            ->select(
//                DB::raw("DATE_FORMAT(sensor_data.timestamp, '%Y-%m-%d %H:%i:00') as time_interval"),
                DB::raw("DATE_FORMAT(sensor_data.timestamp, '%Y-%m-%d %H:%i:00') as time"),
                DB::raw("SUM($sum) as $alias")
            )
            ->whereBetween('sensor_data.timestamp', [$startDate, $endDate])
            ->groupBy('time')
            ->orderBy('time')
            ->get();

        return $json ? response()->json($data) : $data;
    }

    public static function getFactoryPower(Request $request, int $factoryID, bool $json=true): JsonResponse|Collection
    {
        return self::getFactoryData($request, $factoryID, 'power', $json);
    }

    public static function getFactoryEnergy(Request $request, int $factoryID, bool $json=true): JsonResponse|Collection
    {
        return self::getFactoryData($request, $factoryID, 'energy', $json);
    }

}
