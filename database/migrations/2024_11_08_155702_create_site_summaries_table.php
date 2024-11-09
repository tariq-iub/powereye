<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->onDelete('cascade');
            $table->string('time_frame'); // e.g., '1 hour', '1 day', etc.
            $table->float('power'); // Average power
            $table->float('energy'); // Total energy
            $table->float('min_power');
            $table->float('max_power');
            $table->float('min_energy');
            $table->float('max_energy');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamps();
            $table->unique(['site_id', 'time_frame', 'start_time', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_summaries');
    }
};
