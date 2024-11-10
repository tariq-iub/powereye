<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\SensorData;
use App\Models\SensorDataWindowedFactory;
use Illuminate\Support\Facades\DB;

class SensorDataWindowedFactoryService
{
    public function aggregateSensorDataForFactories()
    {
        $timeframes = ['hour', 'day', 'week', 'month'];

        foreach ($timeframes as $timeframe) {
            $this->aggregateFactoryData($timeframe);
        }
    }

    private function aggregateFactoryData($timeframe)
    {
        $factories = Factory::all();

        foreach ($factories as $factory) {
            // Get aggregated data per site within the factory for each unique timeframe window
            $siteAggregatedData = [];

            foreach ($factory->sites as $site) {
                $aggregatedData = $this->getAggregatedData($site->id, $timeframe);

                foreach ($aggregatedData as $data) {
                    // Calculate window start and end using the helper functions
                    $windowStart = $this->getWindowStart($data->window_start, $timeframe);
                    $windowEnd = $this->getWindowEnd($data->window_end, $timeframe);

                    // Use window start as a unique key for each timeframe window
                    $windowKey = $windowStart;

                    if (!isset($siteAggregatedData[$windowKey])) {
                        $siteAggregatedData[$windowKey] = [
                            'P1' => 0,
                            'P2' => 0,
                            'P3' => 0,
                            'E1' => 0,
                            'E2' => 0,
                            'E3' => 0,
                            'window_start' => $windowStart,
                            'window_end' => $windowEnd,
                        ];
                    }

                    // Sum data for the same timeframe window across sites
                    $siteAggregatedData[$windowKey]['P1'] += $data->P1;
                    $siteAggregatedData[$windowKey]['P2'] += $data->P2;
                    $siteAggregatedData[$windowKey]['P3'] += $data->P3;
                    $siteAggregatedData[$windowKey]['E1'] += $data->E1;
                    $siteAggregatedData[$windowKey]['E2'] += $data->E2;
                    $siteAggregatedData[$windowKey]['E3'] += $data->E3;
                }
            }

            // Insert aggregated data for each unique timeframe window
            foreach ($siteAggregatedData as $windowKey => $summedData) {
                $this->insertAggregatedDataForFactory($factory, $timeframe, $summedData);
            }
        }
    }

    private function getAggregatedData($siteId, $timeframe)
    {
        $groupBy = $this->getGroupByClause($timeframe);

        return SensorData::whereHas('data_file', function ($query) use ($siteId) {
            $query->where('site_id', $siteId);
        })
            ->select(
                DB::raw("AVG(P1) as P1"),
                DB::raw("AVG(P2) as P2"),
                DB::raw("AVG(P3) as P3"),
                DB::raw("AVG(E1) as E1"),
                DB::raw("AVG(E2) as E2"),
                DB::raw("AVG(E3) as E3"),
                DB::raw("MIN(timestamp) as window_start"),
                DB::raw("MAX(timestamp) as window_end")
            )
            ->groupBy(DB::raw($groupBy))
            ->get();
    }

    private function insertAggregatedDataForFactory($factory, $timeframe, $summedData)
    {
        // Check if the data already exists in the windowed data table before inserting
        $existingData = SensorDataWindowedFactory::where('factory_id', $factory->id)
            ->where('timeframe', $timeframe)
            ->where('window_start', $summedData['window_start'])
            ->where('window_end', $summedData['window_end'])
            ->first();

        if (!$existingData) {
            SensorDataWindowedFactory::create([
                'factory_id' => $factory->id,
                'timeframe' => $timeframe,
                'window_start' => $summedData['window_start'],
                'window_end' => $summedData['window_end'],
                'P1' => $summedData['P1'],
                'P2' => $summedData['P2'],
                'P3' => $summedData['P3'],
                'E1' => $summedData['E1'],
                'E2' => $summedData['E2'],
                'E3' => $summedData['E3'],
            ]);
        }
    }

    private function getGroupByClause($timeframe)
    {
        switch ($timeframe) {
            case 'hour':
                return 'DATE_FORMAT(timestamp, "%Y-%m-%d %H:00:00")';
            case 'day':
                return 'DATE(timestamp)';
            case 'week':
                return 'YEARWEEK(timestamp, 1)';
            case 'month':
                return 'DATE_FORMAT(timestamp, "%Y-%m-01 00:00:00")';
            default:
                return 'DATE(timestamp)';
        }
    }

    private function getWindowStart($timestamp, $timeframe)
    {
        switch ($timeframe) {
            case 'hour':
                return date('Y-m-d H:00:00', strtotime($timestamp));
            case 'day':
                return date('Y-m-d 00:00:00', strtotime($timestamp));
            case 'week':
                // Get the first day (Monday) of the week
                return date('Y-m-d 00:00:00', strtotime('monday this week', strtotime($timestamp)));
            case 'month':
                // Get the first day of the month
                return date('Y-m-01 00:00:00', strtotime($timestamp));
            default:
                return $timestamp;
        }
    }

    private function getWindowEnd($timestamp, $timeframe)
    {
        switch ($timeframe) {
            case 'hour':
                return date('Y-m-d H:59:59', strtotime($timestamp));
            case 'day':
                return date('Y-m-d 23:59:59', strtotime($timestamp));
            case 'week':
                // Get the last day (Sunday) of the week
                return date('Y-m-d 23:59:59', strtotime('sunday this week', strtotime($timestamp)));
            case 'month':
                // Get the last day of the month
                return date('Y-m-t 23:59:59', strtotime($timestamp));
            default:
                return $timestamp;
        }
    }
}
