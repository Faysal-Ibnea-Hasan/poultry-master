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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id');
            $table->foreignId('subscriber_id')->nullable();
            $table->string('payment_id')->unique(); // "paymentID"
            $table->string('trx_id')->nullable();   // "trxID"
            $table->string('invoice')->nullable();  // "merchantInvoiceNumber"
            $table->string('status')->nullable();   // "transactionStatus"
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('intent')->nullable();
            $table->timestamp('payment_time')->nullable(); // parsed from "paymentExecuteTime"

            $table->string('payer_type')->nullable(); // "payerType"
            $table->string('payer_reference')->nullable(); // "payerReference"
            $table->string('customer_msisdn')->nullable(); // "customerMsisdn"
            $table->string('payer_account')->nullable(); // "payerAccount"

            $table->decimal('max_refundable_amount', 10, 2)->nullable();
            $table->string('status_code')->nullable();
            $table->string('status_message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
