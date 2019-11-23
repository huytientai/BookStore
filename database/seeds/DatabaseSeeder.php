<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	DB::table('loaisach')->insert([
	'id'=>'01',
	'tenloaisach'=>'truyện cười',
	'created_at'=>'2019-02-02',
	'updated_at'=>'2019-03-02']);

        $this->call(UsersTableSeeder::class);
        $this->call(BooksTableSeeder::class);
    }
}
