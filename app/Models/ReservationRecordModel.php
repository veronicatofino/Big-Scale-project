<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Eloquent\Model;

class ReservationRecordModel extends Model{

    public static function getReservationsByUserId($userId){
        $info=DB::table('ReservationHistory')->where('FK_reservationCreator',$userId)
        ->select('personInCharge','reservationDate','reservationHour','FK_idRestaurant','cardNumber')
        ->get();
        return $info;
    }

}