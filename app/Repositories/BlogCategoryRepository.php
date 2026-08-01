<?php

namespace App\Repositories;

use App\Models\BlogCategory;
use App\Repositories\BaseRepository;

class BlogCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'display_name',
        'image',
        'image_alt_text',
        'icon',
        'description',
        'type'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BlogCategory::class;
    }
}
