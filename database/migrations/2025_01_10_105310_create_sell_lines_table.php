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
        Schema::create('sell_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sell_id')->constrained('sells')->onDelete('cascade');
            $table->string('sell_description')->nullable();
            $table->string('product_type')->nullable()->comment('chickens|others');
            $table->integer('quantity')->nullable();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('total_weight', 15, 2)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_lines');
    }
};
