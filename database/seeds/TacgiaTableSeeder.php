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
		\App\Models\tacgia::truncate();
		//factory(\App\Models\tacgia::class, 10)->create();
		 \App\Models\tacgia::create([
            'id' => '1', 
			'name' => 'Xact Group', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0977636696',
			'address' => 'Hà Nội',
             'image' => '1.jpg',
			'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '2', 
			'name' => 'Nguyen Văn Thân', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0977636696',
			'address' => 'Hà Nội',
            'image' => '2.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '3', 
			'name' => 'Trần Văn Nghĩa', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0986588767',
			'address' => 'Hà Nội',
            'image' => '3.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '4', 
			'name' => 'Phạm Tam', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0903864228',
			'address' => 'TP. Hồ Chí Minh',
            'image' => '4.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '5', 
			'name' => 'Nguyễn Thủy Liên', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0912492295',
			'address' => 'Hà Nội',
            'image' => '5.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '6', 
			'name' => 'Kamachi Kazuma', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '',
			'address' => 'Nhật Bản',
            'image' => '6.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '7', 
			'name' => 'Hoài Thanh', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0903998399',
			'address' => '',
            'image' => '7.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '8', 
			'name' => 'Dale Carnegie', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '',
			'address' => '',
            'image' => '8.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '9', 
			'name' => 'Trần Trường Minh', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0907135688',
			'address' => '',
            'image' => '9.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
		\App\Models\tacgia::create([
            'id' => '10', 
			'name' => 'Phạm Hồng', 
			'email' => Str::random(10).'@gmail.com',
			'phone' => '0918838146',
			'address' => '',
            'image' => '10.jpg',
            'created_at' => '2019-02-02', 'updated_at' => '2019-03-02',
        ]);
    }
}
