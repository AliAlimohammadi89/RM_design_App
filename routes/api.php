<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/set_field', 'Api\V1\ConvertHtmlToB2CStoreController@get_field');
Route::get('/set_field', 'Api\V1\ConvertHtmlToB2CStoreController@get_field');



