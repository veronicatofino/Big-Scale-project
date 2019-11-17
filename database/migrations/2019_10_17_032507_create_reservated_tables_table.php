<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservatedTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservated-tables', function (Blueprint $table) {
            $table->bigIncrements('PK_reservatedTable');
            $table->integer('FK_idTable');
            $table->integer('numberChairs');
            $table->date('reservatedDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservated-tables');
    }
}
