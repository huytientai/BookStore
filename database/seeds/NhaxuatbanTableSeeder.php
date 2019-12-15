<?php

use Illuminate\Database\Seeder;

class NhaxuatbanTableSeeder extends Seeder
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
        //factory(\App\Models\Nhaxuatban::class, 10)->create();
        \App\Models\Nhaxuatban::create([
            'id' => '1',
            'name' => 'nhà xuất bản chính trị quốc gia',
            'address' => 'số 6/86 Duy Tân, Cầu Giấy, Hà Nội',
            'phone' => '0973937543',
            'image' => '1.jpg',
            'created_at' => '2019-06-02', 'updated_at' => '2019-07-02',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '2',
            'name' => 'Nhà xuất bản giáo dục',
            'address' => '81 Trần Hưng Đạo, Hà Nội',
            'phone' => '0876047865',
            'image' => '2.jpg',
            'created_at' => '2019-03-08', 'updated_at' => '2019-07-08',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '3',
            'name' => 'nhà xuất bản Kim Đồng',
            'address' => '55 Quang Trung, Hai Bà Trưng, Hà Nội',
            'phone' => '0749365498',
            'image' => '3.jpg',
            'created_at' => '2017-04-12', 'updated_at' => '2018-11-08',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '4',
            'name' => 'Nhà xuất bản lao động',
            'address' => '175 Giảng Võ, Đống Đa, Hà Nội',
            'phone' => '0965875450',
            'image' => '4.jpg',
            'created_at' => '2018-08-08', 'updated_at' => '2018-12-01',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '5',
            'name' => 'Nhà xuất bản phụ nữ',
            'address' => '80 Trần Hưng Đạo,Hoàn Kiếm,Hà Nội',
            'phone' => '08976634445',
            'image' => '5.jpg',
            'created_at' => '2017-10-11', 'updated_at' => '2018-11-21',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '6',
            'name' => 'Nhà xuất bản thông tin truyền thông',
            'address' => 'số 115 Trần Duy Hưng, Hà Nội',
            'phone' => '0988767890',
            'image' => '6.jpg',
            'created_at' => '2018-02-14', 'updated_at' => '2018-11-27',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '7',
            'name' => 'Nhà xuất bản Tổng hợp',
            'address' => 'số 64 Nguyễn Du, Hà Nội',
            'phone' => '0944567898',
            'image' => '7.jpg',
            'created_at' => '2013-02-15', 'updated_at' => '2014-12-12',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '8',
            'name' => 'Nhà xuất bản Trẻ',
            'address' => '63 Nguyễn Thị Minh Khai,Quận 1,TP.HCM',
            'phone' => '0978567455',
            'image' => '8.jpg',
            'created_at' => '2011-04-16', 'updated_at' => '2015-11-23',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '9',
            'name' => 'nhà xuất bản Tri Thức',
            'address' => '161B Lý Chính Thắng, Quận 3, Thành phố Hồ Chí Minh',
            'phone' => '0956388769',
            'image' => '9.jpg',
            'created_at' => '2012-12-15', 'updated_at' => '2015-11-12',
        ]);
        \App\Models\Nhaxuatban::create([
            'id' => '10',
            'name' => 'Nhà xuất bản Đại Học Sư Phạm',
            'address' => 'số 35 Trần Quốc Toản, Hoàn Kiếm, Hà Nội',
            'phone' => '0988725679',
            'image' => '10.jpg',
            'created_at' => '2013-12-25', 'updated_at' => '2017-13-21',
        ]);

    }
}
