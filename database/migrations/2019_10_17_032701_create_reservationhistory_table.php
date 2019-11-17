<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ReservationHistory', function (Blueprint $table) {
            $table->bigIncrements('PK_idHist');
            $table->integer('FK_idReservation');
            $table->char('personInCharge',100);
            $table->date('reservationDate');
            $table->char('reservationHour',5);
            $table->integer('FK_idRestaurant');
            $table->integer('FK_reservationCreator'); 
            $table->integer('cardNumber');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ReservationHistory');
    }
}
