<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('desc', 3000)->nullable();
            $table->string('image')->nullable();
            $table->float('price');
            $table->string('ngayxb')->nullable();
            $table->string('size')->nullable();
            $table->string('loaibia')->nullable();
            $table->integer('sotrang')->nullable();
            $table->timestamps();
            $table->integer('soluong')->default(0);
            $table->integer('virtual_nums')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
