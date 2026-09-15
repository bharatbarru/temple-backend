<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Puja bookings reach the backend on two different endpoints - the mobile
     * app posts to `pujaOrders`, the website posts to `public/puja-orders` -
     * but nothing about that split was ever stored, so the reports had no way
     * to tell a mobile booking from a web one.
     *
     * Bookings created before this column existed cannot be classified after
     * the fact, so they stay `unknown` rather than being guessed at.
     */
    public function up(): void
    {
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->string('source', 20)->default('unknown')->after('puja_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
