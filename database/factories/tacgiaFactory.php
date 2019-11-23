<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tacgia;
use Faker\Generator as Faker;

$factory->define(Tacgia::class, function (Faker $faker) {
    return [
		'tentacgia' => $faker->unique()->name,
		'email' => $faker->unique()->safeEmail,
		'sdt' => $faker->phoneNumber,
		'diachi' => $faker->address
    ];
});
