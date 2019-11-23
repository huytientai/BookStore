<?php

use Illuminate\Database\Seeder;

class loaisachSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset  database
        \App\Models\loaisach::truncate();

        //create 100 random users
        factory(\App\Models\loaisach::class, 10)->create();

        \App\Models\loaisach::create([
            ['id' => '1','tenloaisach' => 'truyện cười','created_at'=>'2019-02-02','updated_at'=>'2019-03-02' ],
            ['id' => '2','tenloaisach' => 'truyện trinh thám','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '3','tenloaisach' => 'truyện cổ tích','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '4','tenloaisach' => 'truyện ngụ ngôn','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '5','tenloaisach' => 'sách tâm lý','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '6','tenloaisach' => 'sách giáo dục','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '7','tenloaisach' => 'sách kinh doanh','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '8','tenloaisach' => 'sách cho người già','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '9','tenloaisach' => 'sách cho mẹ và bé','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['id' => '10','tenloaisach' => 'sách hạt giống tâm hồn','created_at'=>'2019-02-02','updated_at'=>'2019-03-02']

            //            'role' => \App\Models\User::ADMIN,
        ]);
    }
}
