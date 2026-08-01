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

        Schema::create('puja_orders', function (Blueprint $table) {
            $table->id();
            $table->string('puja_request_id');
            $table->unsignedBigInteger('user_id');
            $table->string('puja_location');
            $table->date('date_of_puja');
            $table->string('time_of_puja');
            $table->date('alternate_date_of_puja1')->nullable();
            $table->date('alternate_date_of_puja2')->nullable();
            $table->double('total_amount', 15, 2)->nullable();
            $table->string('priest_name')->nullable();
            $table->text('comments')->nullable();
            $table->text('admin_comments')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->text('cancelled_comments')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('changed_comments')->nullable();
            $table->string('payment_status')->nullable();
            $table->tinyInteger('terms_conditions')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('frontend_users');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puja_orders');
    }
};
