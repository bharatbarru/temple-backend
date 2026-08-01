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

        Schema::create('royalty_points', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->double('points', 16, 2);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('royalty_points');
    }
};
