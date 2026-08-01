<?php

namespace App\Repositories;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class ProductCategoryRepository extends BaseRepository
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
        return ProductCategory::class;
    }
}
