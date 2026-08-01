<?php

namespace App\Repositories;

use App\Models\ClienteleCategory;
use App\Repositories\BaseRepository;

class ClienteleCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'display_name',
        'tagline',
        'icon',
        'type'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ClienteleCategory::class;
    }
}
