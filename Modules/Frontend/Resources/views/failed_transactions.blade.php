@extends('frontend.layouts.app')

@section('content')
  	<div class="pb-35">
		<div class="marquee">
	  		<marquee width="100%" direction="left" height="100px">
				Dear PBD Delegates, Govt of M.P. has revised the rates of hotel accommodation. Delegates who have booked the
				accommodation before 21/11/2022 16:00 hours IST, any excess amount charged will be refunded to their
				respective bank account with-in 15 working days.
	  		</marquee>
		</div>
  	</div>
  	<div class="container">
		<div class="thankyou-wrap">
	  		<div class="thankyou-main">
				<div class="thankyou-complete-wrapper">
				  <i class="fas fa-times"></i>
				  <h3>Payment Failed (#{{ $order_id }})</h3>
				</div>
				<div class="thankyou-notification-wrapper">
		  			<p style="color: #dc3545;"><i style="color: #dc3545;" class="fas fa-exclamation-triangle"></i>{{ $error_message }}</p>
				</div>
				<h3 class="heading3 border-line">Don't Worry</h3>
				<p class="booking-confirmation-message">We have received your booking. One of our team member will connect with you for payment process. </p>
				<div class="thankyou-button-section">
		  			<a href="{{url('/my-bookings')}}" class="primary-button sm">My Booking</a>
				</div>
	  		</div>
		</div>
  	</div>
@endsection
