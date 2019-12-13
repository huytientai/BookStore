<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		\App\Models\Orderdetail::truncate();
		/*\App\Models\Orderdetail::create([
		'order_id'=>1,
		'book_id'=>1,
		'sell_price'=>199,
		'quantity'=>19
		]);*/
		factory(\App\Models\Orderdetail::class, 100)->create();
    }
}
