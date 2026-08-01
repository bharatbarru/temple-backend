<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Repositories\BaseRepository;

class TestimonialRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'company',
        'designation',
        'date',
        'image',
        'image_alt_text',
        'icon',
        'video_url',
        'video_iframe',
        'short_description',
        'description',
        'custom_url',
        'new_window',
        'testimonial_category_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Testimonial::class;
    }
}
