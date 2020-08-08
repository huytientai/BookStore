<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->primary();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->integer('status');

            $table->string('ship_merchant', 255);
            $table->string('ship_id', 255);
            $table->string('image', 255)->nullable();

            $table->unsignedBigInteger('warehouseman_id')->nullable();
            $table->foreign('warehouseman_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
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
        Schema::dropIfExists('returns');
    }
}
