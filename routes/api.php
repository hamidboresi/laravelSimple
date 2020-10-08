<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::namespace('App\Http\Controllers')->group(function(){
    Route::post('register','Auth\RegisterController@register');
    Route::post('login','Auth\LoginController@login');
    Route::middleware('auth:api')->group(function(){
       Route::post('logout','Auth\LogoutController@logout');
       Route::get('getProfile','UserController@getProfile');
});
});


