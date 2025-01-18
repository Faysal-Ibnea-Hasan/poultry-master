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
        Schema::create('vaccination_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('batch_id')->nullable();
            $table->unsignedInteger('disease_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->string('vaccine_name')->nullable();
            $table->date('scheduled_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->string('dosage')->nullable();
            $table->string('administration_method')->nullable();
            $table->string('administered_by')->nullable();
            $table->decimal('cost')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccination_schedules');
    }
};
