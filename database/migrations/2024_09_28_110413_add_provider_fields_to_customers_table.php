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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('pincode');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('remember_token', 100)->nullable()->after('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['provider']);
            $table->dropColumn(['provider_id']);
            $table->dropColumn(['remember_token']);
        });
    }
};
