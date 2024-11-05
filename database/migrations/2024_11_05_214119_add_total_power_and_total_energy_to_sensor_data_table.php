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
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->double('total_power')->default(0)->after('E3');
            $table->double('total_energy')->default(0)->after('total_power');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data', function (Blueprint $table) {
            $table->dropColumn(['total_power', 'total_energy']);
        });
    }
};
