<?php

namespace App\Repositories;

use App\Models\Team;
use App\Repositories\BaseRepository;

class TeamRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'team_categories_id',
        'name',
        'image',
        'image_alt_text',
        'designation',
        'description',
        'linkedin_url',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'github_url',
        'other',
        'sort'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Team::class;
    }
}
