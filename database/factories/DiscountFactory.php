<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Discount::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->randomElement([strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 10))]),

        'discount' => 100,
        'start_time' => now(),
        'end_time' => date_add(now(), date_interval_create_from_date_string('30 days')),

    ];
});
