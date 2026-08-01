<?php

namespace App\Repositories;

use App\Models\HallEventType;
use App\Repositories\BaseRepository;

class HallEventTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'sort',
        'publish'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return HallEventType::class;
    }
}
