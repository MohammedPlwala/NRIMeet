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
          <i class="fas fa-check"></i>
          <h3>Payment In Process (#2370)</h3>
        </div>
        <div class="thankyou-notification-wrapper">
          <p><i class="fas fa-envelope"></i>A confirmation email has been sent to test@gmail.com</p>
        </div>
        <h3 class="heading3 border-line">Thank You</h3>
        <p class="booking-confirmation-message">Thank you for booking, we look forward to welcoming you to our hotel soon, and in the meantime, if you have any questions please do not hesitate to get in touch with us via phone or email and we’ll be happy to hear from you. </p>
        <div class="thankyou-button-section">
          <a href="https://pbdaccommodation.mptourism.com/user-my-booking" class="primary-button sm">My Booking</a>
        </div>
      </div>
    </div>
  </div>
@endsection
