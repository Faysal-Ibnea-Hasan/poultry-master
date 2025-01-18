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
        Schema::create('brooding_temperatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('batch_id')->nullable();
            $table->integer('day_number')->nullable();
            $table->decimal('target_temperature')->nullable();
            $table->decimal('actual_temperature')->nullable();
            $table->decimal('humidity_level')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brooding_temperatures');
    }
};
