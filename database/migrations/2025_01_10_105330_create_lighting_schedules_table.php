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
        Schema::create('lighting_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('batch_id')->nullable();
            $table->integer('day_number')->nullable();
            $table->integer('light_hours')->nullable();
            $table->string('light_intensity')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lighting_schedules');
    }
};
