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

        Schema::create('photo_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('photo_category_id');
            $table->foreign('photo_category_id')->references('id')->on('photo_gallery_categories');
            $table->text('image_gallery')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('title')->nullable();
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
        Schema::dropIfExists('photo_galleries');
    }
};