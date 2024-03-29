<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'password' => Hash::make($faker->password),
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'role' => array_rand(User::$roles),
    ];
});
