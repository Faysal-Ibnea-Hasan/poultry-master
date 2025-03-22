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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('chick_type_id')->nullable();
            $table->string('company_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('cost_per_chick', 15, 2)->nullable();
            $table->date('arrival_date')->nullable();
            $table->decimal('initial_weight', 8, 2)->nullable();
            $table->string('source_supplier')->nullable();
            $table->string('shed_number')->nullable();
            $table->enum('status',['active','inactive','terminated'])->default('active')->comment('active|inactive|terminated');
            $table->date('expected_finish_date')->nullable();
            $table->date('actual_finish_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
