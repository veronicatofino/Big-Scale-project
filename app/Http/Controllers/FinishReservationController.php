<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FinishReservationController extends Controller
{
    //
    function completeReservation(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  

        //echo $request->reservationType;


        if ($request->reservationType == 'Pública') {
            $request->session()->put('reservationType', 1);
            $availableChairs = $request->session()->get('availableChairs');
            $request->session()->put('availableChairs', $availableChairs - 1);
        }
        else {
            $request->session()->put('reservationType', 0);
        }
        $request->session()->put('personInCharge',$request->personInCharge);
        $request->session()->put('cardNumber',$request->cardNumber);
        $request->session()->put('comments',$request->comments);
        $request->session()->save();
        /*
        print($request->session()->get('reservationDate'));
        print($request->session()->get('reservationHour'));
        print($request->session()->get('availableChairs'));
        print($request->session()->get('FK_idTable'));
        print($request->session()->get('FK_idDecoration'));
        print($request->session()->get('FK_idRestaurant'));
        print($request->session()->get('FK_reservationCreator'));
        */
        $data = array('reservationDate' => $request->session()->get('reservationDate'),
        'reservationHour' => $request->session()->get('reservationHour'),
        'availableChairs' =>  $request->session()->get('availableChairs'),
        'cardNumber' => $request->session()->get('cardNumber'));
        
        return view('confirmation', ['data' => $data,
        'userName' => session()->get('userName')]);
    }
}
