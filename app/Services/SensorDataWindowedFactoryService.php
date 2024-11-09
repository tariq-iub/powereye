<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\SensorData;
use App\Models\SensorDataWindowedFactory;
use Illuminate\Support\Facades\DB;

class SensorDataWindowedFactoryService
{
    protected $aggregatedFactoryData = [];

    public function aggregateSensorDataForFactories()
    {
        // Define the timeframes you want to aggregate data for
        $timeframes = ['hour', 'day', 'week', 'month'];

        foreach ($timeframes as $timeframe) {
            // Perform the aggregation for factories
            $this->aggregateFactoryData($timeframe);
        }
    }

    private function aggregateFactoryData($timeframe)
    {
        // Fetch all factories
        $factories = Factory::all();

        foreach ($factories as $factory) {
            // Loop through all sites associated with the factory
            foreach ($factory->sites as $site) {
                // Calculate the aggregation for each site and timeframe
                $aggregatedData = $this->getAggregatedData($site->id, $timeframe);

                // Sum the data across all sites
                $this->sumAggregatedData($aggregatedData, $factory, $timeframe);
            }

            // Store aggregated data for the factory in the factory table
            $this->insertAggregatedDataForFactory($factory, $timeframe);
        }
    }

    private function getAggregatedData($siteId, $timeframe)
    {
        // Set the grouping based on the timeframe (hour, day, week, or month)
        $groupBy = $this->getGroupByClause($timeframe);

        // Calculate aggregation based on the grouping
        return SensorData::select(
            DB::raw("AVG(P1) as P1"),
            DB::raw("AVG(P2) as P2"),
            DB::raw("AVG(P3) as P3"),
            DB::raw("AVG(E1) as E1"),
            DB::raw("AVG(E2) as E2"),
            DB::raw("AVG(E3) as E3"),
            DB::raw("MIN(timestamp) as window_start"),
            DB::raw("MAX(timestamp) as window_end")
        )
            ->where('site_id', $siteId)
            ->groupBy(DB::raw($groupBy))
            ->get();
    }

    private function getGroupByClause($timeframe)
    {
        // Based on the timeframe, create the appropriate `group by` clause
        switch ($timeframe) {
            case 'hour':
                return 'HOUR(timestamp)';
            case 'day':
                return 'DATE(timestamp)';
            case 'week':
                return 'WEEK(timestamp)';
            case 'month':
                return 'MONTH(timestamp)';
            default:
                return 'DATE(timestamp)';
        }
    }

    private function sumAggregatedData($aggregatedData, $factory, $timeframe)
    {
        // Initialize the summed data
        $summedData = [
            'P1' => 0,
            'P2' => 0,
            'P3' => 0,
            'E1' => 0,
            'E2' => 0,
            'E3' => 0,
            'window_start' => null,
            'window_end' => null,
        ];

        // Sum the data for all sites
        foreach ($aggregatedData as $data) {
            $summedData['P1'] += $data->P1;
            $summedData['P2'] += $data->P2;
            $summedData['P3'] += $data->P3;
            $summedData['E1'] += $data->E1;
            $summedData['E2'] += $data->E2;
            $summedData['E3'] += $data->E3;

            // Set window_start and window_end based on the minimum and maximum timestamps across all sites
            if ($summedData['window_start'] === null || $summedData['window_start'] > $data->window_start) {
                $summedData['window_start'] = $data->window_start;
            }
            if ($summedData['window_end'] === null || $summedData['window_end'] < $data->window_end) {
                $summedData['window_end'] = $data->window_end;
            }
        }

        // Store the summed data for the factory in the class property to be inserted later
        $this->aggregatedFactoryData[$factory->id][$timeframe] = $summedData;
    }

    private function insertAggregatedDataForFactory($factory, $timeframe)
    {
        // Insert the aggregated data for the factory into the factory-based table
        $summedData = $this->aggregatedFactoryData[$factory->id][$timeframe];

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
