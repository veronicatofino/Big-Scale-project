<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('PK_idReservation');
            $table->integer('FK_idRestaurant');
            $table->integer('FK_reservationCreator');
            $table->integer('FK_idTable');
            $table->integer('FK_idDecoration');
            $table->char('personInCharge',100);
            $table->date('reservationDate');
            $table->char('reservationHour',5);
            $table->integer('reservationType'); #where 0 is private and 1 is public.
            $table->float('cardNumber',200,3);
            $table->float('reservationTotal',200,3);
            $table->integer('availableChairs'); 
            /*
                This attribute replaces the attribute called 'amountOfPeople' so if a reservation is 
                private there are 0 available chairs, but if the reservation is public there are 
                ('amountOfPeople'-1) availableChairs.
            */
            #$table->reservationStatus            
            $table->text('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
