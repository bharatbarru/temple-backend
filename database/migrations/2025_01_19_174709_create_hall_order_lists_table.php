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

        Schema::create('hall_order_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_order_id');
            $table->unsignedBigInteger('hall_id');
            $table->double('hall_cost', 15, 2);
            $table->timestamps();
            $table->foreign('hall_order_id')->references('id')->on('hall_orders');
            $table->foreign('hall_id')->references('id')->on('halls');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_order_lists');
    }
};
