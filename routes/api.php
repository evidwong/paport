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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('access_token','API\OAuthController@access_token');
Route::post('refresh_token','API\OAuthController@refresh_token');

Route::group(['middleware'=>['auth:api','test']],function(){
	Route::any('info','API\OAuthController@getInfo');
});