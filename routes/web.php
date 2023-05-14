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

Route::namespace('App\Http\Controllers')->middleware('cek.apikey')->group(function(){

    Route::get('login', 'PenggunaController@login');
    Route::delete('login', 'PenggunaController@logout');
    
    Route::group(['prefix' => 'pengguna', 'middleware' => ['cek.apikey']], function(){
        Route::patch('/', 'PenggunaController@update');
        Route::post('/photo', 'PenggunaController@simpanfoto');
        Route::get('photo', 'PenggunaController@foto');
    });
    
    Route::prefix('warga')->middleware('cek.user')->group(function(){
        Route::post('/', 'WargaController@store');
        Route::patch('/{w}','WargaController@update');
        Route::delete('/{w}', 'WargaController@delete');
        Route::get('/{w}', 'WargaController@show');
    });

});