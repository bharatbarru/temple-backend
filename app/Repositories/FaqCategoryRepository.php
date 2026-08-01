<?php

namespace App\Repositories;

use App\Models\FaqCategory;
use App\Repositories\BaseRepository;

class FaqCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'page_type',
        'page_name',
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FaqCategory::class;
    }
}
