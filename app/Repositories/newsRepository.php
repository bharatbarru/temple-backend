<?php

namespace App\Repositories;

use App\Models\news;
use App\Repositories\BaseRepository;

class newsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'news_category_id',
        'title',
        'tagline',
        'image',
        'image_alt',
        'date',
        'short_description',
        'description',
        'gallery',
        'custom_url',
        'new_window'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return news::class;
    }
}
