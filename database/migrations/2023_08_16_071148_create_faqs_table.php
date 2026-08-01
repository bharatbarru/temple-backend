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

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_categories_id');
            $table->foreign('faq_categories_id')->references('id')->on('faq_categories');
            $table->string('question');
            $table->text('answer');
            $table->string('button_name')->nullable();
            $table->text('button_url')->nullable();
            $table->tinyInteger('new_window')->nullable();
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
        Schema::dropIfExists('faqs');
    }
};