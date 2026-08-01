<?php

namespace App\Repositories;

use App\Models\ApplicationSettingCategory;
use App\Repositories\BaseRepository;

class ApplicationSettingCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ApplicationSettingCategory::class;
    }
}
