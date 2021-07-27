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

Route::get('password', function() {
    return bcrypt('ulfa');
});

//MOBILE
Route::get('mobil','API\mobileController@index');
Route::post('mobil','API\mobileController@store');
Route::patch('mobil/{id}','API\mobileController@update');
Route::delete('mobil/{id}','API\mobileController@destroy');



//PENYEWAAN
Route::get('penyewaan','API\penywaanController@index');
Route::post('penyewaan','API\penywaanController@store');
Route::patch('penyewaan/{id}','API\penywaanController@update');
Route::delete('penyewaan/{id}','API\penywaanController@destroy');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
