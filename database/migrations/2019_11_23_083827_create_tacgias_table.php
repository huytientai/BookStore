<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTacgiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tacgias', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->string('born')->nullable();
            $table->string('nationality')->nullable();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->string('desc', 3000)->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('tacgias');
    }
}
