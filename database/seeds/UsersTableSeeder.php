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
            'role' => \App\Models\User::ADMIN,
        ]);

        //create 10 random users
        factory(\App\Models\User::class, 10)->create();
    }
}
