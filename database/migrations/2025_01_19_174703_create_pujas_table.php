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

        Schema::create('pujas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('home_amount', 15, 2)->nullable()->default(0);
            $table->double('temple_amount', 15, 2)->nullable()->default(0);
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
        Schema::dropIfExists('pujas');
    }
};
