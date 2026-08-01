<?php

namespace App\Repositories;

use App\Models\ApplicationSettingType;
use App\Repositories\BaseRepository;

class ApplicationSettingTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'type',
        'slug'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ApplicationSettingType::class;
    }
}
