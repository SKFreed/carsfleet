<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('park', 'ParkController');
Route::resource('park.car','CarController');

/*Route::get('park.edit/{id}', 'ParkController@edit')->name('park.edit');
Route::post('park.update', 'ParkController@update')->name('park.update');
Route::delete('park.destroy/{id}', 'ParkController@destroy')->name('park.destroy');
Route::get('show/{id}', 'ParkController@show')->name('show');
Route::post('park.store', 'ParkController@store')->name('park.store');
Route::get('park.create', 'ParkController@create')->name('park.create');
Route::get('park.index', 'ParkController@index')->name('park.index');*/


/* Route::get("/","StartController@index"); */
