<?php

use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

if (!function_exists('mapTimeframe')) {
    function mapTimeframe(string $timeframe)
    {
        $currentDate = Carbon::now();
        $startDate = clone $currentDate;

        return match (strtolower($timeframe)) {
            '1h' => $startDate->subHour(),
            '6h' => $startDate->subHours(6),
            '8h' => $startDate->subHours(8),
            '12h' => $startDate->subHours(12),
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
    function getTimeframeOption(): array
    {
        return [
            'Last Hour' => '1h',
            // 'Last 6 hours' => '6h',
            // 'Last 12 hours' => '12h',
            'Last day' => '1d',
            'Last week' => '1w',
            'Last month' => '1m',
            // 'Last 12 Months' => '1y',
            // 'All Time' => 'all',
        ];
    }
}

if (!function_exists('getTimeRange')) {
    function getTimeRange(string $startDate, string|null $endDate = null): array
    {
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

if (!function_exists('getAuthFactories')) {
    function getAuthFactories($relation = 'sites.summaries'): Collection
    {
        return auth()->user()->factories()->with($relation)->get();
    }
}

if (!function_exists('getAuthSites')) {
    function getAuthSites($relation = 'summaries')
    {
        return auth()->user()->factories()
            ->with([
                'sites' => function ($query) use ($relation) {
                    $query->with($relation);
                }
            ])
            ->get()
            ->pluck('sites')
            ->flatten();
    }
}

if (!function_exists('isAuthFactory')) {
    function isAuthFactory(int $factoryId): bool
    {
        return auth()->user()->factories()
            ->where('id', $factoryId)
            ->exists();
    }
}

if (!function_exists('isAuthSite')) {
    function isAuthSite(int $siteId): bool
    {
        return getAuthSites()
            ->where('id', $siteId)
            ->isNotEmpty();
    }
}

if (!function_exists('convertToLastNDays')) {
    function convertToLastNDays($startDate, $endDate): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $differenceInDays = $start->diffInDays($end);

        $relativeString = $differenceInDays == 1 ? "last 1 day" : "last {$differenceInDays} days";

        return [
            'relativeString' => $relativeString,
            'days' => $differenceInDays
        ];
    }
}

if (!function_exists('findAuthSite')) {
    function findAuthSite(int $siteId): Site
    {
        $sites = getAuthSites();
        return $sites->firstWhere('id', $siteId);
    }
}

if (!function_exists('getRelativeTime')) {
    function getRelativeTime(Carbon $date = null): string
    {
        if ($date === null) {
            return 'N/A';
        }

        return $date->diffForHumans();
    }
}
