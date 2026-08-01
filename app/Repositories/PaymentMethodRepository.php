<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\BaseRepository;

class PaymentMethodRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'payment_method_name',
        'display_name',
        'slug',
        'sandbox_key',
        'sandbox_secret',
        'live_key',
        'live_secret',
        'publish',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PaymentMethod::class;
    }
}
