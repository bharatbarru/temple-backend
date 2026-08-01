<?php

namespace App\Repositories;

use App\Models\ServiceType;
use App\Repositories\BaseRepository;

class ServiceTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'slug',
        'display_name',
        'image',
        'image_alt_text',
        'icon',
        'description',
        'tagline'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ServiceType::class;
    }
}
