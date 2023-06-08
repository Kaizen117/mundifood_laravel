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

Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
Route::post('logout', 'API\RegisterController@logout');
Route::middleware('auth:api')->group(function(){
    Route::resource('dishes', 'API\DishesController');
    Route::resource('users', 'API\UserController');
    Route::resource('tables', 'API\TablesController');
    Route::resource('reserves', 'API\ReservesController');
});

//users
Route::get('/users', 'API\UserController@index');
//id de un user
Route::get('/users/{id}', 'API\UserController@show');

//datos user autenticado
Route::get('/userData', 'API\UserController@getUserAuthenticated');

Route::put('/profile/{id}', 'API\UserController@update');
Route::delete('user/delete/{id}', 'API\UserController@destroy');

//platos
Route::get('/dishes', 'API\DishesController@index');
