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
        Schema::table('sensor_data_windowed_factories', function (Blueprint $table) {
            $table->foreign('factory_id')
                ->references('id')
                ->on('factories') // Make sure this is the correct table name
                ->onDelete('cascade');
        });

        Schema::table('sensor_data_windowed_sites', function (Blueprint $table) {
            $table->foreign('site_id')
                ->references('id')
                ->on('sites') // Make sure this is the correct table name
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sensor_data_windowed_factories', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
        });

        Schema::table('sensor_data_windowed_sites', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
        });
    }
};
