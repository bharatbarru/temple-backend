<?php

namespace App\Repositories;

use App\Models\PhotoGallery;
use App\Repositories\BaseRepository;

class PhotoGalleryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'photo_category_id',
        'image',
        'image_alt_text',
        'title',
        'description',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PhotoGallery::class;
    }
}
