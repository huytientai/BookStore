<?php

use Illuminate\Database\Seeder;

class NhaxuatbanTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
\App\Models\Nhaxuatban::truncate();
        factory(\App\Models\Nhaxuatban::class, 10)->create();
    }
}
