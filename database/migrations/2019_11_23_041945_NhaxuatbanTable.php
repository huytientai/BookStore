<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NhaxuatbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NhaxuatbanTable', function (Blueprint $table) {
            $table->increments('id');
$table->string('nxb_ten');
$table->string('nxb_diachi');
$table->string('nxb_sdt');
$table->string('nxb_email');
$table->string('nxb_website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('NhaxuatbanTable');
    }
}
