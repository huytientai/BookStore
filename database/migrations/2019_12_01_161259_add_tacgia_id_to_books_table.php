<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTacgiaIdToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            //
			$table->unsignedBigInteger('tacgia_id');

            $table->foreign('tacgia_id')->references('id')->on('tacgias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            //
			$table->dropForeign('books_tacgia_id_foreign');
            $table->dropColumn('tacgia_id');
        });
    }
}
