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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name'); // e.g., Monthly, Annual
            $table->string('image')->nullable();
            $table->enum('type', ['monthly', 'annual', 'lifetime']); // More precise instead of string
            $table->decimal('regular_price', 15, 2);
            $table->decimal('offer_price', 15, 2);
            $table->integer('duration_days'); // 30 for monthly, 365 for annual, null for lifetime
            $table->boolean('status')->default(1)->comment('1 - active, 0 - inactive'); // Boolean instead of integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
