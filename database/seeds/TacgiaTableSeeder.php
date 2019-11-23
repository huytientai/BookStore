<?php

use Illuminate\Database\Seeder;

class TacgiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		\App\Models\Tacgia::truncate();
		factory(\App\Models\Tacgia::class, 10)->create();
    }
}
