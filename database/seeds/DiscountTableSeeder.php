<?php

use Illuminate\Database\Seeder;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Discount::truncate();
        factory(\App\Models\Discount::class, 1)->create();

        \App\Models\Discount::create([
            'code' => '0000000000',
            'discount' => 1,
            'price_condition' => null,
            'num_condition' => 100,
            'start_time' => now(),
            'end_time' => null,
            'creator_id' => 1,
            'deleted_at' => null
        ]);
        \App\Models\Discount::create([
            'code' => 'het_han',
            'discount' => 1,
            'price_condition' => null,
            'num_condition' => 100,
            'start_time' => now(),
            'end_time' => now(),
            'creator_id' => 1,
            'deleted_at' => null
        ]);
        \App\Models\Discount::create([
            'code' => 'het_so_luong',
            'discount' => 1,
            'price_condition' => null,
            'num_condition' => 0,
            'start_time' => now(),
            'end_time' => date_add(now(), date_interval_create_from_date_string('360 days')),
            'creator_id' => 1,
            'deleted_at' => null
        ]);
    }
}
