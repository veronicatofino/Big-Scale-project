<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Done //Tested
Route::get('getActiveReservationsByUserIdAndType/{userId}/{type}', 'PublicController@getActiveReservationsByUserIdAndType');

//Done //Tested
Route::get('getReservationsRecordByUserId/{userId}', 'PublicController@getReservationsRecordByUserId');

//Add the paging part
Route::get('getPublicReservationsByUserId/{userId}', 'PublicController@getPublicReservationsByUserId');

//Done //Tested
Route::get('getPostulatesByReservationId/{reservationId}','PublicController@getPostulatesByReservationId');

//Done //Tested
Route::post('deleteReservationByReservationId/{reservationId}','PublicController@deleteReservationByReservationId');

//Done //Tested
Route::post('addPostulatedByReservationIdAndUserId/{reservationId}/{userId}','PublicController@addPostulatedByReservationIdAndUserId');

//Done //tested
#Route::post('deletePostulatedByReservationIdAndUserId/{reservationId}/{userdId}','PublicController@deletePostulatedByReservationIdAndUserId');

//Done //Tested
Route::post('updatePostulatedByReservationIdAndUserId/{reservationId}/{userdId}/{status}','PublicController@updatePostulatedByReservationIdAndUserId');

//Done //Tested
Route::get('getPostulatedReservationsByUserId/{userId}','PublicController@getPostulatedReservationsByUserId');

//Doesn't require intervation of the Database, this data has to be save in the session.
Route::get('createReservationByRestaurantIdAndUserId/{restaurantId}/{userId}', 'PublicController@createReservationByRestaurantIdAndUserId');

//Done // Tested
Route::get('getTablesByRestaurantId/{restaurantId}','PublicController@getTablesByRestaurantId');


Route::get('addTable/{restaurantId}/{tableId}/{numberChairs}','PublicController@addTable');

Route::get('updateReservation/{idReservation}','PublicController@UpdateReservation');


Route::get('getCommentsByRestaurantId/{restaurantId}','PublicController@getCommentsByRestaurantId');


Route::post('updateReservationTypeByReservationId/{reservationId}', 'PublicController@updateReservationTypeByReservationId');