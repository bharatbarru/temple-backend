<?php

namespace App\Repositories;

use App\Models\Clientele;
use App\Repositories\BaseRepository;

class ClienteleRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'clientele_category_id',
        'image',
        'image_alt_text',
        'title',
        'sub_title',
        'url',
        'new_window',
        'publish',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Clientele::class;
    }
}
