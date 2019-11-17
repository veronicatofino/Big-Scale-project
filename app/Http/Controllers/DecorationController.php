<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DecorationController extends Controller
{
    //
    function SaveDecoration(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  
        $result = $_POST['decorRadio'];
        if ($result != null) {
            $request->session()->put('FK_idDecoration', $result);
        }
        return $this->SaveDecorationAndRedirectToConfirmation($request);
    }
    
    function SkipDecoration(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  
        return $this->SaveDecorationAndRedirectToConfirmation($request);
    }

    function DecorationsAvailable(Request $request){
        $client = New Client;
        $decorationData = $client->request('GET', 'http://181.50.100.167:4000/getDecorations?id='. 
        (string)$request->session()->get("FK_idRestaurant"));
        //$httpStatus = $decorationData->getStatusCode();
        $body = json_decode($decorationData->getBody(), true);

        $response = $body['response'];
        if ($response == 2) {
            $content = $body['content'];
            return view('decorationAvailable', ['decorations' => $content,
                                                            'userName' => session()->get('userName')]);
        } 
        else{
            return response()->json([], 404);
        }
        /*$decorations = array( "title" => "Rear Window",
        "director" => "Alfred Hitchcock",
        "year" => 1954 ); 
        return view('decorationAvailable', ['decorations' => $decorations]);*/
    }

    function SaveDecorationAndRedirectToConfirmation(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  
        if (!$request->session()->has('FK_idDecoration')) {
            $request->session()->put('FK_idDecoration', 0);
        }
        $request->session()->save();
        
        return view('preconfirmation', ['userName' => session()->get('userName')]);
    }
}
