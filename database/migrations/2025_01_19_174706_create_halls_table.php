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

        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt_text')->nullable();
            $table->double('monday_cost', 15, 2)->default('0');
            $table->double('tuesday_cost', 15, 2)->default('0');
            $table->double('wednesday_cost', 15, 2)->default('0');
            $table->double('thursday_cost', 15, 2)->default('0');
            $table->double('friday_cost', 15, 2)->default('0');
            $table->double('saturday_cost', 15, 2)->default('0');
            $table->double('sunday_cost', 15, 2)->default('0');
            $table->bigInteger('sort')->default(0);
            $table->tinyInteger('publish')->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
