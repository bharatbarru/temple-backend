<?php

namespace App\Repositories;

use App\Models\TestimonialCategory;
use App\Repositories\BaseRepository;

class TestimonialCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'display_name',
        'testimonial_type',
        'icon',
        'type'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return TestimonialCategory::class;
    }
}
