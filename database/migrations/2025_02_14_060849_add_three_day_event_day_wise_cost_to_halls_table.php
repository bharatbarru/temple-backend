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
        Schema::table('halls', function (Blueprint $table) {
            $table->double('monday_three_day_cost', 15, 2)->default(0)->after('sunday_cost');
            $table->double('tuesday_three_day_cost', 15, 2)->default(0)->after('monday_three_day_cost');
            $table->double('wednesday_three_day_cost', 15, 2)->default(0)->after('tuesday_three_day_cost');
            $table->double('thursday_three_day_cost', 15, 2)->default(0)->after('wednesday_three_day_cost');
            $table->double('friday_three_day_cost', 15, 2)->default(0)->after('thursday_three_day_cost');
            $table->double('saturday_three_day_cost', 15, 2)->default(0)->after('friday_three_day_cost');
            $table->double('sunday_three_day_cost', 15, 2)->default(0)->after('saturday_three_day_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropColumn('monday_three_day_cost');
            $table->dropColumn('tuesday_three_day_cost');
            $table->dropColumn('wednesday_three_day_cost');
            $table->dropColumn('thursday_three_day_cost');
            $table->dropColumn('friday_three_day_cost');
            $table->dropColumn('saturday_three_day_cost');
            $table->dropColumn('sunday_three_day_cost');
        });
    }
};
