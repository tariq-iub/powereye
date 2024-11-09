<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('sensor_data_windowed_factories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factory_id');                   // Reference to the factory
            $table->enum('timeframe', ['hour', 'day', 'week', 'month']); // Aggregation timeframe
            $table->timestamp('window_start');                          // Start of the window timeframe
            $table->timestamp('window_end');                            // End of the window timeframe

            // Retained sensor data columns (for power and energy phases)
            $table->double('P1')->default(0);                           // Power phase 1
            $table->double('P2')->default(0);                           // Power phase 2
            $table->double('P3')->default(0);                           // Power phase 3
            $table->double('E1')->default(0);                           // Energy phase 1
            $table->double('E2')->default(0);                           // Energy phase 2
            $table->double('E3')->default(0);                           // Energy phase 3

            $table->timestamps();                                       // Created and updated timestamps

            // Indexes for efficient querying
            $table->index(['factory_id', 'window_start', 'timeframe'], 'idx_factory_window_timeframe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('sensor_data_windowed_factories');
    }
};
