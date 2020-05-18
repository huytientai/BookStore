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
        Schema::disableForeignKeyConstraints();

        $this->call(UsersTableSeeder::class);
        $this->call(LoaisachsTableSeeder::class);
        $this->call(TacgiaTableSeeder::class);
        $this->call(NhaxuatbanTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(OrderDetailsTableSeeder::class);
        //to get total price
        $this->call(OrdersTableSeeder::class);

        $this->call(DiscountTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
