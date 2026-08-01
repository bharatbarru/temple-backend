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

        Schema::create('video_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_category_id');
            $table->foreign('video_category_id')->references('id')->on('video_gallery_categories');
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->tinyInteger('new_window')->nullable();
            $table->string('title')->nullable();
            $table->string('video_url')->nullable();
            $table->text('video_iframe')->nullable();
            $table->text('description')->nullable();
            $table->text('thumbnail')->nullable();
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
        Schema::dropIfExists('video_galleries');
    }
};