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

        Schema::create('teams', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('team_categories_id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->string('designation')->nullable();
            $table->text('description')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('other')->nullable();
            $table->unsignedBigInteger('sort')->nullable();
            $table->foreign('team_categories_id')->references('id')->on('team_categories');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};