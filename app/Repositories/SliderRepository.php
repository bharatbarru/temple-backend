<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Repositories\BaseRepository;

class SliderRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'image',
        'image_alt_text',
        'title',
        'tagline',
        'button_name',
        'button_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Slider::class;
    }
}
