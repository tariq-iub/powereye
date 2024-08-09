<?php

namespace App\Helpers;

use App\Models\Site;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Helpers
{
    public static function getTimeFrame(Request $request): Carbon
    {
        $timeframe = $request->input('timeframe', '1');

        if ($timeframe === 'all') {
            $start = Carbon::createFromDate(0);
        } else {
            $start = Carbon::now()->subDays((int)$timeframe);
        }

        return $start;
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

    public static function getSitesData(Carbon $start, string ...$cols): Collection
    {
        return Site::with(['data_file.data' => function ($query) use ($start, $cols) {
            $query->select(...$cols)
                ->where('timestamp', '>=', $start);
        }])->get();
    }

    public static function getSitesAggregatedData(Request $request, array $columns, array $aggColumns, string $type, string $returnType = 'json'): JsonResponse|array
    {
        $start = self::getTimeFrame($request);
        $sites = self::getSitesData($start, ...$columns);

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
//        dd($sitesAggregated);
        if ($returnType === 'json') return response()->json($sitesAggregated);
        else return $sitesAggregated;
    }


    public static function getSitesPower(Request $request, string $returnType='json'): JsonResponse | array
    {
        return self::getSitesAggregatedData($request, ['data_file_id', 'P1', 'P2', 'P3', 'timestamp'], ['P1', 'P2', 'P3'], 'power', $returnType);
    }

    public static function getSitesEnergy(Request $request, string $returnType='json'): JsonResponse | array
    {
        return self::getSitesAggregatedData($request, ['data_file_id', 'E1', 'E2', 'E3', 'timestamp'], ['E1', 'E2', 'E3'], 'energy', $returnType);
    }


}
