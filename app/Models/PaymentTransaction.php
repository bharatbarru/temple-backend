<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $table = 'payment_transactions';

    protected $fillable = [
        'frontend_user_id',
        'puja_order_id',
        'puja_request_id',
        'paypal_order_id',
        'paypal_capture_id',
        'paypal_status',
        'paypal_paid',
        'paypal_amount',
        'paypal_currency',
        'paypal_payer_email',
        'paypal_payer_id',
        'paypal_create_time',
        'paypal_update_time',
        'paypal_raw',
    ];

    protected $casts = [
        'paypal_paid' => 'boolean',
        'paypal_amount' => 'decimal:2',
        'paypal_raw' => 'array',
    ];

    public function frontendUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FrontendUser::class, 'frontend_user_id');
    }

    public function pujaOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(PujaOrder::class, 'puja_order_id');
    }
}
