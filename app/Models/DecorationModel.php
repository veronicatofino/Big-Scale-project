<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;;
use Illuminate\Database\Eloquent\Model;

class DecorationModel extends Model{

    public static function searchDecoration($idRest){
        $info=DB::table('decoration')->where('FK_idRestaurant',$idRest)->value('PK_idDecoration','type','description');
        return $info;
    }


}
