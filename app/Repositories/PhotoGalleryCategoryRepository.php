<?php

namespace App\Repositories;

use App\Models\PhotoGalleryCategory;
use App\Repositories\BaseRepository;

class PhotoGalleryCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'display_name',
        'icon',
        'image',
        'image_alt_text',
        'button_name',
        'button_url',
        'new_window',
        'type',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PhotoGalleryCategory::class;
    }
}
