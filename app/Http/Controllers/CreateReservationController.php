<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TablesModel;
use App\CreateReservation;
use App\CreateReservationModel;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CreateReservationController extends Controller
{
	/*
	protected function validator(array $data){
        return Validator::make($data, [
            'personInCharge' => ['required', 'string', 'max:50'],
            'reservationDate' => ['required', 'date(d/m/Y)'],
            'reservationHour' => ['required', 'string', 'max:5'],
            'reservationType' => ['required', 'string'],
            'amountOfPeople' => ['required', 'number_format(100)']
        ]);
    }*/
    
    //const VIEW = 'createReservation';

    /*
     * Displays the reservation view.
     * @param request $request
     * @returns a view
     */
    function displayCreateView(Request $request){
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->data['userId']);
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');
        }
        
        #dd($request->data);
        $restaurantId = $request->data['restaurantId'];
        $userId = $request->data['userId'];
        $events = $request->data['content'];
               

        $client2 = new Client;
        $eventData = $client2->request('GET', 'http://181.50.100.167:4000/getNameUser?id='.(string)$userId);
        //$httpStatus = $decorationData->getStatusCode();
        $body = json_decode($eventData->getBody(), true);
        $response = $body['response'];
        if ($response == 2) {
            $userNameData = $body['content'];
            $userName = $userNameData['name'];
            session()->put('userName', $userName);
        }      
        session()->put('FK_idRestaurant', $restaurantId);
        session()->put('FK_reservationCreator', $userId);
        session()->save();
        /*foreach ($events as $event){
            foreach ($event as $key=>$value){
                echo $value;
            }
        }*/

        // if atributte 'tablesNotFound' is 0 then theres is no problem so far
        return view('createReservation', ['events' => $events,
                                          'tablesNotFound' => 0,
                                          'userName' => session()->get('userName')]); 
    }

    /*
     * Create a new Reservation after a valid input
     * and redirects to the table selection view.
     * @param  array  $request
     * @return Creates a view 
     */
    function BeginReservationAndRedirectToTables(Request $request) {
        $client = New Client;
        $verifiyLogin = $client->request('GET', 'http://181.50.100.167:4000/validateSession?id='. 
        (string)$request->session()->get("FK_reservationCreator"));
        $body = json_decode($verifiyLogin->getBody(), true);
        $response = $body['response'];
        if ($response == 1) {
            return redirect()->away('http://181.50.100.167:9000/login/');

        }   
        $request->session()->put('availableChairs',$request->availableChairs);
        $request->session()->put('reservationDate',$request->reservationDate);
        $this->validate($request, ['reservationHour' => 'date_format:H:i']);
        $request->session()->put('reservationHour',$request->reservationHour);
        $this->validate($request, ['availableChairs' => 
                array('required', 'regex:/(^[1-9][0-9]*$)/u')]);
        $request->session()->put('availableChairs',$request->availableChairs);        
        
        // Get the first available table for that specific petition.
        $data = Array (['reservatedDate', '=', $request->reservationDate],
        ['numberChairs','>=',$request->availableChairs]);
        $table_Av = TablesModel::searchTablesAv($data,$request->availableChairs,
        $request->session()->get('FK_idRestaurant'));

        // If theres a table that works, we save it in the user session.
        if ($table_Av != null) {
            $request->session()->put('FK_idTable', $table_Av);
            $request->session()->save();
            return view('tables', ['table' => $table_Av,
                                   'userName' => session()->get('userName')]); 
        }
        else{
            echo "No hay mesa";
            /* Here we use the restaurant's REST API to get the current events 
            that are going to take place at the restaurant*/
            $client = New Client;
            $idRestaurant = $request->session()->get('FK_idRestaurant');
            $eventData = $client->request('GET', 'http://181.50.100.167:4000/getEvents?id='.(string)$idRestaurant);
            //$httpStatus = $decorationData->getStatusCode();
            $body = json_decode($eventData->getBody(), true);
            $response = $body['response'];
            if ($response == 2) {
                if ($body['content'] != []){
                    $events = $body['content'];
                }
                else{
                    $events = array(["_id" => "0"]);
                }
                foreach ($events as $event){
                    foreach ($event as $key=>$value){
                        echo $value;
                    }
                }
                // if atributte 'tablesNotFound' is 1 then theres no tables available
                return view('createReservation', ['events' => $events,
                                                  'tablesNotFound' => 1,
                                                  'userName' => session()->get('userName')]);
            }       
        }
    }

}