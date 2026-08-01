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

        Schema::create('hall_orders', function (Blueprint $table) {
            $table->id();
            $table->string('hall_request_id');
            $table->string('type_of_event');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('hall_event_type_id')->nullable();
            $table->string('other_event_type')->nullable();
            $table->date('date_of_event')->nullable();
            $table->date('alternate_date_of_event')->nullable();
            $table->time('start_time')->nullable();
            $table->string('duration')->nullable();
            $table->text('comments')->nullable();
            $table->double('total_amount', 15, 2)->nullable();
            $table->text('admin_comments')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->text('cancelled_comments')->nullable();
            $table->string('changed_by')->nullable();
            $table->text('changed_comments')->nullable();
            $table->string('payment_status')->nullable();
            $table->tinyInteger('terms_conditions')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('frontend_users');
            $table->foreign('hall_event_type_id')->references('id')->on('hall_event_types');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_orders');
    }
};
