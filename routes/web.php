<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


//Route::get('/createReservation', 'CreateReservationController@displayView'); // Es api
Route::post('/searchTables','CreateReservationController@BeginReservationAndRedirectToTables');
Route::post('/selectTable','SearchTablesController@SelectTableAndRedirectToMenu');
Route::get('/skipMenu','MenuController@SkipMenu');
Route::post('/saveMenu','MenuController@SaveMenu');
Route::get('/menusAvailable','MenuController@MenusAvailable');
Route::get('/skipDecoration','DecorationController@SkipDecoration');
Route::post('/saveDecoration','DecorationController@SaveDecoration');
Route::get('/decorationsAvailable','DecorationController@DecorationsAvailable');
Route::get ('/displayUpdateReservationView/{reservationId}','UpdateDeleteResController@DisplayUpdateReservationView'); // Es api
Route::post('/confirmation','ConfirmationController@SaveReservationToBD');
Route::post('/completeReservation', 'FinishReservationController@completeReservation');
Route::get('/displayUpdateView', 'UpdateDeleteResController@displayUpdateView');
Route::get('/displayCreateView', 'CreateReservationController@displayView')->name('displayCreateView');
//Route::get('/displayCreateView/{restaurantId}/{userId}', 'CreateReservationController@displayView');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/salir', 'LogoutController@logout');


