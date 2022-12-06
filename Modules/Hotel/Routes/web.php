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
        Route::get('/import', 'HotelController@import');

        Route::get('/add', 'HotelController@create');
        Route::get('/edit/{hotel_id}', 'HotelController@edit');
        Route::post('/add', 'HotelController@store');
        Route::get('/delete/{hotel_id}', 'HotelController@destroy');
        
        Route::prefix('rooms')->group(function() {
            Route::get('/', 'HotelController@rooms');
            Route::get('/add', 'HotelController@roomUpdate');
            Route::post('/add', 'HotelController@roomStore');
            Route::get('/edit/{room_id}', 'HotelController@roomEdit');
            Route::get('/delete/{room_id}', 'HotelController@destroyRoom');
        });
    });
    
    Route::prefix('bookings')->group(function() {
        Route::get('/', 'HotelController@bookingList');
        Route::get('/add', 'HotelController@createBooking');
    });
});
