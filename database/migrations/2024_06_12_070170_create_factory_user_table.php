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
        Schema::create('factory_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factory_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('access_level', ['owner', 'employee'])->default('employee');
            $table->timestamps();

            $table->foreign('factory_id')->references('id')->on('factories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factory_user', function (Blueprint $table) {
            $table->dropForeign(['factory_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('factory_user');
    }
};


