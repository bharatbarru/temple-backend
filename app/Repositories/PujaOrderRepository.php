<?php

namespace App\Repositories;

use App\Models\PujaOrder;
use App\Repositories\BaseRepository;

class PujaOrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'puja_request_id',
        'user_id',
        'puja_location',
        'date_of_puja',
        'time_of_puja',
        'alternate_date_of_puja1',
        'alternate_time_of_puja2',
        'total_amount',
        'priest_name',
        'comments',
        'admin_comments',
        'cancelled_by',
        'cancelled_comments',
        'changed_by',
        'changed_comments',
        'payment_status',
        'terms_conditions'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PujaOrder::class;
    }
}
