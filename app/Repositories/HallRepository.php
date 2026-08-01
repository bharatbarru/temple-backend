<?php

namespace App\Repositories;

use App\Models\Hall;
use App\Repositories\BaseRepository;

class HallRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'image',
        'image_alt_text',
        'monday_cost',
        'tuesday_cost',
        'wednesday_cost',
        'thursday_cost',
        'friday_cost',
        'saturday_cost',
        'sunday_cost',
        'sort',
        'publish'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Hall::class;
    }
}
