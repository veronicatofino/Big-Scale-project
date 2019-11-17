<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model{

    public static function insertData($data){
        $id=DB::table('reservations')->insertGetId($data);
        return $id;
    }

    public static function updateData($id,$data){
        DB::table('reservations')->where('PK_idReservation',$id)->update($data);
    }

    public static function deleteData($id){
        DB::table('reservations')->where('PK_idReservation', '=', $id)->delete();
        return 1;
    }

    public static function getReservationsByUserId($userId, $type){
        $info = DB::table('reservations')->where('FK_reservationCreator',$userId)->where('reservationType',$type)
        ->select('PK_idReservation','FK_idRestaurant','FK_idDecoration','personInCharge','reservationDate',
        'reservationHour','cardNumber','reservationTotal','availableChairs')->get();
        
        return $info;
    }

    public static function getReservationById($id){
        $info = DB::table('reservations')->where('PK_idReservation',$id)
        ->select('personInCharge', 'comments')->get();
        
        return $info;
    }

    public static function getPublicReservations($userId){
        $idsRes = DB::table('Res_DinerU')->where('FK_idDinerU',$userId)->pluck('FK_idReservation');
        
        $info = DB::table('reservations')->where('reservationType',1)->where('availableChairs','>',0)
        ->whereNotIn('PK_idReservation',$idsRes)->where('FK_reservationCreator',"!=",$userId)
        ->select('PK_idReservation','FK_idRestaurant','FK_reservationCreator','personInCharge',
                'reservationDate','reservationHour')->get();
        return $info;
    }

    public static function getReservationsByRestaurantId($restaurantId){
        $info = DB::table('reservations') ->select('reservations.PK_idReservation','reservations.FK_reservationCreator','Tables-Rest.idTableRest','reservations.reservationDate')
        ->join('Tables-Rest', 'Tables-Rest.PK_idTable', '=', 'reservations.FK_idTable')
        ->where('reservations.FK_idRestaurant',$restaurantId)
        ->get();
        return $info;
    }

    public static function getCommentByRestaurantId($restaurantId){
        $info = DB::table('reservations')
        ->select('reservations.PK_idReservation',
        'reservations.comments')
        ->where('reservations.FK_idRestaurant',$restaurantId)
        ->get();
        return $info;
    }

    public static function changeType($reservationId){
        $actualType = DB::table('reservations')->where('PK_idReservation',
        $reservationId)->pluck('reservationtype'); 
        if ($actualType->count() == 0){
            return 0;
        }else{
            $numberChairs = DB::table('reservations')->where('PK_idReservation',
                $reservationId)->pluck('availableChairs');
            if($actualType[0] == 0){
                DB::table('reservations')->where('PK_idReservation',$reservationId)
                ->update(['reservationtype'=>1,'availableChairs'=>$numberChairs[0]-1]);
            }elseif($actualType[0] == 1){
                $numberCh = DB::table('Res_DinerU')->where('FK_idReservation',
                $reservationId)->where('status',2)->pluck('status');
                $number = $numberCh->count();
                DB::table('reservations')->where('PK_idReservation',$reservationId)
                ->update(['reservationtype'=>0, 'availableChairs'=>$number + $numberChairs[0] + 1]);               
                DB::table('Res_DinerU')->where('FK_idReservation', '=', $reservationId)->delete();
            }
            return 1;
        } 
    }
}