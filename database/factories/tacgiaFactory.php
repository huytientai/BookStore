<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tacgia;
use Faker\Generator as Faker;

$factory->define(Tacgia::class, function (Faker $faker) {
    return [
		'tacgias_name' => $faker->unique()->name,
		'tacgias_email' => $faker->unique()->safeEmail,
		'tacgias_sdt' => $faker->phoneNumber,
		'tacgias_diachi' => $faker->address
    ];
});
