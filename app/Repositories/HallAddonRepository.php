<?php

namespace App\Repositories;

use App\Models\HallAddon;
use App\Repositories\BaseRepository;

class HallAddonRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'description',
        'image',
        'image_alt_text',
        'sort',
        'publish',
        'event_type'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return HallAddon::class;
    }
}
