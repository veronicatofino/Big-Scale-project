<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesRestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tables-Rest', function (Blueprint $table) {
            $table->bigIncrements('PK_idTable');
            $table->integer('FK_idRestaurant');
            $table->integer('idTableRest');
            $table->integer('numberChairs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tables-Rest');
    }
}
