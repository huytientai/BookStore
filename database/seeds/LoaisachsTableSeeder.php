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
            ['typesofbook_id' => '1','nametype' => 'truyện cười','created_at'=>'2019-02-02','updated_at'=>'2019-03-02' ],
            ['typesofbook_id' => '2','nametype' => 'truyện trinh thám','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '3','nametype' => 'truyện cổ tích','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '4','nametype' => 'truyện ngụ ngôn','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '5','nametype' => 'sách tâm lý','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '6','nametype' => 'sách giáo dục','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '7','nametype' => 'sách kinh doanh','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '8','nametype' => 'sách cho người già','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '9','nametype' => 'sách cho mẹ và bé','created_at'=>'2019-02-02','updated_at'=>'2019-03-02'],
            ['typesofbook_id' => '10','nametype' => 'sách hạt giống tâm hồn','created_at'=>'2019-02-02','updated_at'=>'2019-03-02']

            //            'role' => \App\Models\User::ADMIN,
        ]);
    }
}
