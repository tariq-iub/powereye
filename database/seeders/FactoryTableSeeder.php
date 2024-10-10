<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FactoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('factories')->insert([
            [
                'title' => 'Factory 1',
                'address' => 'The Islamia University of Bahawalpur, Pakistan',
                'owner_name' => 'Abid Javaid',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
