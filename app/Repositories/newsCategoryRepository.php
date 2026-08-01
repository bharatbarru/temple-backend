<?php

namespace App\Repositories;

use App\Models\newsCategory;
use App\Repositories\BaseRepository;

class newsCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'title',
        'tag_line'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return newsCategory::class;
    }
}
