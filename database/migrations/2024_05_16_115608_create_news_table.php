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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_category_id')->nullable();
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('set null');
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('date')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->json('gallery')->nullable();
            $table->string('custom_url')->nullable();
            $table->tinyInteger('new_window')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};