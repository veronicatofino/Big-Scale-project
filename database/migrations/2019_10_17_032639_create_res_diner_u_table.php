<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResDinerUTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Res_DinerU', function (Blueprint $table) {
            $table->bigIncrements('PK_idResxPers');
            $table->integer('FK_idReservation');
            $table->integer('FK_idDinerU');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Res_DinerU');
    }
}
