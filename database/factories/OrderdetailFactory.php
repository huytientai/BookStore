<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Orderdetail;
use Faker\Generator as Faker;

$factory->define(Orderdetail::class, function (Faker $faker) {
    return [
        //
        'order_id' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
        'book_id' => $faker->unique()->numberBetween($min = 1, $max = 100),
        'quantity' => $faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
    ];
})->afterCreating(\App\Models\Orderdetail::class, function (\App\Models\Orderdetail $orderdetail, Faker $faker) {
    $book = \App\Models\Book::find($orderdetail->book_id);
    $orderdetail->sell_price = $book->price;
    $orderdetail->save();
});
