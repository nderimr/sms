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


// List all parts 
Route::get('parts','PartController@index');
//display a single part
Route::get('part/{id}','PartController@show');
//create new part
Route::post('part','PartController@store');
//store array of parts
Route::post('parts','PartController@storeArr');
//update part
Route::put('part/{id}','PartController@update');
//Delete part
Route::delete('part/{id}','PartController@destroy');