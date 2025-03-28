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
        Schema::create('company_and_chicks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('breed_id');
            $table->unsignedInteger('chick_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_and_chicks');
    }
};
