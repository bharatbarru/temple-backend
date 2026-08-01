<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\BaseRepository;

class CouponRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'coupon_code',
        'image',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'valid_from',
        'valid_until',
        'usage_limit'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Coupon::class;
    }
}
