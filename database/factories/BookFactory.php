<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->text(15),
        'desc' => $faker->paragraph,
        'loaisach_id' => $faker->randomElement([11,12,13,14]),
        'price' => $faker->randomFloat(0.5,10,100),
		'tacgia_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        'nhaxuatban_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
    ];
})->afterCreating(\App\Models\Book::class, function (\App\Models\Book $book, Faker $faker) {
    $book->image = $book->id . '.jpg';
    $book->save();
});
