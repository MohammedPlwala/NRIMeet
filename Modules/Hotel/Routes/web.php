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

Route::prefix('admin')->group(function() {
    Route::prefix('hotel')->group(function() {
        Route::get('/', 'HotelController@index');
        Route::get('/update', 'HotelController@updateHotel');
        Route::get('/import', 'HotelController@import');
        Route::get('/rooms', 'HotelController@rooms');
        Route::get('/rooms/add', 'HotelController@roomUpdate');
        
        Route::get('/rooms/add', 'HotelController@roomUpdate');
        Route::post('/rooms/add', 'HotelController@roomStore');
        Route::get('/rooms/edit/{room_id}', 'HotelController@roomEdit');

        Route::get('/booking', 'HotelController@booking');

    });
});
