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

        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('product_category_id');
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('sub_title')->nullable();
            $table->dateTime('post_date')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('image_gallery')->nullable();
            $table->text('video_gallery')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_iframe')->nullable();
            $table->string('custom_url')->nullable();
            $table->string('map_url')->nullable();
            $table->string('map_iframe')->nullable();
            $table->text('page_title')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->tinyInteger('publish')->default(1);
            $table->unsignedBigInteger('sort')->nullable();
            $table->timestamps();

            $table->foreign('product_category_id')->references('id')->on('product_categories');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};