<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use App\Models\TablesModel;
use App\Models\ReservationModel;
use App\Models\Res_DinerUModel;
use App\Models\ReservationRecordModel;

header('Access-Control-Allow-Origin: *'); //esto se debe colocar para que se puedan hacer peticiones 
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");// Esto se debe colocar para que se puedan hacer peticiones


class PublicController extends Controller
{
    public function getActiveReservationsByUserIdAndType ($userId, $type){
       $info = ReservationModel::getReservationsByUserId($userId,  $type);
       /* 
        Construct the Json here
        
      
      $i = 0;
      while ($i < sizeof($info)){
        foreach ( $info[$i] as $key=>$value) {
            $info[$i][$key]['FK_idRestaurant'] = "Holissss";
        }
        $i = $i + 1;
      }
      
      foreach ($info as $reservation) {
          foreach ($reservation as $key=>$value) {
            if ($key == 'FK_idRestaurant') {
                $name = "Funciona";
                #cho $name;
                #route('127.0.0.1:8000/getRestaurantById/' + $value);
                $reservation['FK_idRestaurant'] = $name;
                //$reservation->put($key, $name);
            }
          } 
      }*/

        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }

    public function getReservationsRecordByUserId($userId){
        $info = ReservationRecordModel::getReservationsByUserId($userId);
        /* 
        Construct the Json here
        */
        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }


    public function getPublicReservationsByUserId($userId){
        $info = ReservationModel::getPublicReservations($userId);
        /* 
         Construct the Json here
        */
        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }

    public function getPostulatesByReservationId($reservationId){
        $info = Res_DinerUModel::getPostulatesByReservationId($reservationId);
        /*
        The $info collection has to items: the first is the Id of the postulated 
        and the other is the status where 2 is accepted and 1 is 'still waiting for an answer'.
        */
        
        /* 
         Construct the Json here
        */
        //dd($info);
        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }

    public function deleteReservationByReservationId($reservationId){
        $answer = ReservationModel::deleteData($reservationId);
        $data = ['Response'=>2,'Content'=>$answer];
        return response()->json($data, 200);
    }

    public function addPostulatedByReservationIdAndUserId($reservationId, $userId){
        /*
        If the person exists $answer will return 0. Otherwise return 1 and insert the person.
        */  
        $answer = Res_DinerUModel::addPerson($reservationId,$userId);   
        $data = ['Response'=>2,'Content'=>$answer];
        return response()->json($data, 200);
          
    }

    public function deletePostulatedByReservationIdAndUserId($reservationId, $userId){
        /*
        If the person exists $answer will return 1 and delete the postulated. 
        Otherwise return 0.
        */  
        $answer = Res_DinerUModel::deletePerson($reservationId,$userId);
        $data = ['Response'=>2,'Content'=>$answer];
        return response()->json($data, 200);
    }

    public function updatePostulatedByReservationIdAndUserId($reservationId, $userId, $status){
        /*
        If $answer is 0 is that the $reservationId doesn't exist.
        If $answer is 1 is that there are no more available chairs.
        If $answer is 2 is that the person was accepted/rejected with success.
        If $answer is 3 is that the person is rejected so the status cann't be changed.
        */
        $answer = Res_DinerUModel::changeStatus($reservationId,$userId, $status);
        $data = ['Response'=>2,'Content'=>$answer];
        return response()->json($data, 200);
    }

    public function getPostulatedReservationsByUserId($userId){
        $info = Res_DinerUModel::givePublicResxUserId($userId);
        /* 
         Construct the Json here
        */
        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }
    
    //Doesn't need BD intervation.
    public function createReservationByRestaurantIdAndUserId($restaurantId=0, $userId=0){
        /*$data = array([]);
        $data['content'] = array(['nombre' => 'Laura']);
        $data['restaurantId'] = $restaurantId;
        $data['userId'] = $userId;
        return redirect()->route('displayCreateView', ['data' => $data]);*/
       if ($restaurantId != 0 && $userId != 0){
            $client = New Client;
            $eventData = $client->request('GET', 'http://181.50.100.167:4000/getEvents?id='.(string)$restaurantId);
            //$httpStatus = $decorationData->getStatusCode();
            $body = json_decode($eventData->getBody(), true);
            $response = $body['response'];
            $data = array();
            if ($response == 2) {
                if ($body['content'] != []){
                    $content = $body['content'];
                }
                else{
                    $content = array(["_id" => "0"]);
                }
                $data['content'] = $content;
                $data['restaurantId'] = $restaurantId;
                $data['userId'] = $userId;
                #dd($data);
                return redirect()->route('displayCreateView', ['data' => $data]);
            }else{
                return response()->json([], 404);
            }
            
        }
        
    }

    public function getActiveReservationsByRestaurantId($restaurantId){
        $info = ReservationModel::getReservationsByRestaurantId($restaurantId);
        if ($info->count() == 0){
            $data = ['Response'=>1];
            return response()->json($data, 200);
        }
        else{
            $firstname = "firstname";
            $secondname = "secondname";
            $firstLastname = "firstLastname";
            $secondLastname= "secondLastname";
            $telephone = "telephone";
            foreach ($info as $reservation) {
                foreach ($reservation as $key=>$value) {
                if ($key == 'FK_reservationCreator') {
                    $client = new Client();
                    $userData = $client->request('GET', 'http://159.65.58.193:3000/getDinerNameTelByUserId/' . (string)$value);
                    $httpStatus = $userData->getStatusCode();
                    $body = json_decode($userData->getBody(), true);
                    $response = $body['Response'];
                    if ($response == 2) {
                        $content = $body['Content'];
                        $reservation->$firstname = $content['firstname'];
                        $reservation->$secondname = $content['secondname'];
                        $reservation->$firstLastname = $content['firstLastname'];
                        $reservation->$secondLastname = $content['secondLastname'];
                        $reservation->$telephone = $content['telephone'];
                    }     
                }
                } 
            }
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }

    public function addTable($restaurantId, $tableId, $numberChairs) {  
        $answer = TablesModel::addTable($restaurantId,$tableId,$numberChairs);
        $data = ['Content'=>$answer];
        $data['Response'] = 2;
        return response()->json($data,200);
    }


    public function getTablesByRestaurantId($restaurantId=0){ // Get the reservations from a restaurant
        if ($restaurantId != 0){
            $info = TablesModel::getTablesByRestaurantId($restaurantId);
            //$info = 1;
            $data = ['Response'=>2,'Content'=>$info];
            return response()->json($data, 200);
        }
    }

    public function DeleteReservation($idReservation=0){
        if($idReservation != 0){
            // Delete
            ReservationModel::deleteData($idReservation);
            return view('welcome');
            //return response()->json([], 200);
            
        }
    }

    public function UpdateReservation($idReservation=0){
        return redirect('displayUpdateReservationView/'.(string)$idReservation);
    }

    public function getCommentsByRestaurantId($restaurantId){
        $comments = ReservationModel::getCommentByRestaurantId($restaurantId);
        $data = ['Response'=>2,'Content'=>$comments];
        return response()->json($data, 200);

    }

    public function updateReservationTypeByReservationId($idReservation){
        $answer=ReservationModel::changeType($idReservation);
        $data= ['Response'=>2,'Content'=>$answer];
        return response()->json($data,200);
    }

}