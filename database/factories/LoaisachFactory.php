<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\loaisach;
use Faker\Generator as Faker;

$factory->define(loaisach::class, function (Faker $faker) {
    return [
        'name' => $faker->name   
     ];
});
