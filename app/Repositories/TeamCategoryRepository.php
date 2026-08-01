<?php

namespace App\Repositories;

use App\Models\TeamCategory;
use App\Repositories\BaseRepository;

class TeamCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'display_name',
        'icon',
        'image',
        'image_alt_text',
        'type',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TeamCategory::class;
    }
}
