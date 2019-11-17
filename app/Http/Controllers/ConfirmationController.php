<?php

namespace App\Http\Controllers;

use App\Models\ReservationModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ConfirmationController extends Controller
{
    //
    

    function SaveReservationToBD(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  
        
        //Construct the array to insert it as sql
        $data = array('FK_idRestaurant'=>$request->session()->get('FK_idRestaurant'),
        'FK_reservationCreator'=>$request->session()->get('FK_reservationCreator'),
        'FK_idTable'=>$request->session()->pull('FK_idTable'),
        'FK_idDecoration'=>$request->session()->pull('FK_idDecoration'),
        'personInCharge'=>$request->session()->pull('personInCharge'),
        'reservationDate'=>$request->session()->pull('reservationDate'),
        'reservationHour'=>$request->session()->pull('reservationHour'),
        'reservationType'=>$request->session()->pull('reservationType'),
        'cardNumber'=>$request->session()->pull('cardNumber'),
        'reservationTotal'=>100,
        'availableChairs'=>$request->session()->pull('availableChairs'),
        'comments'=>$request->session()->pull('comments'));
        
        //Insert
        $idReservation = ReservationModel::insertData($data);
        #echo $idReservation;
        $request->session()->put('reservationId', $idReservation);
        
        /*return redirect('181.50.100.167:7000/menu/'.
        (string)$request->session()->pull('FK_reservationCreator').
        '/'.(string)$request->session()->pull('reservationId').
        '/'.(string)$request->session()->pull('FK_idRestaurant'));*/
        return view('menuPrompt', ['FK_reservationCreator' => $request->session()->pull('FK_reservationCreator'),
                                   'reservationId' => $request->session()->pull('reservationId'),
                                   'FK_idRestaurant' => $request->session()->pull('FK_idRestaurant'),
                                   'userName' => $request->session()->pull('userName')]);
    }
}
