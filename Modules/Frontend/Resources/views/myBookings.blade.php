@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>My Bookings</h1>
  </div>
  <div class="container">

    <div class="my-bookings-section">
      <div class="shb-booking-summary-wrapper">
        <div class="shb-booking-summary-item">
            <h4>Hotel Name </h4>
            <ul>
              <li><strong>Dates:</strong> 06/01/2023 - 07/01/2023 (1 Night)</li>
              <li><strong>Guests:</strong> 1 Adult, 0 Children</li>
            </ul>
            <div class="shb-booking-summary-item-inner">
              <h5>Room 1 </h5>
              <div class="my_account_guest_box">
                <h5>Guests Infomation</h5>
                <div class="my_account_guest_inner">
                    <p class="main_title_plural">Guests</p>
                    <p class="child_title_plural">Adults 1 = Mr mahendrapal  thakur</p>
                    <p class="child_title_plural">Adults 2 = Mr mahendrapal  thakur</p>
                    <p class="child_title_plural">Child 1 = Mr mahendrapal  thakur</p>
                </div>
                <p><b>Comment</b>: PayU payment gateway testing 1</p>
              </div>
            </div>
        </div>
        <div class="shb-booking-summary-item amount_tax">
            <p><strong>Base Price: </strong> ₹89</p>
            <p><strong>TAX (12%): </strong> ₹11</p>
            <p><strong>Total: </strong> ₹3,150</p>
        </div>
      </div>
    </div>

  </div>
@endsection
