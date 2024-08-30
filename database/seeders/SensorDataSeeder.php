<?php

namespace Database\Seeders;

use App\Models\SensorData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SensorDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SensorData::factory()->count(15)->create();
    }
}
