<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::truncate();
        //
        \App\Models\Loaisach::create([
            ['id'=>'1','name'=>'admin','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id'=>'2','name'=>'staff','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id'=>'3','name'=>'guess','created_at'=>'2019-02-02','updated_at'=>'2019-03-02']
        ]);

    }
}
