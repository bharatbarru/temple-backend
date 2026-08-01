<?php

namespace App\Repositories;

use App\Models\Puja;
use App\Repositories\BaseRepository;

class PujaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'home_amount',
        'temple_amount',
        'sort',
        'publish'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Puja::class;
    }
}
