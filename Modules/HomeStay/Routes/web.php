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

Route::prefix('admin/homestay')->group(function() {
    Route::get('/requests', 'HomeStayController@index');
    Route::get('/edit/{id}', 'HomeStayController@edit');
    Route::post('/update/{id}', 'HomeStayController@update');
    Route::get('/delegate-export', 'HomeStayController@delegateRequestExport');


    
    Route::prefix('hosts')->group(function() {
        Route::get('/', 'HostController@index');
        Route::get('/add', 'HostController@create');
        Route::post('/add', 'HostController@store');
        Route::get('/edit/{host_id}', 'HostController@edit');
        Route::get('/delete/{host_id}', 'HostController@destroy');
    });
});
