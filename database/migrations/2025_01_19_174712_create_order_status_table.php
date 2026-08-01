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

        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_order_id')->nullable();
            $table->unsignedBigInteger('puja_order_id')->nullable();
            $table->unsignedBigInteger('temple_tour_order_id')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->foreign('hall_order_id')->references('id')->on('hall_orders');
            $table->foreign('puja_order_id')->references('id')->on('puja_orders');
            $table->foreign('temple_tour_order_id')->references('id')->on('temple_tours');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status');
    }
};
