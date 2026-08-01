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

        Schema::create('service_categories', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('display_name')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->string('tagline')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
