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

Route::get('/', 'HotelController@index');
Route::post('search', 'HotelController@search');
Route::get('search', 'HotelController@search');

Route::get('booking', 'FrontendController@booking');

Route::get('about-us', 'FrontendController@about');
Route::get('privacy-policy', 'FrontendController@privacyPolicy');
Route::get('booking-policy', 'FrontendController@bookingPolicy');
Route::get('terms-and-conditions', 'FrontendController@termsAndConditions');
Route::get('refund-cancellation-policy', 'FrontendController@refundCancellationPolicy');
