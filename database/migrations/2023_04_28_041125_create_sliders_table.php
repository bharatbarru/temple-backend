<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id('id');
            $table->string('image');
            $table->string('image_alt_text')->nullable();
            $table->string('title')->nullable();
            $table->text('tagline')->nullable();
            $table->string('button_name')->nullable();
            $table->string('button_url')->nullable();
            $table->tinyInteger('new_window')->default(1);
            $table->tinyInteger('publish')->default(1);
            $table->unsignedBigInteger('sort')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sliders');
    }
};
