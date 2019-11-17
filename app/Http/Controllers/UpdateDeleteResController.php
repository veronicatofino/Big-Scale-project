<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\ReservationModel;
use Session;

class UpdateDeleteResController extends Controller
{
  public function DeleteReservation($idReservation=0){
    if($idReservation != 0){
      // Delete
      ReservationModel::deleteData($idReservation);
      
     }
    return view('welcome');
  }

  function displayUpdateView() {
    return view('updateData');
  }

  public function UpdateReservation(Request $request){
    $data = array('personInCharge' => $request->personInCharge, 
    'reservationType' => $request->typeReservation,
    'comments' => $request->comments);
    ReservationModel::updateData( $request->session()->get('idReservation'),$data);
    return view('welcome');

  }

  public function DisplayUpdateReservationView(Request $request, $idReservation=0){
    if ($idReservation != 0){
      // Update
      $request->session()->put('idReservation', $idReservation);
      $request->session()->save();
      $data = ReservationModel::getReservationById($idReservation);
      return view('updateData', ['data' => $data]);
      //ReservationModel::updateData($request->idReservation,$data);
    }
    
  }

}
