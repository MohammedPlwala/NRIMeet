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

Route::prefix('admin/report')->group(function() {
    
    // Reports
    Route::get('guest', 'ReportController@guest');
    Route::get('guest-export', 'ReportController@guestExport');

    Route::get('hotel-master', 'ReportController@hotelMaster');
    Route::get('export-hotel-master', 'ReportController@hotelMasterExport');
    

    Route::get('booking', 'ReportController@booking');
    Route::get('booking-export', 'ReportController@bookingExport');


    Route::get('inventory', 'ReportController@inventory');
    Route::get('payment', 'ReportController@payment');
    Route::get('cancellation', 'ReportController@cancellation');
    Route::get('refund', 'ReportController@refund');

    Route::get('total-inventory-data', 'ReportController@totalInventoryData');
    Route::get('booking-summary', 'ReportController@bookingSummary');
    Route::get('group-bookings', 'ReportController@groupBookings');
    Route::get('call-center', 'ReportController@callCenter');
    Route::get('financial', 'ReportController@financial');
    Route::get('financial-2', 'ReportController@financial2');
});
