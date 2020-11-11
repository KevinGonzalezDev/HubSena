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
    return redirect()->route('Sitio');
});
Route::get('Sitio', 'AdminController@Sitex')->name('Sitio');
Route::GET('PayU', 'AdminController@PayU')->name('PayU');
Route::get('InformacionTipo/{id}', 'AdminController@InformacionTipo')->name('InformacionTipo');
Route::get('InformacionTipo2/{id}', 'AdminController@InformacionTipo2')->name('InformacionTipo2');
Route::get('Videos/{id}', 'AdminController@Videos')->name('Videos');
