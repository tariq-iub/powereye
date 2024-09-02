<?php

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

if (!function_exists('mapTimeframe')) {
    function mapTimeframe(string $timeframe) {
        $currentDate = Carbon::now();
        $startDate = clone $currentDate;

        return match (strtolower($timeframe)) {
            '8h' => $startDate->subHours(8),
            '1d' => $startDate->subDay(),
            '1w' => $startDate->subWeek(),
            '1m' => $startDate->subMonth(),
            '1y' => $startDate->subYear(),
            'all' => $currentDate->copy()->subDays(0),
            default => $startDate->subHours(24),
        };
    }
}

if (!function_exists('getTimeframeOptions')) {
    function getTimeframeOption(): array {
        return [
            'Last 24 hours' => '1d',
            'Last 7 Days' => '1w',
            'Last 30 Days' => '1m',
            'Last 12 Months' => '1y',
            'All Time' => 'all',
        ];
    }
}

if (!function_exists('getTimeRange')) {
    function getTimeRange(string $startDate, string|null $endDate = null): array {
        if ($endDate === null) {
            $timeframe = $startDate;

            $timeframe = mapTimeframe($timeframe);

            return [$timeframe, null];
        }

        $startDate = Carbon::createFromFormat('d/m/y', $startDate);
        $endDate = Carbon::createFromFormat('d/m/y', $endDate);

        return [$startDate, $endDate];
    }
}


if (!function_exists('validateAndPrepareData')) {
    function validateAndPrepareData(string $type, Request $request, int $precisionVal): array|JsonResponse
    {
        $validTypes = ['power', 'energy'];
        if (!in_array($type, $validTypes)) {
            return response()->json(['error' => 'Invalid type provided'], 400);
        }

        $columns = $type === 'power' ? ['P1', 'P2', 'P3'] : ['E1', 'E2', 'E3'];
        $precision = $request->has('precision') ? $request->get('precision') : $precisionVal;

        return compact('columns', 'precision');
    }
}
