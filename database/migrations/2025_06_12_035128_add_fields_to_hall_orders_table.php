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
        Schema::table('hall_orders', function (Blueprint $table) {
            //
            $table->date('end_date_of_event')->nullable();
            $table->string('number_of_days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hall_orders', function (Blueprint $table) {
            $table->dropColumn(['end_date_of_event']);
            $table->dropColumn(['number_of_days']);
        });
    }
};
