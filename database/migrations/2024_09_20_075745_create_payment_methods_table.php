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

        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method_name');
            $table->string('display_name');
            $table->string('slug');
            $table->string('sandbox_key')->nullable();
            $table->string('sandbox_secret')->nullable();
            $table->string('live_key')->nullable();
            $table->string('live_secret')->nullable();
            $table->tinyInteger('publish')->nullable()->default(1);
            $table->unsignedBigInteger('sort')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
