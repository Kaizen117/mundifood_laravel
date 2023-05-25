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

Route::get('users', 'AdminController@index');
Route::get('users/new', 'AdminController@create');
Route::post('users/confirm', 'AdminController@store');
Route::get('users/edit/{id}', 'AdminController@edit');
Route::post('users/edit/{id}', 'AdminController@update');
Route::get('users/{id}/edit-password', 'AdminController@password_edit')->name('users.edit-password');
Route::post('users/edit/{id}/password', 'AdminController@password_update');
Route::get('users/delete/{id}', 'AdminController@destroy');

Route::delete('/users/{id}', 'AdminController@destroy')->name('users.destroy');

//Route::post('users/{username}/editProfile', 'UserController@store');
//Route::get('users/{username}/edit', 'UserController@update');

Route::get('dishes', 'DishController@index');
Route::get('dishes/new', 'DishController@create');
Route::post('dishes/confirm', 'DishController@store');
Route::get('dishes/edit/{id}', 'DishController@edit');
Route::post('dishes/edit/{id}', 'DishController@update');
Route::get('dishes/delete/{id}', 'DishController@destroy');

Route::get('tables', 'TableController@index');
Route::get('tables/new', 'TableController@create');
Route::post('tables/confirm', 'TableController@store');
Route::get('tables/edit/{id}', 'TableController@edit');
Route::post('tables/edit/{id}', 'TableController@update');
Route::get('tables/delete/{id}', 'TableController@destroy');

Route::get('reserves', 'ReserveController@index');
Route::get('reserves/new', 'ReserveController@create');
Route::post('reserves/confirm', 'ReserveController@store');
Route::get('reserves/edit/{id}', 'ReserveController@edit');
Route::post('reserves/edit/{id}', 'ReserveController@update');
Route::get('reserves/delete/{id}', 'ReserveController@destroy');

/*Route::get('orders', 'OrderController@index');
Route::get('orders/new', 'OrderController@create');*/

Route::get('who', 'UserController@who');
Route::get('work', 'UserController@work');
Route::get('FAQS', 'UserController@faqs');
Route::get('news', 'UserController@news');

Route::get('menu', 'DishController@menu');
Route::get('/carta_mundifood', 'PDFController@index')->name('dishes');

Route::post('/sendEmail', 'AdminController@sendEmail')->name('sendEmail');
