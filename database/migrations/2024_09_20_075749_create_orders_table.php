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
        Schema::disableForeignKeyConstraints();

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('orderid');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('order_type')->nullable();
            $table->double('subtotal_amount', 16, 2)->nullable();
            $table->double('coupon_discount', 16, 2)->nullable();
            $table->double('royalty_points_amount', 16, 2)->nullable();
            $table->double('tax_amount', 16, 2)->nullable();
            $table->double('delivery_charge', 16, 2)->nullable();
            $table->double('total_amount', 16, 2)->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->text('delivery_address')->nullable();
            $table->string('contact_number')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('order_status')->nullable();
            $table->text('reason_for_cancellation')->nullable();
            $table->date('order_date')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
