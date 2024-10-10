<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $now = Carbon::now();

        DB::table('sites')->insert([
            [
                'title' => 'Powder Plant',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Amonia Plant',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'UHT Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pasteurizer Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'PLE Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Juice Hall',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Tetra Pack',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Technical Block',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Admin Block',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Power House',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Instrument Lab',
                'factory_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
