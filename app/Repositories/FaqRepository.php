<?php

namespace App\Repositories;

use App\Models\Faq;
use App\Repositories\BaseRepository;

class FaqRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'faq_categories_id',
        'question',
        'answer',
        'button_name',
        'button_url',
        'new_window',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Faq::class;
    }
}
