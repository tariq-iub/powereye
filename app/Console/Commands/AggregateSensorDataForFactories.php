<?php

namespace App\Console\Commands;

use App\Services\SensorDataWindowedFactoryService;
use Illuminate\Console\Command;

class AggregateSensorDataForFactories extends Command
{
    protected $signature = 'aggregate:sensordata-factories';
    protected $description = 'Aggregate sensor data into windowed summaries for factories';

    protected $sensorDataWindowedFactoryService;

    public function __construct(SensorDataWindowedFactoryService $sensorDataWindowedFactoryService)
    {
        parent::__construct();
        $this->sensorDataWindowedFactoryService = $sensorDataWindowedFactoryService;
    }

    public function handle()
    {
        $this->info('Starting factory data aggregation.');

        // Call the service to aggregate the sensor data at the factory level
        $this->sensorDataWindowedFactoryService->aggregateSensorDataForFactories();

        $this->info('Factory data aggregation completed.');
    }
}
