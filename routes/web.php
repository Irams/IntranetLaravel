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


Route::get('/entradas', 'EntradasController@index')->name('entradas.index');
Route::get('/entradas/create', 'EntradasController@create')->name('entradas.create');
Route::post('/entradas', 'EntradasController@store')->name('entradas.store');
Route::get('/entradas/{entradas}', 'EntradasController@show')->name('entradas.show');
Route::get('/entradas/{entradas}/edit', 'EntradasController@edit' )->name('entradas.edit');
Route::put('/entradas/{entradas}', 'EntradasController@update')->name('entradas.update');
Route::delete('/entradas/{entradas}', 'EntradasController@destroy')->name('entradas.destroy');


Auth::routes();