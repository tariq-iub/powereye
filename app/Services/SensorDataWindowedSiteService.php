<?php


namespace App\Services;

use App\Models\SensorData;
use App\Models\SensorDataWindowedSite;
use Illuminate\Support\Facades\DB;

class SensorDataWindowedSiteService
{
    public function aggregateSensorDataForSites()
    {
        // Define the timeframes you want to aggregate data for
        $timeframes = ['hour', 'day', 'week', 'month'];

        foreach ($timeframes as $timeframe) {
            // Fetch distinct site IDs
            $sites = DB::table('sites')->pluck('id');

            foreach ($sites as $siteId) {
                // Calculate the aggregation for each site and timeframe
                $aggregatedData = $this->getAggregatedData($siteId, $timeframe);

                // Insert aggregated data into sensor_data_windowed_sites
                $this->insertAggregatedData($siteId, $timeframe, $aggregatedData);
            }
        }
    }

    private function getAggregatedData($siteId, $timeframe)
    {
        // Set the grouping based on the timeframe (hour, day, week, or month)
        $groupBy = $this->getGroupByClause($timeframe);

        // Calculate aggregation based on the grouping
        $aggregatedData = SensorData::select(
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

        return $aggregatedData;
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

    private function insertAggregatedData($siteId, $timeframe, $aggregatedData)
    {
        // Insert the aggregated data into the sensor_data_windowed_sites table
        foreach ($aggregatedData as $data) {
            SensorDataWindowedSite::create([
                'site_id' => $siteId,
                'timeframe' => $timeframe,
                'window_start' => $data->window_start,
                'window_end' => $data->window_end,
                'P1' => $data->P1,
                'P2' => $data->P2,
                'P3' => $data->P3,
                'E1' => $data->E1,
                'E2' => $data->E2,
                'E3' => $data->E3,
            ]);
        }
    }
}
