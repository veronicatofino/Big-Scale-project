<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LogoutController extends Controller
{
    //
    function logout(Request $request) {
        $client = New Client;
        $client->request('POST', 'http://181.50.100.167:4000/logout?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        return redirect()->away('http://181.50.100.167:9000/login/');
    }
}
