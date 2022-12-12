<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayPaymentController;

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

Route::prefix('admin')->group(function() {
    Auth::routes();
    Route::post('post-admin-login', 'App\Http\Controllers\Auth\LoginController@adminLogin'); 
});

Route::get('/', '\Modules\Frontend\Http\Controllers\HotelController@index');
Route::get('/admin', '\Modules\Dashboard\Http\Controllers\DashboardController@index');
Route::post('post-login', 'App\Http\Controllers\Auth\LoginController@postLogin'); 
Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index']);
Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

Route::get('clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
