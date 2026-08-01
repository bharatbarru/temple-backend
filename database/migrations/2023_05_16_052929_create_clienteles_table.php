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

        Schema::create('clienteles', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('clientele_category_id');
            $table->foreign('clientele_category_id')->references('id')->on('clientele_categories');
            $table->string('image');
            $table->string('image_alt_text')->nullable();
            $table->string('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('new_window')->nullable();
            $table->tinyInteger('publish')->default(1);
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
        Schema::dropIfExists('clienteles');
    }
};