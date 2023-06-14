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
    //Route::resource('dishes', 'API\DishesController');
    Route::resource('users', 'API\UserController');
    Route::resource('tables', 'API\TablesController');
    //Route::resource('reserves', 'API\ReservesController');
    Route::get('/userData', 'API\UserController@getUserAuthenticated');

    //users
    Route::get('/users', 'API\UserController@index');//duplicado
    //id de un user
    Route::get('/users/{id}', 'API\UserController@show');

    //datos user autenticado
    Route::put('/profile/{id}', 'API\UserController@update');
    Route::delete('user/delete/{id}', 'API\UserController@destroy');
});

//platos
//Route::get('/dishes', 'API\DishesController@index');
Route::get('dishes', 'API\DishesController@getDishesByCategory');
Route::get('dishes/{category}', 'API\DishesController@getDishesByOneCategory');
Route::get('categories', 'API\DishesController@getAllCategories');

//imagenes
//Route::get('images/dishes', 'API\DishesController@getAssetImages');

//Reservas
Route::get('/reserves', 'API\ReservesController@index');
Route::get('reservesUser', 'API\ReservesController@consultaReserves');