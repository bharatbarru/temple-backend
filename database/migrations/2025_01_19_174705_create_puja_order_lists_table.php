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

        Schema::create('puja_order_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puja_order_id');
            $table->unsignedBigInteger('puja_id');
            $table->double('puja_cost', 15, 2);
            $table->timestamps();
            $table->foreign('puja_order_id')->references('id')->on('puja_orders');
            $table->foreign('puja_id')->references('id')->on('pujas');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puja_order_lists');
    }
};
