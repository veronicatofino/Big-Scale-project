<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Eloquent\Model;

class Res_DinerUModel extends Model{

    public static function addPerson($reservationId,$userId){
       /*
            Function that adds a new DinerUser that applies for a public reservation.
        */
        $checkExists = DB::table('Res_DinerU')->where('FK_idReservation','=',
        $reservationId)->where('FK_idDinerU', '=', $userId)->first();

        if (is_null($checkExists)) {
            $data = array('FK_idReservation'=>$reservationId,
            'FK_idDinerU'=>$userId,
            'status'=>1);
            DB::table('Res_DinerU')->insert($data);
            return 1;
        }else{
            return 0;
        }
    }

    public static function changeStatus($reservationId,$userId, $status){
        /*
            Function that changes the status (if the DinerUser is accepted) of a new DinerUser that applies for a public reservation.
        */
        $data = DB::table('reservations')->select('reservations.availableChairs','Res_DinerU.status')
        ->join('Res_DinerU', 'Res_DinerU.FK_idReservation', '=', 'reservations.PK_idReservation')->where('PK_idReservation',
        $reservationId)->where('Res_DinerU.FK_idDinerU',$userId)->get();
        if ($data->count() == 0){
            return 0; #The postulation wasn't found.
        }else{
            $availableChairsNum = ((array)$data->get(0))['availableChairs'];
            $statusOld = ((array)$data->get(0))['status'];
            #dd ($statusOld,$availableChairsNum);
            if ($statusOld != 3){
                if ($availableChairsNum > 0){
                    DB::table('Res_DinerU')->where('FK_idReservation', '=', $reservationId)
                    ->where('FK_idDinerU', '=', $userId)->update(['status'=>$status]);
                    if ($status == 2){
                        DB::table('reservations')->where('PK_idReservation',$reservationId)
                        ->update(['availableChairs'=>$availableChairsNum - 1]);
                    }elseif ($status == 3 and $statusOld == 2){
                        DB::table('reservations')->where('PK_idReservation',$reservationId)
                        ->update(['availableChairs'=>$availableChairsNum + 1]);
                    }
                    return 2; #The status was updated sucessfuly.
                }
                return 1; #There are no more available chairs
            }
            return 3; #The person was rejected this status cannot be changed anymore.
        }
    }
    
    public static function deletePerson($reservationId,$userId){
        /*
            Function that deletes a new DinerUser for a public reservation.
        */
        DB::table('Res_DinerU')->where('FK_idReservation', '=', $reservationId)
        ->where('FK_idDinerU', '=', $userId)->delete();
        return 1;
    }

    public static function givePublicResxUserId($userId){
        /*
            Function that returns all the public reservations that a postulated person has.
        */ 

        #$theReservations = DB::table('Res_DinerU')->where('FK_idDinerU',$userId)->pluck('FK_idReservation');
        $infoReservations = DB::table('reservations')->select('PK_idReservation','FK_idRestaurant','FK_reservationCreator',
                'personInCharge','reservationDate','reservationHour', 'Res_DinerU.status')
                ->join('Res_DinerU', 'Res_DinerU.FK_idReservation', '=', 'reservations.PK_idReservation')
                ->where('Res_DinerU.FK_idDinerU',$userId)->get();
        return $infoReservations;
    }

    public static function getPostulatesByReservationId($reservationId){
        /*
            Function that returns all the Postulates of a reservation.
        */ 
        $info=DB::table('Res_DinerU')->where('FK_idReservation',$reservationId)
        ->select('FK_idDinerU','status')->get();
        return $info;
    }
}