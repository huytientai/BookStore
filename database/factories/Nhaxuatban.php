<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Nhaxuatban;
use Faker\Generator as Faker;

$factory->define(Nhaxuatban::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'address' => $faker->address,
        'phone' => $faker->unique()->phoneNumber,
        
    ];
})->afterCreating(\App\Models\Nhaxuatban::class, function (\App\Models\Nhaxuatban $nhaxuatban, Faker $faker) {
    $nhaxuatban->image = $nhaxuatban->id . '.jpg';
    $nhaxuatban->save();
});
