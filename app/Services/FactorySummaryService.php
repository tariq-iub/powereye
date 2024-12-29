<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\FactorySummary;
use Carbon\Carbon;

class FactorySummaryService
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

    public function calculateAndSaveFactorySummary()
    {
        foreach (Factory::all() as $factory) {
            $endTime = Carbon::now();

            foreach ($this->timeframes as $timeFrame => $hours) {
                if ($timeFrame === 'latest') {
                    $totalPower = 0;
                    $totalEnergy = 0;
                    $latestTimestamp = null;

                    foreach ($factory->sites as $site) {
                        // Fetch the latest sensor data entry for each site
                        $latestSensorData = $site->data()->latest('timestamp')->first();
                        if (!$latestSensorData)
                            continue;

                        $latestTimestamp = $latestTimestamp
                            ? max($latestTimestamp, $latestSensorData->timestamp)
                            : $latestSensorData->timestamp;

                        // Sum power and energy values
                        $totalPower += $latestSensorData->P1 + $latestSensorData->P2 + $latestSensorData->P3;
                        $totalEnergy += $latestSensorData->E1 + $latestSensorData->E2 + $latestSensorData->E3;
                    }

                    // Skip if no latest data was found for any site
                    if (!$latestTimestamp)
                        continue;

                    // Create or update the "latest" summary record for the factory
                    FactorySummary::updateOrCreate(
                        [
                            'factory_id' => $factory->id,
                            'time_frame' => 'latest',
                        ],
                        [
                            'power' => $totalPower,
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

                    $totalPower = 0;
                    $totalEnergy = 0;
                    $totalEntries = 0;
                    $minPower = null;
                    $maxPower = null;
                    $minEnergy = null;
                    $maxEnergy = null;

                    foreach ($factory->sites as $site) {
                        // Fetch sensor data for each site within the specified timeframe
                        $sensorData = $site->data()
                            ->whereBetween('timestamp', [$startTime, $endTime])
                            ->get();

                        if ($sensorData->isEmpty())
                            continue;

                        // Calculate total power for all entries by summing P1, P2, and P3, then add to factory totals
                        $siteTotalEntries = $sensorData->count();
                        $siteAvgPower = $sensorData->sum(function ($data) {
                            return $data->P1 + $data->P2 + $data->P3;
                        });

                        // Add to overall totals for the factory
                        $totalPower += $siteAvgPower;
                        $totalEntries += $siteTotalEntries;

                        // Calculate total energy for the site by summing E1, E2, and E3
                        $siteTotalEnergy = $sensorData->sum(function ($data) {
                            return $data->E1 + $data->E2 + $data->E3;
                        });
                        $totalEnergy += $siteTotalEnergy;

                        // Calculate min and max power values for this site
                        $siteMinPower = $sensorData->min(function ($data) {
                            return $data->P1 + $data->P2 + $data->P3;
                        });
                        $siteMaxPower = $sensorData->max(function ($data) {
                            return $data->P1 + $data->P2 + $data->P3;
                        });

                        // Calculate min and max energy values for this site
                        $siteMinEnergy = $sensorData->min(function ($data) {
                            return $data->E1 + $data->E2 + $data->E3;
                        });
                        $siteMaxEnergy = $sensorData->max(function ($data) {
                            return $data->E1 + $data->E2 + $data->E3;
                        });

                        // Update min/max power and energy for the factory as we iterate through sites
                        $minPower = $minPower === null ? $siteMinPower : min($minPower, $siteMinPower);
                        $maxPower = $maxPower === null ? $siteMaxPower : max($maxPower, $siteMaxPower);
                        $minEnergy = $minEnergy === null ? $siteMinEnergy : min($minEnergy, $siteMinEnergy);
                        $maxEnergy = $maxEnergy === null ? $siteMaxEnergy : max($maxEnergy, $siteMaxEnergy);
                    }

                    if ($totalEntries == 0)
                        continue; // Skip if no data was found

                    // Calculate average power across all sites for the factory
                    $avgPower = $totalPower / $totalEntries;

                    // Check if a summary record for this factory and timeframe already exists
                    $existingSummary = FactorySummary::where('factory_id', $factory->id)
                        ->where('time_frame', $timeFrame)
                        ->where('start_time', $startTime)
                        ->where('end_time', $endTime)
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
                        FactorySummary::create([
                            'factory_id' => $factory->id,
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

    public function getLatestSummary($factoryId, $jsonResponse = true)
    {
        return $this->getSummary($factoryId, 'latest', $jsonResponse);
    }

    public function getSummary($factoryId, $timeframe, $jsonResponse = true)
    {
        $summary = FactorySummary::where('factory_id', $factoryId)
            ->where('time_frame', $timeframe)
            ->orderBy('updated_at', 'desc')
            ->first();

        if ($summary) {
            $summary->updated_at_r = $summary->updated_at->diffForHumans();
        }

        return $jsonResponse ? response()->json($summary) : $summary;
    }

    public function getSummaries($factoryId, $jsonResponse = true)
    {
        $summaries = FactorySummary::where('factory_id', $factoryId)
            ->orderBy('updated_at', 'desc')
            ->get();

        if ($summaries->isNotEmpty()) {
            foreach ($summaries as $summary) {
                $summary->updated_at_r = $summary->updated_at->diffForHumans();
            }
        }

        return $jsonResponse ? response()->json($summaries) : $summaries;
    }
}
