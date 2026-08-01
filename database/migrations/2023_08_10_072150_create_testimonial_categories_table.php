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

        Schema::create('testimonial_categories', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('testimonial_type')->nullable();
            $table->string('icon')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_categories');
    }
};