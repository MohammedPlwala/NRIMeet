@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a>Edit Booking</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" enctype="multipart/form-data"
        action="{{ url('admin/bookings/update-booking/' . $booking->id) }}">
        @csrf
        {{-- Room Information --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Room Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Guest Name" for="guest" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="guest" icon="mail" required="true" class=""
                                        placeholder="Select Guest" name="guest">
                                        <option>Select Guest</option>
                                        @forelse($guests as $key => $guest)
                                            <option @if ($booking->user_id == $guest->id) selected @endif
                                                value="{{ $guest->id }}">{{ ucfirst($guest->full_name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="hotel" icon="mail" required="true" class=""
                                        placeholder="Select Hotel" name="hotel">
                                        <option>Select Hotel</option>
                                        @forelse($hotels as $key => $hotel)
                                            <option @if ($booking->hotel_id == $hotel->id) selected @endif
                                                value="{{ $hotel->id }}">{{ ucfirst($hotel->name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Check-In and Check-Out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <x-inputs.text value="{{ date('m/d/Y', strtotime($booking->check_in_date)) }}"
                                                for="checkin_date" class="checkDate" icon="calender-date-fill" readonly='true'
                                                required="true" placeholder="Date of birth" name="checkin_date" />
                                        </div>
                                        <div class="col-lg-6">
                                            <x-inputs.text value="{{ date('m/d/Y', strtotime($booking->check_out_date)) }}"
                                                for="checkout_date"  readonly='true' class="checkDate" icon="calender-date-fill"
                                                required="true" placeholder="Date of birth" name="checkout_date" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Total Nights" for="hotel"
                                    suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <div id="nights"></div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        {{-- Room One  Guests --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Room One  Guests</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderd">
                            <tr>
                                <th class="pt-3 pb-3">Room Name</th>
                                <th class="pt-3 pb-3">Adult</th>
                                <th class="pt-3 pb-3">Child</th>
                                <th class="pt-3 pb-3">Extra Bed</th>
                                <th  class="pt-3 pb-3">Extra Bed Cost</th>
                                <th class="pt-3 pb-3">Per/Night</th>
                                <th class="text-right pt-3 pb-3">Price</th>
                            </tr>
                            <tr>
                                <td>
                                    <select id="room_one_type" required="true" class="form-select roomType"
                                        name="room_one_type">
                                        <option value="">Select Room</option>
                                        <select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_one_adult" icon="mail" required="true" class=""
                                        name="room_one_adult" id="room_one_adult">
                                        <option @if ($bookingRooms[0]['adults'] == 0) selected @endif value="0">0</option>
                                        <option @if ($bookingRooms[0]['adults'] == 1) selected @endif value="1">1</option>
                                        <option @if ($bookingRooms[0]['adults'] == 2) selected @endif value="2">2</option>
                                        <option @if ($bookingRooms[0]['adults'] == 3) selected @endif value="3">3</option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_one_child" icon="mail" required="true" class=""
                                        name="room_one_child">

                                        <option @if ($bookingRooms[0]['childs'] == 0) selected @endif value="0">0</option>
                                        <option @if ($bookingRooms[0]['childs'] == 1) selected @endif value="1">1</option>
                                        <option @if ($bookingRooms[0]['childs'] == 2) selected @endif value="2">2</option>
                                    </x-inputs.select>
                                </td>
                                <td>
                                    <select id="room_one_extraBed" icon="mail" required="true" class="form-select"
                                        name="room_one_extraBed">

                                        <option @if ($bookingRooms[0]['extra_bed'] == 0) selected @endif value="0">No
                                        </option>
                                        <option @if ($bookingRooms[0]['extra_bed'] == 1) selected @endif value="1">Yes
                                        </option>

                                    </select>
                                </td>
                                <td>
                                    ₹<span id="room_one_extraBed_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td>
                                    ₹<span id="room_one_rate">{{ $bookingRooms[0]['rate'] }}</span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" id="room_one_price_input" name="room_one_price"
                                        value="{{ $bookingRooms[0]['amount'] }}">
                                    <input type="hidden" id="room_one_data" name="room_one_data">
                                    ₹<span id="room_one_price">{{ $bookingRooms[0]['amount'] }}</span>
                                </td>
                            </tr>

                        </table>
                        <div class="sp-plan-info card-inner pt-0">
                            <div id="cont_room_one_adult"></div>
                            <div id="cont_room_one_child"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        {{-- Room Two Guests --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Room Two Guests</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderd">
                            <tr>
                                <th class="pt-3 pb-3">Room Name</th>
                                <th class="pt-3 pb-3">Adult</th>
                                <th class="pt-3 pb-3">Child</th>
                                <th class="pt-3 pb-3">Extra Bed</th>
                                <th class="pt-3 pb-3">Extra Bed Cost</th>
                                <th class="pt-3 pb-3">Per/Night</th>
                                <th class="text-right pt-3 pb-3">Price</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-select roomType" id="room_two_type" placeholder="Select Type"
                                        name="room_two_type">
                                        <option value="">Select Room</option>
                                    </select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_two_adult" icon="mail" required="true" class=""
                                        name="room_two_adult">

                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['adults'] == 0) selected @endif value="0">0
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['adults'] == 1) selected @endif value="1">1
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['adults'] == 2) selected @endif value="2">2
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['adults'] == 3) selected @endif value="3">3
                                        </option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_two_child" icon="mail" required="true" class=""
                                        name="room_two_child">

                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['childs'] == 0) selected @endif value="0">0
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['childs'] == 1) selected @endif value="1">1
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['childs'] == 2) selected @endif value="2">2
                                        </option>
                                    </x-inputs.select>
                                </td>
                                <td>
                                    <select id="room_two_extraBed" icon="mail" required="true" class="form-select"
                                        name="room_two_extraBed">

                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['extra_bed'] == 0) selected @endif value="0">No
                                        </option>
                                        <option @if (isset($bookingRooms[1]) && $bookingRooms[1]['extra_bed'] == 1) selected @endif value="1">Yes
                                        </option>

                                    </select>
                                </td>
                                <td>
                                    ₹<span id="room_two_extraBed_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>

                                <td>
                                    ₹<span
                                        id="room_two_rate">{{ isset($bookingRooms[1]) ? $bookingRooms[1]['rate'] : 0 }}</span>
                                    / Night<br />
                                    <small>Tax Inclusive</small>

                                </td>
                                <td class="text-right">
                                    <input type="hidden" id="room_two_price_input" name="room_two_price"
                                        value="{{ isset($bookingRooms[1]) ? $bookingRooms[1]['amount'] : 0 }}">
                                    <input type="hidden" id="room_two_data" name="room_two_data">
                                    ₹<span
                                        id="room_two_price">{{ isset($bookingRooms[1]) ? $bookingRooms[1]['amount'] : 0 }}</span>
                                </td>
                            </tr>
                        </table>
                        <div class="sp-plan-info card-inner pt-0">
                            <div id="cont_room_two_adult"></div>
                            <div id="cont_room_two_child"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        {{-- Special Request --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Special Request</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Special Request Details" for="special_request"
                                        suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.textarea value="{{ isset($booking) ? $booking->special_request : '' }}"
                                        for="special_request" class="" icon="notes-alt"
                                       name="special_request" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        {{-- Status & Confirmation --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Status & Confirmation #</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Status" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="status" icon="mail" required="true" class=""
                                        placeholder="Select Status" name="status">
                                        <option @if ($booking->booking_status == 'Booking Received') selected @endif
                                            value="Booking Received">Booking Received</option>
                                        <option @if ($booking->booking_status == 'Payment Completed') selected @endif
                                            value="Payment Completed">Payment Completed</option>
                                        <option @if ($booking->booking_status == 'Booking Shared') selected @endif value="Booking Shared">
                                            Booking Shared</option>
                                        <option @if ($booking->booking_status == 'Confirmation Recevied') selected @endif
                                            value="Confirmation Recevied">Confirmation Recevied</option>
                                        <option @if ($booking->booking_status == 'Cancellation Requested') selected @endif
                                            value="Cancellation Requested">Cancellation Requested</option>
                                        <option @if ($booking->booking_status == 'Cancellation Approved') selected @endif
                                            value="Cancellation Approved">Cancellation Approved</option>
                                        <option @if ($booking->booking_status == 'Refund Requested') selected @endif
                                            value="Refund Requested">Refund Requested</option>
                                        <option @if ($booking->booking_status == 'Refund Approved') selected @endif
                                            value="Refund Approved">Refund Approved</option>
                                        <option @if ($booking->booking_status == 'Refund Issued') selected @endif value="Refund Issued">
                                            Refund Issued</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Hotel Confirmation Number" for="confirmation_number"
                                        suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->confirmation_number : '' }}"
                                        for="confirmation_number" class="" icon="building-fill"
                                         name="confirmation_number" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->

         {{-- Payment Details --}}
         <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Payment Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Payment Mode" for="payment_mode"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select value="{{ isset($booking) ? $booking->payment_mode : '' }}" 
                                        for="payment_mode"  
                                         name="payment_mode" >
                                         <option value="Online">Online</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Payment Method" for="payment_method"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select value="{{ isset($booking) ? $booking->payment_method : '' }}" 
                                        for="payment_method"  
                                         name="payment_method" >
                                         <option value="Payu">Payu</option>
                                         <option value="Razorpay">Razorpay</option>
                                         <option value="Billdesk">Billdesk</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Transaction ID" for="transaction_id"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->transaction_id : '' }}" 
                                        for="transaction_id"  
                                         name="transaction_id" />
                                        
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="UTR Number" for="utr_number" suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->utr_number : '' }}"
                                        for="utr_number" class="" icon="building-fill" 
                                        name="utr_number" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Settlement ID" for="settlement_id" suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->settlement_id : '' }}"
                                        for="settlement_id" class="" icon="building-fill" 
                                        name="settlement_id" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Settlement Date" for="settlement_date"
                                        suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->settlement_date : '' }}"
                                        for="settlement_date" class="date-picker" icon="building-fill"
                                         name="settlement_date" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        @if ($booking->booking_status == 'Cancellation Requested' || 
        $booking->booking_status == 'Cancellation Approved' ||
        $booking->booking_status == 'Refund Requested' ||
        $booking->booking_status == 'Refund Approved' ||
        $booking->booking_status == 'Refund Issued')
        {{-- Cancellation --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Cancellation Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Cancellation Requested Date" for="cancellation_request_date"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->cancellation_request_date : '' }}" 
                                        for="cancellation_request_date" icon="calender-date-fill"  
                                         name="cancellation_request_date" readonly="true" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Cancellation Date" for="cancellation_date"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->cancellation_date : '' }}" class="date-picker"
                                        for="cancellation_date" icon="calender-date-fill"  
                                         name="cancellation_date" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Cancellation Charges" for="cancellation_charges" suggestion=""
                                         />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="cancellation_charges" 
                                        placeholder="Select Cancellation Charges" name="cancellation_charges">
                                        <option @if ($booking->cancellation_charges == '0') selected @endif
                                            value="0">0%</option>
                                        <option @if ($booking->cancellation_charges == '20') selected @endif
                                            value="20">20%</option>
                                        <option @if ($booking->cancellation_charges == '50') selected @endif
                                            value="50">50%</option>
                                        <option @if ($booking->cancellation_charges == '100') selected @endif
                                            value="100">100%</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        @endif
        @if ($booking->booking_status == 'Refund Requested' ||
        $booking->booking_status == 'Refund Approved' ||
        $booking->booking_status == 'Refund Issued')
        {{-- Refund --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Refund Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Refund Requested Date" for="refund_request_date"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->refund_request_date : '' }}" 
                                        for="refund_request_date" icon="calender-date-fill"  
                                         name="refund_request_date" readonly="true" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Refund Date" for="refund_date"
                                        suggestion=""  />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->refund_date : '' }}" class="date-picker"
                                        for="refund_date" icon="calender-date-fill"  
                                         name="refund_date" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Refund Amount" for="refundable_amount" suggestion=""  
                                       />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->refundable_amount : '' }}" 
                                        for="refundable_amount" icon="sign-inr"  
                                         name="refundable_amount" readonly="true" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Refund Transaction UTR" for="refund_transaction_utr" suggestion=""
                                        />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="{{ isset($booking) ? $booking->refund_transaction_utr : '' }}" 
                                        for="refund_transaction_utr" icon="list"  
                                         name="refund_transaction_utr" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        @endif

        <div class="nk-block">
            @isset($user)
                <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
            @endisset
            <div class="row">
                <div class="col-md-12">
                    <div class="sp-plan-info pt-0 pb-0 card-inner">
                        <div class="row">
                            <div class="col-lg-7 text-right offset-lg-5">
                                <div class="form-group">
                                    <a href="javascript:history.back()" class="btn btn-outline-light">Cancel</a>
                                    <x-button type="submit" class="btn btn-primary">Submit</x-button>
                                </div>
                            </div>
                        </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    </form>

    <input type="hidden" name="role_type" id="role_type" value="{{ \Config::get('constants.ROLES.BUYER') }}">
    <input type="hidden" name="old_district" id="old_district" value="{{ old('district') }}">
    <input type="hidden" name="old_city" id="old_city" value="{{ old('city') }}">
    <pre>
        
    <script type="text/javascript">
        $(document).ready(function() {

            $('#hotel option:not(:selected)').prop('disabled', true);
            $('#guest option:not(:selected)').prop('disabled', true);

            var cancellation_charges = 0;

            @if(isset($booking->cancellation_charges) && !is_null($booking->cancellation_charges))
            var cancellation_charges = "<?php echo $booking->cancellation_charges; ?>";
            @endif


            var booking_ammount = {{$booking->amount}}
            $('#refundable_amount').val(booking_ammount - (booking_ammount * cancellation_charges / 100))
            var nights = getNights();
                $('#nights').html(parseFloat(nights))

            $('#room_one_type').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', this).attr('data-roomdata');
                    $('#room_one_data').val(roomData);
                    roomData = JSON.parse(roomData);

                    if (roomData.extra_bed_available) {
                        $('#room_one_extraBed').prop('disabled', false);
                    } else {
                        $('#room_one_extraBed').prop('disabled', true);
                    }
                    // $('#room_one_extraBed').val('').trigger('change');
                    var rate = parseFloat(roomData.rate);
                    rate = rate.toFixed(2);
                    $('#room_one_rate').text(rate);

                    var nights = getNights();
                    var price = (parseFloat(roomData.rate) * nights);
                    $('#room_one_price').text(price.toFixed(2));
                    $('#room_one_price_input').val(price.toFixed(2));
                }

            });

            $('#room_one_extraBed').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', '#room_one_type').attr('data-roomdata');
                    roomData = JSON.parse(roomData);
                    var price = 0;

                    var nights = getNights();

                    if ($(this).val() == 1) {

                        $('#room_one_extraBed_rate').text(roomData.extra_bed_rate);
                        price = ((parseFloat(roomData.rate) * nights) + (parseFloat(roomData.extra_bed_rate) * nights));
                    } else {
                        $('#room_one_extraBed_rate').text(0);
                        price = (parseFloat(roomData.rate) * nights);
                    }
                    $('#room_one_price').text(price.toFixed(2));
                    $('#room_one_price_input').val(price.toFixed(2));
                }

            });

            $('#room_two_type').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', this).attr('data-roomdata');
                    $('#room_two_data').val(roomData);
                    roomData = JSON.parse(roomData);

                    if (roomData.extra_bed_available) {
                        $('#room_two_extraBed').prop('disabled', false);
                    } else {
                        $('#room_two_extraBed').prop('disabled', true);
                    }
                    // $('#room_two_extraBed').val('');
                    // $('#room_two_extraBed').trigger('change');
                    var rate = parseFloat(roomData.rate);
                    rate = rate.toFixed(2);
                    $('#room_two_rate').text(rate);

                    var nights = getNights();
                    var price = (parseFloat(roomData.rate) * nights);
                    $('#room_two_price').text(price.toFixed(2));
                    $('#room_two_price_input').val(price.toFixed(2));
                }

            });

            $('#room_two_extraBed').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', '#room_two_type').attr('data-roomdata');
                    roomData = JSON.parse(roomData);
                    var price = 0;

                    var nights = getNights();

                    if ($(this).val() == 1) {
                        $('#room_two_extraBed_rate').text(roomData.extra_bed_rate);
                        price = ((parseFloat(roomData.rate) * nights) + (parseFloat(roomData.extra_bed_rate) * nights));
                    } else {
                        $('#room_two_extraBed_rate').text(0);
                        price = (parseFloat(roomData.rate) * nights);
                    }
                    $('#room_two_price').text(price.toFixed(2));
                    $('#room_two_price_input').val(price.toFixed(2));
                }

            });

            function getNights() {
                var nights = 0;
                var checkin_date = $('#checkin_date').val();
                var checkout_date = $('#checkout_date').val();

                if (checkin_date != "" && checkout_date != "") {
                    var diffInMs = new Date(checkout_date) - new Date(checkin_date)
                    nights = diffInMs / (1000 * 60 * 60 * 24);
                }

                return nights;
            }

            $('.checkDate').change(function() {
                var nights = getNights();
                $('#nights').html(parseFloat(nights))
                $('#room_one_type').trigger('change');
                $('#room_two_type').trigger('change');
            });


            $('#hotel').change(function() {
                var root_url = "<?php echo Request::root(); ?>";
                $.ajax({
                    url: root_url + '/admin/hotel/hotel-rooms/' + $(this).val(),
                    data: {

                    },
                    //dataType: "html",
                    method: "GET",
                    cache: false,
                    success: function(response) {
                        if (response.success) {
                            $('#room_one_price').text('');
                            $('#room_one_price_input').val('');
                            $('#room_two_price').text('');
                            $('#room_two_price_input').val('');
                            // $('#room_one_extraBed').val(0).trigger('change');
                            // $('#room_two_extraBed').val(0).trigger('change');


                            $('.roomType')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Select Room</option>');

                            $.each(response.hotelRooms, function(key, room) {
                                $('.roomType')
                                    .append($("<option></option>")
                                        .attr("value", room.id)
                                        .attr("data-roomData", JSON.stringify(room))
                                        .text(room.room_type_name));
                            });

                            @if (isset($bookingRooms[0]))
                                var roomValue = "<?php echo $bookingRooms[0]['room_id']; ?>";
                                $("#room_one_type").val(parseInt(roomValue));
                                $('#room_one_type').trigger('change');
                                $('#room_one_adult').trigger('change');
                                $('#room_one_child').trigger('change');
                                $('#room_one_extraBed').trigger('change');
                            @endif

                            @if (isset($bookingRooms[1]))
                                var roomValue = "<?php echo $bookingRooms[1]['room_id']; ?>";
                                $("#room_two_type").val(parseInt(roomValue));
                                $('#room_two_type').trigger('change');

                                $('#room_two_adult').trigger('change');
                                $('#room_two_child').trigger('change');
                                $('#room_two_extraBed').trigger('change');
                            @endif

                        }
                    }
                });
            });

            $('#hotel').trigger('change');

            function addRoomDetails(container, value, room, isChild = false) {
                $(container).html('')
                var html = ''
                var label = isChild ? 'Child' : 'Adult'
                var title = isChild ? 'child_title' : 'title'
                var firstName = isChild ? 'child_first_name' : 'first_name'
                var firstLast = isChild ? 'child_last_name' : 'last_name'

                for (let index = 0; index < value; index++) {
                    html += `
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="${label} ${index + 1}" for="adults_one_title" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text value="" for="rooms_${room}_${firstName}_${index}" name="rooms[${room}][${firstName}][${index}]" placeholder="Full Name" />
                                </div>
                            </div>
                        `
                }
                $(container).append(html)
            }


            $("#room_one_adult").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_one_adult', value, 0)
            });

            $("#room_one_child").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_one_child', value, 0, true)
            });

            $("#room_two_adult").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_two_adult', value, 1)
            });

            $("#room_two_child").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_two_child', value, 1, true)
            });


            @if (isset($bookingRooms[0]))
                var room_one_data = JSON.parse('<?php echo json_encode($bookingRooms[0]); ?>');
                setTimeout(function() {
                    $('#rooms_0_first_name_0').val(room_one_data.guest_one_name);
                    $('#rooms_0_first_name_1').val(room_one_data.guest_two_name);
                    $('#rooms_0_first_name_2').val(room_one_data.guest_three_name);
                    $('#rooms_0_child_first_name_0').val(room_one_data.child_name);
                }, 2000);
            @endif

            @if (isset($bookingRooms[1]))
                var room_two_data = JSON.parse('<?php echo json_encode($bookingRooms[1]); ?>');
                setTimeout(function() {
                    var room_one_data = JSON.parse('<?php echo json_encode($bookingRooms[0]); ?>');
                    $('#rooms_1_first_name_0').val(room_two_data.guest_one_name);
                    $('#rooms_1_first_name_1').val(room_two_data.guest_two_name);
                    $('#rooms_1_first_name_2').val(room_two_data.guest_three_name);
                    $('#rooms_1_child_first_name_0').val(room_two_data.child_name);
                }, 2000);
            @endif


        });
    </script>
@endsection
