<?php

namespace App\Console\Commands;

use App\Services\SensorDataWindowedSiteService;
use Illuminate\Console\Command;

class AggregateSensorDataForSites extends Command
{
    protected $signature = 'aggregate:sensordata-sites';
    protected $description = 'Aggregate sensor data into windowed summaries for sites';

    protected $sensorDataWindowedSiteService;

    public function __construct(SensorDataWindowedSiteService $sensorDataWindowedSiteService)
    {
        parent::__construct();
        $this->sensorDataWindowedSiteService = $sensorDataWindowedSiteService;
    }

    public function handle()
    {
        $this->info('Starting site data aggregation.');

        // Call the service to aggregate the sensor data at the site level
        $this->sensorDataWindowedSiteService->aggregateSensorDataForSites();

        $this->info('Site data aggregation completed.');
    }
}
