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
        Schema::create('application_settings', function (Blueprint $table) {
            $table->id('id');
            $table->string('field_name');
            $table->string('slug');
            $table->string('input_type');
            $table->text('value')->nullable();
            $table->string('alt_text')->nullable();
            $table->text('options')->nullable();
            $table->unsignedBigInteger('application_setting_type_id');
            $table->unsignedBigInteger('application_setting_category_id')->nullable();
            $table->unsignedBigInteger('sort')->nullable();
            $table->timestamps();
            $table->foreign('application_setting_type_id')->references('id')->on('application_setting_types');
            $table->foreign('application_setting_category_id')->references('id')->on('application_setting_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('application_settings');
    }
};
