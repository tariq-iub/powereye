<?php

namespace App\Helpers;

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

    public static function getSitesPower()
    {

    }

}
