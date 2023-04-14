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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/success', 'UserController@success');

Route::get('users', 'UserController@index');
Route::get('users/new', 'AdminController@create');
Route::post('users/confirm', 'AdminController@store');
Route::get('users/edit/{id}', 'AdminController@edit');
Route::get('users/delete/{id}', 'AdminController@destroy');
//Route::get('/users/activate/{id}', 'AdminController@activate');
//Route::get('/users/deactivate/{id}', 'AdminController@deactivate');

Route::post('users/{username}/editProfile', 'UserController@store');
//Route::get('users/{username}/edit', 'UserController@update');

Route::get('menu', 'DishController@menu');
Route::get('dishes', 'DishController@index');
Route::get('dishes/new', 'DishController@create');
Route::get('dishes/edit/{id}', 'DishController@edit');
Route::get('dishes/delete/{id}', 'DishController@destroy');

Route::get('tables', 'TableController@index');
Route::get('tables/new', 'TableController@create');
Route::get('tables/edit/{id}', 'TableController@edit');
Route::get('tables/delete/{id}', 'TableController@destroy');

Route::get('reserves', 'ReserveController@index');
Route::get('reserves/new', 'ReserveController@create');
Route::get('reserves/edit/{id}', 'ReserveController@edit');
Route::get('reserves/delete/{id}', 'ReserveController@destroy');

Route::get('orders', 'OrderController@index');
Route::get('orders/new', 'OrderController@create');

Route::get('who', 'UserController@who');
Route::get('work', 'UserController@work');
Route::get('FAQS', 'UserController@faqs');

Route::get('mundifood_menu', 'PDFController@dishes')->name('dishes');

Route::post('/sendEmail', 'UserController@sendEmail')->name('sendEmail');
