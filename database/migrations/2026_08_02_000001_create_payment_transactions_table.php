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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('frontend_user_id')->nullable();
            $table->unsignedBigInteger('puja_order_id')->nullable();
            $table->string('puja_request_id')->nullable();
            $table->string('paypal_order_id')->nullable();
            $table->string('paypal_capture_id')->nullable();
            $table->string('paypal_status')->nullable();
            $table->boolean('paypal_paid')->default(false);
            $table->decimal('paypal_amount', 10, 2)->nullable();
            $table->string('paypal_currency')->nullable();
            $table->string('paypal_payer_email')->nullable();
            $table->string('paypal_payer_id')->nullable();
            $table->string('paypal_create_time')->nullable();
            $table->string('paypal_update_time')->nullable();
            $table->json('paypal_raw')->nullable();
            $table->timestamps();

            $table->foreign('frontend_user_id')->references('id')->on('frontend_users')->onDelete('set null');
            $table->foreign('puja_order_id')->references('id')->on('puja_orders')->onDelete('set null');
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
