<?php

namespace App\Services;

use App\Models\Site;
use App\Models\SiteSummary;
use Carbon\Carbon;

class SiteSummaryService
{
    protected $timeframes = [
        'latest' => 0,
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
                if ($timeFrame == "latest") {
                    // Fetch the latest sensor data entry
                    $latestSensorData = $site->data()->latest('timestamp')->first();
                    if (!$latestSensorData)
                        continue;

                    $latestTimestamp = $latestSensorData->timestamp;
                    $avgPower = $latestSensorData->P1 + $latestSensorData->P2 + $latestSensorData->P3;
                    $totalEnergy = $latestSensorData->E1 + $latestSensorData->E2 + $latestSensorData->E3;

                    // Create or update summary for the latest timeframe
                    SiteSummary::updateOrCreate(
                        [
                            'site_id' => $site->id,
                            'time_frame' => 'latest',
                        ],
                        [
                            'power' => $avgPower,
                            'energy' => $totalEnergy,
                            'min_power' => 0,
                            'max_power' => 0,
                            'min_energy' => 0,
                            'max_energy' => 0,
                            'start_time' => $latestTimestamp,
                            'end_time' => $latestTimestamp,
                        ]
                    );
                } else {
                    $startTime = $endTime->copy()->subHours($hours);

                    // Fetch sensor data within the specified timeframe
                    $sensorData = $site->data()
                        ->whereBetween('timestamp', [$startTime, $endTime])
                        ->get();

                    if ($sensorData->isEmpty())
                        continue;

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

    public function getLatestSummary($siteId, $jsonResponse = true)
    {
        $summary = SiteSummary::where('site_id', $siteId)
            ->where('time_frame', 'latest')
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($summary) {
            $summary->updated_at_r = $summary->updated_at->diffForHumans();
        }

        return $jsonResponse ? response()->json($summary) : $summary;
    }
}
