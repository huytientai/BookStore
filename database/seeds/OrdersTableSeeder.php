<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		\App\Models\Order::truncate();
        factory(\App\Models\Order::class, 10)->create();
    }
}
