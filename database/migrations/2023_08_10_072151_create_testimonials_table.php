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

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->date('date')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('icon')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_iframe')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('custom_url')->nullable();
            $table->tinyInteger('new_window')->nullable();
            $table->unsignedBigInteger('testimonial_category_id');
            $table->foreign('testimonial_category_id')->references('id')->on('testimonial_categories');
            $table->timestamps();
            $table->unsignedBigInteger('sort')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};