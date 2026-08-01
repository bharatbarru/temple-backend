<?php

namespace App\Repositories;

use App\Models\TempleTour;
use App\Repositories\BaseRepository;

class TempleTourRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'tour_request_id',
        'name',
        'tour_date',
        'tour_time',
        'alternate_tour_date',
        'alternate_tour_time',
        'email',
        'mobile',
        'total_visitors',
        'age_range_of_group',
        'last_visit_to_temple',
        'comment',
        'admin_comments',
        'terms_conditions'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TempleTour::class;
    }
}
