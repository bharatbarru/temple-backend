<?php

namespace App\Repositories;

use App\Models\Statistics;
use App\Repositories\BaseRepository;

class StatisticsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'number',
        'prefix',
        'suffix',
        'url',
        'new_window'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Statistics::class;
    }
}
