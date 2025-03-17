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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('batch_id');
            $table->date('date');
            $table->unsignedInteger('expense_type');
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('number_of_sack')->nullable();
            $table->decimal('cost_per_sack', 15, 2)->nullable();
            $table->unsignedInteger('food_type')->nullable();
            $table->text('description')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('receipt_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
