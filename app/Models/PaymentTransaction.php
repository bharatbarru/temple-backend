<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PaymentTransaction extends Model
{
    use HasFactory;

    /**
     * Payment made against a puja booking.
     */
    public const TYPE_PUJA_ORDER = 'puja_order';

    /**
     * Payment made as a donation on the main website.
     */
    public const TYPE_DONATION = 'donation';

    /**
     * Prefix of the shared, human readable transaction reference.
     */
    public const TRANSACTION_ID_PREFIX = 'TXN-';

    protected $table = 'payment_transactions';

    protected $fillable = [
        'transaction_id',
        'transaction_type',
        'frontend_user_id',
        'puja_order_id',
        'puja_request_id',
        'reference_id',
        'paypal_order_id',
        'paypal_capture_id',
        'paypal_status',
        'paypal_paid',
        'paypal_amount',
        'paypal_currency',
        'paypal_payer_email',
        'paypal_payer_id',
        'payment_method',
        'card_brand',
        'card_type',
        'card_last_digits',
        'card_holder_name',
        'paypal_create_time',
        'paypal_update_time',
        'paypal_raw',
    ];

    protected $casts = [
        'paypal_paid' => 'boolean',
        'paypal_amount' => 'decimal:2',
        'paypal_raw' => 'array',
    ];

    protected static function booted(): void
    {
        // Every payment on the website - puja booking or donation - is stored in
        // this table, so the auto increment id gives both of them a single,
        // shared sequence of transaction references.
        static::created(function (self $transaction) {
            if (empty($transaction->transaction_id)) {
                $transaction->forceFill([
                    'transaction_id' => self::buildTransactionId($transaction->id),
                ])->saveQuietly();
            }
        });
    }

    /**
     * Build the shared transaction reference for the given primary key.
     */
    public static function buildTransactionId($id): string
    {
        return self::TRANSACTION_ID_PREFIX . str_pad((string) $id, 6, '0', STR_PAD_LEFT);
    }

    public function frontendUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'frontend_user_id');
    }

    public function pujaOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PujaOrder::class, 'puja_order_id');
    }

    /**
     * Shared transaction reference, falling back to the primary key for rows
     * created before the reference column existed.
     */
    public function getReferenceAttribute(): string
    {
        return $this->transaction_id ?: self::buildTransactionId($this->id);
    }

    /**
     * "PayPal" / "Card" - how the payer paid.
     */
    public function getPaymentMethodLabelAttribute(): string
    {
        if (!empty($this->payment_method)) {
            return $this->payment_method;
        }

        if ($this->card_brand || $this->card_last_digits) {
            return 'Card';
        }

        return $this->paypal_payer_email ? 'PayPal' : 'N/A';
    }

    /**
     * One line describing the PayPal account or the card that was charged, e.g.
     * "VISA ending in 1234" or "payer@example.com".
     */
    public function getPaymentSourceLabelAttribute(): string
    {
        if ($this->card_brand || $this->card_last_digits) {
            $label = trim(($this->card_brand ?: 'Card') . ' ' . ($this->card_type ?: ''));

            if ($this->card_last_digits) {
                $label .= ' ending in ' . $this->card_last_digits;
            }

            return trim($label);
        }

        return $this->paypal_payer_email ?: 'N/A';
    }

    /**
     * Pull the PayPal account / card details out of the raw PayPal response.
     *
     * PayPal returns them under `payment_source.paypal` or `payment_source.card`,
     * which may sit on the order itself or on the captured purchase unit, so the
     * lookup stays tolerant of both shapes.
     *
     * @return array<string, string|null>
     */
    public static function extractPaymentSource($raw): array
    {
        $raw = is_array($raw) ? $raw : [];

        $paymentSource = Arr::get($raw, 'payment_source')
            ?? Arr::get($raw, 'order.payment_source')
            ?? Arr::get($raw, 'data.payment_source')
            ?? [];

        $card = Arr::get($paymentSource, 'card', []);
        $paypal = Arr::get($paymentSource, 'paypal', []);

        $payerEmail = Arr::get($paypal, 'email_address')
            ?? Arr::get($raw, 'payer.email_address')
            ?? Arr::get($raw, 'order.payer.email_address');

        $payerName = trim(
            (string) (Arr::get($paypal, 'name.given_name') ?? Arr::get($raw, 'payer.name.given_name') ?? '')
            . ' '
            . (string) (Arr::get($paypal, 'name.surname') ?? Arr::get($raw, 'payer.name.surname') ?? '')
        );

        return [
            'payment_method' => !empty($card) ? 'Card' : (!empty($paypal) || $payerEmail ? 'PayPal' : null),
            'card_brand' => Arr::get($card, 'brand'),
            'card_type' => Arr::get($card, 'type'),
            'card_last_digits' => Arr::get($card, 'last_digits'),
            'card_holder_name' => Arr::get($card, 'name') ?: ($payerName ?: null),
            'paypal_payer_email' => $payerEmail,
            'paypal_payer_id' => Arr::get($paypal, 'account_id')
                ?? Arr::get($raw, 'payer.payer_id')
                ?? Arr::get($raw, 'order.payer.payer_id'),
        ];
    }
}
