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

        Schema::create('temple_tours', function (Blueprint $table) {
            $table->id();
            $table->string('tour_request_id');
            $table->string('name');
            $table->date('tour_date');
            $table->string('tour_time');
            $table->date('alternate_tour_date')->nullable();
            $table->string('alternate_tour_time')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('total_visitors')->nullable();
            $table->string('age_range_of_group')->nullable();
            $table->tinyInteger('last_visit_to_temple')->nullable();
            $table->text('comment')->nullable();
            $table->text('admin_comments')->nullable();
            $table->tinyInteger('terms_conditions')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temple_tours');
    }
};
