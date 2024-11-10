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
        $tables = ['site_summaries', 'factory_summaries'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->decimal('power', 15, 2)->change();
                $table->decimal('energy', 15, 2)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['site_summaries', 'factory_summaries'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->decimal('power', 8, 2)->change();  // Assuming original was (8, 2)
                $table->decimal('energy', 8, 2)->change(); // Adjust if original differs
            });
        }
    }
};
