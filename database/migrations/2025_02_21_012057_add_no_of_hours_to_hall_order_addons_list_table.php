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
        Schema::table('hall_order_addons_list', function (Blueprint $table) {
            $table->string('no_of_hours')->nullable()->after('hall_addon_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hall_order_addons_list', function (Blueprint $table) {
            $table->dropColumn(['no_of_hours']);
        });
    }
};
