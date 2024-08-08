<?php

// app/Events/SensorDataUpdated.php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SensorDataUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $latestSensorData;
    public array $sitesPower;
    public array $sitesEnergy;

    public function __construct($latestSensorData, $sitesPower, $sitesEnergy)
    {
        $this->latestSensorData = $latestSensorData;
        $this->sitesPower = $sitesPower;
        $this->sitesEnergy = $sitesEnergy;
    }

    public function broadcastOn()
    {
        return new Channel('sensor-data');
    }

    public function broadcastWith()
    {
        return [
            'latestSensorData' => $this->latestSensorData,
            'sitesPower' => $this->sitesPower,
            'sitesEnergy' => $this->sitesEnergy,
        ];
    }
}
