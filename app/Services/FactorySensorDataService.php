<?php

namespace App\Services;

use App\Models\SensorDataWindowedFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FactorySensorDataService
{
    public function fetch(Request $request, int $id, bool $jsonResponse = true)
    {
        $timerange = $request->get('timerange', '1h');
        $startDate = mapTimeframe($timerange);
        $endDate = Carbon::now();

        $timeframeColumn = match ($timerange) {
            '1h' => 'hour',
            '1d' => 'hour',
            '1w' => 'day',
            '1m' => 'week',
            default => 'hour'
        };

        $sensorData = SensorDataWindowedFactory::where('factory_id', $id)
            ->whereBetween('window_start', [$startDate, $endDate])
            ->where('timeframe', $timeframeColumn)
            ->orderBy('window_start', 'ASC')
            ->get();

        $formattedData = $sensorData->map(function ($data) use ($timerange) {
            $timeFormat = match ($timerange) {
                '1h' => 'H:i',
                '1d' => 'H:i d',
                '1w' => 'd l',
                '1m' => 'M d, Y',
                default => 'H:i'
            };

            return [
                'timestamp' => $data->window_end->setTimezone('UTC')->format($timeFormat),
                'total_power' => $data->P1 + $data->P2 + $data->P3,
                'total_energy' => $data->E1 + $data->E2 + $data->E3,
            ];
        });

        return $jsonResponse ? response()->json($formattedData) : $formattedData;
    }
}
