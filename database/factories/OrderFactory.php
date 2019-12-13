<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
		'user_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
		'total_price' => $faker->randomFloat(0.5,10,100)
    ];
});
