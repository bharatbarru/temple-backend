<?php

namespace App\Repositories;

use App\Models\HallOrder;
use App\Repositories\BaseRepository;

class HallOrderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'hall_request_id',
        'type_of_event',
        'user_id',
        'hall_event_type_id',
        'other_event_type',
        'date_of_event',
        'alternate_date_of_event',
        'start_time',
        'duration',
        'comments',
        'total_amount',
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
        return HallOrder::class;
    }
}
