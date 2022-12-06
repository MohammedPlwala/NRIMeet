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

Route::get('/', 'HotelController@index');
Route::post('search', 'HotelController@search');
Route::get('search', 'HotelController@search');
Route::post('add-room', 'HotelController@addRoom');

Route::group(['middleware' => 'auth:web'], function(){
	Route::get('booking-summary', 'HotelController@bookingSummary');
	Route::post('booking-summary', 'HotelController@saveGuest');
	Route::post('razorpay-payment','HotelController@saveRazorPayPayment');
	Route::get('payment', 'HotelController@payment');
	Route::get('thankyou', 'HotelController@bookingConfirmed');
	Route::post('darshan-registration', 'FrontendController@store');
	Route::post('contact', 'FrontendController@storeContact');
});


Route::get('booking', 'FrontendController@booking');
Route::get('mahakal-lok-darshan', 'FrontendController@mahakalLokDarshan');
Route::get('user-my-booking', 'FrontendController@myBookings');
Route::get('contact-us', 'FrontendController@contactUs');
Route::get('about-us', 'FrontendController@about');
Route::get('privacy-policy', 'FrontendController@privacyPolicy');
Route::get('booking-policy', 'FrontendController@bookingPolicy');
Route::get('terms-and-conditions', 'FrontendController@termsAndConditions');
Route::get('refund-cancellation-policy', 'FrontendController@refundCancellationPolicy');
