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

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_category_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->dateTime('start_date_time')->nullable();
            $table->dateTime('end_date_time')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('custom_url')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->bigInteger('sort')->default(0);
            $table->tinyInteger('publish')->default(1);
            $table->timestamps();
            $table->foreign('event_category_id')->references('id')->on('event_categories');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
