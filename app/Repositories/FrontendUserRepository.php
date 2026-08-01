<?php

namespace App\Repositories;

use App\Models\FrontendUser;
use App\Repositories\BaseRepository;

class FrontendUserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'address',
        'country',
        'state',
        'city',
        'pincode',
        'dob',
        'rashi',
        'birth_star',
        'gothram',
        'spouse_name',
        'children_name',
        'publish'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FrontendUser::class;
    }
}
