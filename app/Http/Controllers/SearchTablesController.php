<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TablesModel;
use GuzzleHttp\Client;

class SearchTablesController extends Controller
{

	/*
	 * @param Request request Represents the request.
	 * @return The menu view 
	 */
	function SelectTableAndRedirectToMenu(Request $request) {
		$client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }  
		TablesModel::addReservatedTable($request->session()->get('FK_idTable'),$request->session()->get('reservationDate'));
		return view('decorationPrompt', ['userName' => session()->get('userName')]);
	}
}
