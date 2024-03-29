<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->float('total_price');
            $table->float('ship_fee')->default(0);
            $table->integer('status')->default(0);

            // customer info
            $table->string('name', 255);
            $table->string('phone', 15);
            $table->string('email', 100);
            $table->string('address', 255);
            $table->string('company', 255)->nullable();

            // payment
            $table->string('payment', 255)->default('offline');
            $table->string('transId', 255)->nullable();
            $table->string('payUrl', 255)->nullable();
            $table->boolean('pay_status')->default(false);
            $table->boolean('payback')->default(false);

            $table->integer('returns_request')->default(0);

            $table->unsignedBigInteger('seller_id')->nullable()->default(null);
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('warehouseman_id')->nullable()->default(null);
            $table->foreign('warehouseman_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('shipper_id')->nullable()->default(null);
            $table->foreign('shipper_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('warehouse1_id')->nullable()->default(null);
            $table->foreign('warehouse1_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
