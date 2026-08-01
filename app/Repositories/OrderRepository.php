<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

class OrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'orderid',
        'customer_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'order_type',
        'subtotal_amount',
        'coupon_discount',
        'royalty_points_amount',
        'tax_amount',
        'delivery_charge',
        'total_amount',
        'coupon_id',
        'delivery_address',
        'contact_number',
        'payment_method_id',
        'transaction_id',
        'payment_status',
        'order_status',
        'reason_for_cancellation',
        'order_date'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Order::class;
    }
}
