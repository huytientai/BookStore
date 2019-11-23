<?php
/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Nhaxuatban;
use Faker\Generator as Faker;
$factory->define(Nhaxuatban::class, function (Faker $faker) {
    return [
		'nxb_ten' => $faker->unique()->name,
		'nxb_diachi' => $faker->address,
		'nxb_sdt' => $faker->unique()->phoneNumber,
		'nxb_email' => $faker->unique()->safeEmail,
                'nxb_website' => $faker->unique()->name  
];
});
