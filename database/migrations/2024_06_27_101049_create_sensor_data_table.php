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
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_file_id');
            $table->timestamp('timestamp');
            $table->double('V1')->default(0);
            $table->double('I1')->default(0);
            $table->double('P1')->default(0);
            $table->double('Q1')->default(0);
            $table->double('E1')->default(0);
            $table->double('V2')->nullable();
            $table->double('I2')->nullable();
            $table->double('P2')->nullable();
            $table->double('Q2')->nullable();
            $table->double('E2')->nullable();
            $table->double('V3')->nullable();
            $table->double('I3')->nullable();
            $table->double('P3')->nullable();
            $table->double('Q3')->nullable();
            $table->double('E3')->nullable();
            $table->double('temperature')->default(0);
            $table->double('misc1')->nullable();
            $table->double('misc2')->nullable();
            $table->double('misc3')->nullable();
            $table->string('misc4')->nullable();
            $table->string('misc5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
