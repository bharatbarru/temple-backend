<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * `payment_transactions` is the single table behind every payment made on the
     * website (puja bookings today, donations next), so the human readable
     * transaction reference generated here is unique across all of them.
     */
    public function up(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            // Shared, human readable reference - "TXN-000123".
            $table->string('transaction_id', 64)->nullable()->unique()->after('id');

            // What the payment was made for, so donations can share this table.
            $table->string('transaction_type')->default('puja_order')->after('transaction_id');

            // Reference of the record the payment belongs to (puja request id,
            // donation reference, ...). Kept generic on purpose.
            $table->string('reference_id')->nullable()->after('puja_request_id');

            // Payment source details shown on the receipts.
            $table->string('payment_method')->nullable()->after('paypal_payer_id');
            $table->string('card_brand')->nullable()->after('payment_method');
            $table->string('card_type')->nullable()->after('card_brand');
            $table->string('card_last_digits', 8)->nullable()->after('card_type');
            $table->string('card_holder_name')->nullable()->after('card_last_digits');
        });

        // Backfill existing rows so older receipts keep a stable reference.
        DB::table('payment_transactions')
            ->whereNull('transaction_id')
            ->select('id', 'puja_request_id')
            ->chunkById(200, function ($transactions) {
                foreach ($transactions as $transaction) {
                    DB::table('payment_transactions')
                        ->where('id', $transaction->id)
                        ->update([
                            'transaction_id' => 'TXN-' . str_pad((string) $transaction->id, 6, '0', STR_PAD_LEFT),
                            'reference_id' => $transaction->puja_request_id,
                        ]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropUnique(['transaction_id']);
            $table->dropColumn([
                'transaction_id',
                'transaction_type',
                'reference_id',
                'payment_method',
                'card_brand',
                'card_type',
                'card_last_digits',
                'card_holder_name',
            ]);
        });
    }
};
