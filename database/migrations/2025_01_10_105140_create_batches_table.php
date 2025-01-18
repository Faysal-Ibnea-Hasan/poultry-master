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
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('breed_id');
            $table->unsignedInteger('category_id');
            $table->string('batch_number');
            $table->integer('quantity');
            $table->date('arrival_date');
            $table->decimal('initial_weight', 8, 2)->nullable();
            $table->decimal('cost_per_chick', 10, 2)->nullable();
            $table->string('source_supplier')->nullable();
            $table->string('shed_number')->nullable();
            $table->enum('status',['active','inactive','terminated'])->default('inactive')->comment('active|inactive|terminated');
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
