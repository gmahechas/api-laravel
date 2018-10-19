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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['prefix' => 'auth', 'middleware' => ['cors']], function () {
	Route::post('token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
	Route::post('login', 'Api\Auth\AuthController@login');
	Route::post('refresh', 'Api\Auth\AuthController@refresh');
	Route::post('check', 'Api\Auth\AuthController@check')->middleware('auth:api');
});


