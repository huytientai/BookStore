<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset  database
        \App\Models\User::truncate();

        \App\Models\User::create([
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'name' => 'admin',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::ADMIN,
        ]);

        //create 10 random users
        factory(\App\Models\User::class, 10)->create();

        \App\Models\User::create([
            'email' => 'user@user',
            'password' => Hash::make('123456'),
            'name' => 'user',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::GUESS,
        ]);

        \App\Models\User::create([
            'email' => 'staff@staff',
            'password' => Hash::make('123456'),
            'name' => 'staff',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::STAFF,
        ]);

        \App\Models\User::create([
            'email' => 'warehouseman@warehouseman',
            'password' => Hash::make('123456'),
            'name' => 'warehouseman',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::WAREHOUSEMAN,
        ]);

        \App\Models\User::create([
            'email' => 'seller@seller',
            'password' => Hash::make('123456'),
            'name' => 'seller',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::SELLER,
        ]);

        \App\Models\User::create([
            'email' => 'shipper@shipper',
            'password' => Hash::make('123456'),
            'name' => 'shipper',
            'address' => '46 lê thanh nghị,Hà Nội',
            'address1' => '85 đại cồ việt,Hà Nội',
            'address2' => '226 lê duẩn, Hà Nội',
            'address3' => '175 xã đàn, Hà Nội',
            'phone' => '01682549934',
            'point' => 0,
            'role' => \App\Models\User::SHIPPER,
        ]);
    }
}
