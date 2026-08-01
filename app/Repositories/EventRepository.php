<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'event_category_id',
        'title',
        'slug',
        'image',
        'image_alt_text',
        'start_date_time',
        'end_date_time',
        'short_description',
        'description',
        'custom_url',
        'seo_title',
        'seo_keywords',
        'seo_description',
        'sort',
        'publish'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Event::class;
    }
}
