<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'guard_name' => 'web',
    ];
});
