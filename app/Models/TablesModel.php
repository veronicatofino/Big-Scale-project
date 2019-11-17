<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Eloquent\Model;
class TablesModel extends Model{

    public static function searchTablesAv($data,$amountPeople,$idRestaurant){
        /*
            Function that searchs the available Tables for a given day and an amount of People.
        */
        
        $id_resTables=DB::table('reservated-tables')->where($data)->pluck('FK_idTable');       
        
        $id_Final = DB::table('Tables-Rest')->whereNotIn('PK_idTable',
        $id_resTables)->where('numberChairs','>=',$amountPeople)->where('FK_idRestaurant',
        '=',$idRestaurant)->pluck('PK_idTable');
        if ($id_Final->count() == 0) {
            return null;
        }
        else{
            $idF =  $id_Final[0];  
            return($idF);
        }

    }
    public static function addReservatedTable($idTable,$reservationDate){
        $numberChairs = DB::table('Tables-Rest')->where('PK_idTable',$idTable)->value('numberChairs');
        $data = Array('FK_idTable'=>$idTable,'numberChairs'=>$numberChairs,
        'reservatedDate'=>$reservationDate);
        DB::table('reservated-tables')->insert($data);

    }
    //Return te tables from a restaurant id.
    public static function getTablesByRestaurantId($restaurantId) {
        $info = DB::table('Tables-Rest')->where('FK_idRestaurant',$restaurantId)
        ->select('PK_idTable','FK_idRestaurant','idTableRest','numberChairs')->get();
        return $info;
    }

    public static function addTable($restaurantId, $idTable, $numberChairs){
        $checkExists = DB::table('Tables-Rest')->where('FK_idRestaurant',
        $restaurantId)->where('idTableRest', $idTable)->first();
        if (is_null($checkExists)) {
            $data = array('idTableRest'=>$idTable,'FK_idRestaurant'=>$restaurantId,
            'numberChairs'=>$numberChairs);
            DB::table('Tables-Rest')->insert($data);
            return 1;
        }else{
            return 0;
        }
    }
}
