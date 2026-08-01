<?php

namespace App\Repositories;

use App\Models\Cms;
use App\Repositories\BaseRepository;

class CmsRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'slug',
        'parent',
        'type',
        'custom_url',
        'banner_image',
        'banner_image_alt_text',
        'banner_title',
        'banner_tagline',
        'short_description',
        'content',
        'gallery',
        'main_menu',
        'top_menu',
        'side_menu',
        'footer_menu',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'publish',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Cms::class;
    }
}
