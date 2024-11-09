<?php

namespace App\Services;

use App\Models\Site;
use App\Models\SiteSummary;
use Carbon\Carbon;

class SiteSummaryService
{
    protected $timeframes = [
        '1-hour' => 1,
        '3-hours' => 3,
        '6-hours' => 6,
        '12-hours' => 12,
        '1-day' => 24,
        '3-days' => 72,
        '1-week' => 168,
        '1-month' => 720, // Approximation for a 30-day month
    ];

    public function calculateAndSaveSiteSummary()
    {
        foreach (Site::all() as $site) {
            $endTime = Carbon::now();

            foreach ($this->timeframes as $timeFrame => $hours) {
                $startTime = $endTime->copy()->subHours($hours);

                // Fetch sensor data within the specified timeframe
                $sensorData = $site->data()
                    ->whereBetween('timestamp', [$startTime, $endTime])
                    ->get();

                if ($sensorData->isEmpty()) continue;

                // Calculate average power for all entries by summing P1, P2, and P3, then averaging
                $totalPowerEntries = $sensorData->count();
                $avgPower = $sensorData->sum(function ($data) {
                        return $data->P1 + $data->P2 + $data->P3;
                    }) / $totalPowerEntries;

                // Calculate min and max power values as the sum of P1, P2, and P3
                $minPower = $sensorData->min(function ($data) {
                    return $data->P1 + $data->P2 + $data->P3;
                });

                $maxPower = $sensorData->max(function ($data) {
                    return $data->P1 + $data->P2 + $data->P3;
                });

                // Calculate total energy by summing E1, E2, and E3 for each entry
                $totalEnergy = $sensorData->sum(function ($data) {
                    return $data->E1 + $data->E2 + $data->E3;
                });

                // Calculate min and max energy values
                $minEnergy = $sensorData->min(function ($data) {
                    return $data->E1 + $data->E2 + $data->E3;
                });

                $maxEnergy = $sensorData->max(function ($data) {
                    return $data->E1 + $data->E2 + $data->E3;
                });

                // Check if a summary record for this site and timeframe already exists
                $existingSummary = SiteSummary::where('site_id', $site->id)
                    ->where('time_frame', $timeFrame)
                    ->first();

                // If exists, update; if not, create a new record
                if ($existingSummary) {
                    $existingSummary->update([
                        'power' => $avgPower,
                        'energy' => $totalEnergy,
                        'min_power' => $minPower,
                        'max_power' => $maxPower,
                        'min_energy' => $minEnergy,
                        'max_energy' => $maxEnergy,
                    ]);
                } else {
                    SiteSummary::create([
                        'site_id' => $site->id,
                        'time_frame' => $timeFrame,
                        'power' => $avgPower,
                        'energy' => $totalEnergy,
                        'min_power' => $minPower,
                        'max_power' => $maxPower,
                        'min_energy' => $minEnergy,
                        'max_energy' => $maxEnergy,
                        'start_time' => $startTime,
                        'end_time' => $endTime,
                    ]);
                }
            }
        }
    }
}
