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


Route::get('booking-invoice/{booking_id}', 'HotelController@bookingPdf');

Route::get('/', 'HotelController@index');
Route::group(['middleware' => 'auth:web'], function(){
	Route::post('search', 'HotelController@search');
	Route::get('search', 'HotelController@search');
	Route::post('add-room', 'HotelController@addRoom');


	Route::get('booking-summary', 'HotelController@bookingSummary');
	Route::post('booking-summary', 'HotelController@saveGuest');
	
	Route::post('razorpay-payment','HotelController@saveRazorPayPayment');
	
	Route::any('payu-payment', 'HotelController@redirectToPayU');
	Route::any('razor-pay-form', 'HotelController@razorPayForm');

	Route::any('billdesk', 'HotelController@billDeskForm');
	Route::get('getChecksum','HotelController@billDeskChecksum');
	Route::get('billdesk-payment-response','HotelController@billDeskResponse');

	Route::any('payu-payment-cancel', 'HotelController@payuPaymentCancel');
	// Route::any('payu-money-payment-success', 'App\Http\Controllers\PayuMoneyController@paymentSuccess')->name('payumoney-success');

	Route::get('payment', 'HotelController@payment');
	Route::get('thankyou', 'HotelController@bookingConfirmed');
	Route::post('darshan-registration', 'FrontendController@store');
	Route::post('contact', 'FrontendController@storeContact');
	Route::get('my-bookings', 'HotelController@myBookings');
	
	Route::get('booking', 'FrontendController@booking');
	Route::get('mahakal-lok-darshan', 'FrontendController@mahakalLokDarshan');
	Route::get('contact-us', 'FrontendController@contactUs');
	Route::get('about-us', 'FrontendController@about');
	Route::get('privacy-policy', 'FrontendController@privacyPolicy');
	Route::get('booking-policy', 'FrontendController@bookingPolicy');
	Route::get('terms-and-conditions', 'FrontendController@termsAndConditions');
	Route::get('refund-cancellation-policy', 'FrontendController@refundCancellationPolicy');
	Route::get('free-home-stay', 'FrontendController@homeStay');
	Route::get('home-stay-registration', 'FrontendController@homeStayRegistration');
});

Route::any('payu-payment-success','HotelController@payuSuccess');

