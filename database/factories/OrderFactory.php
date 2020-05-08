<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
        'user_id' => $faker->randomElement([2, 3, 4, 5, 6, 7, 8, 9, 10, 11]),
        'total_price' => $faker->randomFloat(0.5, 10, 100),
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->email,
        'finished_id' => $faker->randomElement(\App\Models\User::whereIn('role', [\App\Models\User::ADMIN, \App\Models\User::STAFF, \App\Models\User::SELLER])->get()->pluck('id')->toArray()),

    ];
})->afterCreating(\App\Models\Order::class, function (\App\Models\Order $order, Faker $faker) {
    $order->total_price = \App\Models\Orderdetail::select(\Illuminate\Support\Facades\DB::raw('sum(sell_price*quantity) as sum'))->where('order_id', '=', $order->id)->get()[0]->sum;
    $order->save();
});
