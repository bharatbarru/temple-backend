<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'product_category_id',
        'title',
        'slug',
        'sub_title',
        'post_date',
        'image',
        'image_alt_text',
        'short_description',
        'description',
        'image_gallery',
        'video_gallery',
        'video_url',
        'video_iframe',
        'custom_url',
        'map_url',
        'map_iframe',
        'page_title',
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
        return Product::class;
    }
}
