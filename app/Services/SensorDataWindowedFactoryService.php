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
                    // Use window start as a unique key for each timeframe window
                    $windowKey = $data->window_start;

                    if (!isset($siteAggregatedData[$windowKey])) {
                        $siteAggregatedData[$windowKey] = [
                            'P1' => 0,
                            'P2' => 0,
                            'P3' => 0,
                            'E1' => 0,
                            'E2' => 0,
                            'E3' => 0,
                            'window_start' => $data->window_start,
                            'window_end' => $data->window_end,
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
}

//namespace App\Services;
//
//use App\Models\Factory;
//use App\Models\SensorData;
//use App\Models\SensorDataWindowedFactory;
//use Illuminate\Support\Facades\DB;
//
//class SensorDataWindowedFactoryService
//{
//    protected $aggregatedFactoryData = [];
//
//    public function aggregateSensorDataForFactories()
//    {
//        // Define the timeframes you want to aggregate data for
//        $timeframes = ['hour', 'day', 'week', 'month'];
//
//        foreach ($timeframes as $timeframe) {
//            $this->aggregateFactoryData($timeframe);
//        }
//    }
//
//    private function aggregateFactoryData($timeframe)
//    {
//        $factories = Factory::all();
//
//        foreach ($factories as $factory) {
//            foreach ($factory->sites as $site) {
//                $aggregatedData = $this->getAggregatedData($site->id, $timeframe);
//                $this->sumAggregatedData($aggregatedData, $factory, $timeframe);
//            }
//
//            $this->insertAggregatedDataForFactory($factory, $timeframe);
//        }
//    }
//
//    private function getAggregatedData($siteId, $timeframe)
//    {
//        $groupBy = $this->getGroupByClause($timeframe);
//
//        return SensorData::whereHas('data_file', function ($query) use ($siteId) {
//            $query->where('site_id', $siteId);
//        })
//            ->select(
//                DB::raw("AVG(P1) as P1"),
//                DB::raw("AVG(P2) as P2"),
//                DB::raw("AVG(P3) as P3"),
//                DB::raw("AVG(E1) as E1"),
//                DB::raw("AVG(E2) as E2"),
//                DB::raw("AVG(E3) as E3"),
//                DB::raw("MIN(timestamp) as window_start"),
//                DB::raw("MAX(timestamp) as window_end")
//            )
//            ->groupBy(DB::raw($groupBy))
//            ->get();
//    }
//
//    private function getGroupByClause($timeframe)
//    {
//        // Based on the timeframe, create the appropriate `group by` clause
//        switch ($timeframe) {
//            case 'hour':
//                return 'DATE_FORMAT(timestamp, "%Y-%m-%d %H:00:00")';
//            case 'day':
//                return 'DATE(timestamp)';
//            case 'week':
//                return 'YEARWEEK(timestamp, 1)';  // First day of the week based on ISO-8601
//            case 'month':
//                return 'DATE_FORMAT(timestamp, "%Y-%m-01 00:00:00")';
//            default:
//                return 'DATE(timestamp)';
//        }
//    }
//
//    private function sumAggregatedData($aggregatedData, $factory, $timeframe)
//    {
//        $summedData = [
//            'P1' => 0,
//            'P2' => 0,
//            'P3' => 0,
//            'E1' => 0,
//            'E2' => 0,
//            'E3' => 0,
//            'window_start' => null,
//            'window_end' => null,
//        ];
//
//        foreach ($aggregatedData as $data) {
//            $summedData['P1'] += $data->P1;
//            $summedData['P2'] += $data->P2;
//            $summedData['P3'] += $data->P3;
//            $summedData['E1'] += $data->E1;
//            $summedData['E2'] += $data->E2;
//            $summedData['E3'] += $data->E3;
//
//            if ($summedData['window_start'] === null || $summedData['window_start'] > $data->window_start) {
//                $summedData['window_start'] = $data->window_start;
//            }
//            if ($summedData['window_end'] === null || $summedData['window_end'] < $data->window_end) {
//                $summedData['window_end'] = $data->window_end;
//            }
//        }
//
//        // Set precise window boundaries based on timeframe
//        $summedData['window_start'] = $this->getWindowStart($summedData['window_start'], $timeframe);
//        $summedData['window_end'] = $this->getWindowEnd($summedData['window_end'], $timeframe);
//
//        $this->aggregatedFactoryData[$factory->id][$timeframe] = $summedData;
//    }
//
//    private function getWindowStart($timestamp, $timeframe)
//    {
//        switch ($timeframe) {
//            case 'hour':
//                return date('Y-m-d H:00:00', strtotime($timestamp));
//            case 'day':
//                return date('Y-m-d 00:00:00', strtotime($timestamp));
//            case 'week':
//                return date('Y-m-d 00:00:00', strtotime('monday this week', strtotime($timestamp)));
//            case 'month':
//                return date('Y-m-01 00:00:00', strtotime($timestamp));
//            default:
//                return $timestamp;
//        }
//    }
//
//    private function getWindowEnd($timestamp, $timeframe)
//    {
//        switch ($timeframe) {
//            case 'hour':
//                return date('Y-m-d H:59:59', strtotime($timestamp));
//            case 'day':
//                return date('Y-m-d 23:59:59', strtotime($timestamp));
//            case 'week':
//                return date('Y-m-d 23:59:59', strtotime('sunday this week', strtotime($timestamp)));
//            case 'month':
//                return date('Y-m-t 23:59:59', strtotime($timestamp));
//            default:
//                return $timestamp;
//        }
//    }
//
//    private function insertAggregatedDataForFactory($factory, $timeframe)
//    {
//        $summedData = $this->aggregatedFactoryData[$factory->id][$timeframe];
//
//        SensorDataWindowedFactory::create([
//            'factory_id' => $factory->id,
//            'timeframe' => $timeframe,
//            'window_start' => $summedData['window_start'],
//            'window_end' => $summedData['window_end'],
//            'P1' => $summedData['P1'],
//            'P2' => $summedData['P2'],
//            'P3' => $summedData['P3'],
//            'E1' => $summedData['E1'],
//            'E2' => $summedData['E2'],
//            'E3' => $summedData['E3'],
//        ]);
//    }
//}

//namespace App\Services;
//
//use App\Models\Factory;
//use App\Models\SensorData;
//use App\Models\SensorDataWindowedFactory;
//use Illuminate\Support\Facades\DB;
//
//class SensorDataWindowedFactoryService
//{
//    protected $aggregatedFactoryData = [];
//
//    public function aggregateSensorDataForFactories()
//    {
//        // Define the timeframes you want to aggregate data for
//        $timeframes = ['hour', 'day', 'week', 'month'];
//
//        foreach ($timeframes as $timeframe) {
//            // Perform the aggregation for factories
//            $this->aggregateFactoryData($timeframe);
//        }
//    }
//
//    private function aggregateFactoryData($timeframe)
//    {
//        // Fetch all factories
//        $factories = Factory::all();
//
//        foreach ($factories as $factory) {
//            // Loop through all sites associated with the factory
//            foreach ($factory->sites as $site) {
//                // Calculate the aggregation for each site and timeframe
//                $aggregatedData = $this->getAggregatedData($site->id, $timeframe);
//
//                // Sum the data across all sites
//                $this->sumAggregatedData($aggregatedData, $factory, $timeframe);
//            }
//
//            // Store aggregated data for the factory in the factory table
//            $this->insertAggregatedDataForFactory($factory, $timeframe);
//        }
//    }
//
//    private function getAggregatedData($siteId, $timeframe)
//    {
//        // Set the grouping based on the timeframe (hour, day, week, or month)
//        $groupBy = $this->getGroupByClause($timeframe);
//
//        // Calculate aggregation based on the grouping
//        return SensorData::whereHas('data_file', function ($query) use ($siteId) {
//            // Filter the data files by site_id (through the data_file relationship)
//            $query->where('site_id', $siteId);
//        })
//            ->select(
//                DB::raw("AVG(P1) as P1"),
//                DB::raw("AVG(P2) as P2"),
//                DB::raw("AVG(P3) as P3"),
//                DB::raw("AVG(E1) as E1"),
//                DB::raw("AVG(E2) as E2"),
//                DB::raw("AVG(E3) as E3"),
//                DB::raw("MIN(timestamp) as window_start"),
//                DB::raw("MAX(timestamp) as window_end")
//            )
//            ->groupBy(DB::raw($groupBy))
//            ->get();
//    }
//
//    private function getGroupByClause($timeframe)
//    {
//        // Based on the timeframe, create the appropriate `group by` clause
//        switch ($timeframe) {
//            case 'hour':
//                return 'HOUR(timestamp)';
//            case 'day':
//                return 'DATE(timestamp)';
//            case 'week':
//                return 'WEEK(timestamp)';
//            case 'month':
//                return 'MONTH(timestamp)';
//            default:
//                return 'DATE(timestamp)';
//        }
//    }
//
//    private function sumAggregatedData($aggregatedData, $factory, $timeframe)
//    {
//        // Initialize the summed data
//        $summedData = [
//            'P1' => 0,
//            'P2' => 0,
//            'P3' => 0,
//            'E1' => 0,
//            'E2' => 0,
//            'E3' => 0,
//            'window_start' => null,
//            'window_end' => null,
//        ];
//
//        // Sum the data for all sites
//        foreach ($aggregatedData as $data) {
//            $summedData['P1'] += $data->P1;
//            $summedData['P2'] += $data->P2;
//            $summedData['P3'] += $data->P3;
//            $summedData['E1'] += $data->E1;
//            $summedData['E2'] += $data->E2;
//            $summedData['E3'] += $data->E3;
//
//            // Set window_start and window_end based on the minimum and maximum timestamps across all sites
//            if ($summedData['window_start'] === null || $summedData['window_start'] > $data->window_start) {
//                $summedData['window_start'] = $data->window_start;
//            }
//            if ($summedData['window_end'] === null || $summedData['window_end'] < $data->window_end) {
//                $summedData['window_end'] = $data->window_end;
//            }
//        }
//
//        // Store the summed data for the factory in the class property to be inserted later
//        $this->aggregatedFactoryData[$factory->id][$timeframe] = $summedData;
//    }
//
//    private function insertAggregatedDataForFactory($factory, $timeframe)
//    {
//        // Insert the aggregated data for the factory into the factory-based table
//        $summedData = $this->aggregatedFactoryData[$factory->id][$timeframe];
//
//        SensorDataWindowedFactory::create([
//            'factory_id' => $factory->id,
//            'timeframe' => $timeframe,
//            'window_start' => $summedData['window_start'],
//            'window_end' => $summedData['window_end'],
//            'P1' => $summedData['P1'],
//            'P2' => $summedData['P2'],
//            'P3' => $summedData['P3'],
//            'E1' => $summedData['E1'],
//            'E2' => $summedData['E2'],
//            'E3' => $summedData['E3'],
//        ]);
//    }
//}
