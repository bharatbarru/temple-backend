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
        // Step 1: Rename the column
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->renameColumn('alternate_date_of_puja2', 'alternate_time_of_puja2');
        });

        // Step 2: Change the data type to string and keep it nullable
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->string('alternate_time_of_puja2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Change it back to date (nullable)
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->date('alternate_time_of_puja2')->nullable()->change();
        });

        // Step 2: Rename column back to original
        Schema::table('puja_orders', function (Blueprint $table) {
            $table->renameColumn('alternate_time_of_puja2', 'alternate_date_of_puja2');
        });
    }
};
