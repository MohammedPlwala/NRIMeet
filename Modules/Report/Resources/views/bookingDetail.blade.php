@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a>Booking Details</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    {{-- Order --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Order</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Order Id:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->order_id }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Booking Type:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->booking_type }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Order / Booking Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ date('d M, Y', strtotime($booking_detail->booking_date)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Guest --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Guest Details</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Guest Name:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->guest_name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Registration Name:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->registration_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Guest Email Id:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->guest_email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Registration Email Id:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->registration_email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Guest Contact:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->guest_contact }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Registration Contact:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->registration_contact }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Guest Country:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->guest_country }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Registration Country:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->registration_country }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Delegate Category:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->guest_category }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Booking --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Booking</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Booking Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ date('d M, Y', strtotime($booking_detail->booking_date)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Hotel Rating::</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->hotel_rating }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Hotel:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->hotel }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Room Type:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->room_type }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Check in:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ date('d M, Y', strtotime($booking_detail->check_in_date)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Check out:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ date('d M, Y', strtotime($booking_detail->check_out_date)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Nights:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->nights }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Total Charges:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->total_charge }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Booking Status:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->booking_status }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Confirmation No:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->confirmation_number }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="col-lg-3">
                                        <span class="data-label">Special Request:</span>
                                    </div>
                                    <div class="col-lg-9">
                                        <span class="data-value">{{ $booking_detail->special_request }}</span>
                                    </div>
                                </div>
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
                    <table class="table table-borderd text-center">
                        <tr>
                            <th class="pt-3 pb-3">Adult</th>
                            <th class="pt-3 pb-3">Child</th>
                            <th class="pt-3 pb-3">Extra Bed</th>
                            <th  class="pt-3 pb-3">Extra Bed Cost</th>
                            <th class="pt-3 pb-3">Per/Night</th>
                            <th class="text-right pt-3 pb-3">Price</th>
                        </tr>
                        <tr>
                            <td>
                                {{ $bookingRooms[0]['adults'] }}
                            </td>
                            <td>
                                {{ $bookingRooms[0]['childs'] }}
                            </td>
                            <td>
                                {{ $bookingRooms[0]['extra_bed'] }}
                            </td>
                            <td>
                                ₹<span id="room_one_extraBed_rate">{{ $bookingRooms[0]['extra_bed_rate'] }}</span> / Night<br />
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
                        <div id="cont_room_one_adult">
                            <div class="row g-3 align-center">
                                <div class="col-lg-3">
                                    Adult 1 :
                                </div>
                                <div class="col-lg-9">
                                    {{ $bookingRooms[0]['guest_one_name'] }}
                                </div>
                            </div>
                        </div>
                        @if($bookingRooms[0]['guest_two_name']!='')
                        <div id="cont_room_one_adult">
                            <div class="row g-3 align-center">
                                <div class="col-lg-3">
                                    Adult 2 :
                                </div>
                                <div class="col-lg-9">
                                    {{ $bookingRooms[0]['guest_two_name'] }}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($bookingRooms[0]['guest_three_name']!='')
                        <div id="cont_room_one_adult">
                            <div class="row g-3 align-center">
                                <div class="col-lg-3">
                                    Adult 3 :
                                </div>
                                <div class="col-lg-9">
                                    {{ $bookingRooms[0]['guest_three_name'] }}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($bookingRooms[0]['child_name']!='')
                        <div id="cont_room_one_child">
                            <div class="row g-3 align-center">
                                <div class="col-lg-3">
                                    Child 1 :
                                </div>
                                <div class="col-lg-9">
                                    {{ $bookingRooms[0]['child_name'] }}
                                </div>
                            </div>
                        </div>
                        @endif
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
                        <tr class="text-center">
                            <th class="pt-3 pb-3">Adult</th>
                            <th class="pt-3 pb-3">Child</th>
                            <th class="pt-3 pb-3">Extra Bed</th>
                            <th class="pt-3 pb-3">Extra Bed Cost</th>
                            <th class="pt-3 pb-3">Per/Night</th>
                            <th class="text-right pt-3 pb-3">Price</th>
                        </tr>
                        <tr class="text-center">
                            <td>
                                 @if (isset($bookingRooms[1])) 
                                 {{ $bookingRooms[1]['adults'] }}
                                 @else
                                 0
                                 @endif
                            </td>
                            <td>
                                @if (isset($bookingRooms[1])) 
                                 {{ $bookingRooms[1]['childs'] }}
                                 @else
                                 0
                                 @endif
                            </td>
                            <td>
                                @if (isset($bookingRooms[1])) 
                                 {{ $bookingRooms[1]['extra_bed'] }}
                                 @else
                                 0
                                 @endif
                            </td>
                            <td>
                                ₹<span id="room_two_extraBed_rate">{{ isset($bookingRooms[1]) ? $bookingRooms[1]['extra_bed_rate'] : 0 }}</span> / Night<br />
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
                        <div id="cont_room_two_adult">
                            @if(isset($bookingRooms[1]) && $bookingRooms[1]['guest_one_name']!='')
                            <div id="cont_room_one_adult">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        Adult 1
                                    </div>
                                    <div class="col-lg-8">
                                        {{ $bookingRooms[1]['guest_one_name'] }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(isset($bookingRooms[1]) && $bookingRooms[1]['guest_two_name']!='')
                            <div id="cont_room_one_adult">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        Adult 2
                                    </div>
                                    <div class="col-lg-8">
                                        {{ $bookingRooms[1]['guest_two_name'] }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(isset($bookingRooms[1]) && $bookingRooms[1]['guest_three_name']!='')
                            <div id="cont_room_one_adult">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        Adult 3
                                    </div>
                                    <div class="col-lg-8">
                                        {{ $bookingRooms[1]['guest_three_name'] }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div id="cont_room_two_child">
                            @if(isset($bookingRooms[1]) && $bookingRooms[1]['child_name']!='')
                            <div id="cont_room_one_adult">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-4">
                                        Child 3
                                    </div>
                                    <div class="col-lg-8">
                                        {{ $bookingRooms[1]['child_name'] }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Payment --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Payment</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Method:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->payment_method }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Payment via:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->payment_mode }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Transaction ID:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->transaction_id }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Status:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->status }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Response:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->booking_status }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">UTR:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->utr_number }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Settlement Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->settlement_date) ? date('d M, Y', strtotime($booking_detail->settlement_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Settlement Id:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->settlement_id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Payment Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->payment_date) ? date('d M, Y', strtotime($booking_detail->payment_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Cancellation --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Cancellation</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Cancellation Requested Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->cancellation_request_date) ? date('d M, Y', strtotime($booking_detail->cancellation_request_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Cancellation Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->cancellation_date) ? date('d M, Y', strtotime($booking_detail->cancellation_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Cancellation Charges:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->cancellation_charges }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Cancellation Charges:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->cancellation_charges }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Refund --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Refund</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Refund Requested Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->refund_request_date) ? date('d M, Y', strtotime($booking_detail->refund_request_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Refund Date:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ isset($booking_detail->refund_date) ? date('d M, Y', strtotime($booking_detail->refund_date)) : 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Refund Amount: </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->refundable_amount }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Refund Transaction UTR: </span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">{{ $booking_detail->refund_transaction_utr }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
    {{-- Documents For offline bookings --}}
    <div class="nk-block">
        <div class="card card-bordered sp-plan">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <div class="sp-plan-action card-inner">
                        <div class="icon">
                            <h5 class="o-5">Documents</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="sp-plan-info card-inner">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Email Copy:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value">
                                            <a href="{{ url('uploads/bookings/'.$booking_detail->email_receipt) }}" class="btn btn-sm btn-primary" download @if($booking_detail->email_receipt=='') style="pointer-events: none;" @endif><em class="icon ni ni-download"></em><span>Email Copy</span></a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <span class="data-label">Payment Receipt:</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <span class="data-value"><a href="{{ url('uploads/bookings/'.$booking_detail->payment_receipt) }}" class="btn btn-sm btn-primary" download @if($booking_detail->payment_receipt=='') style="pointer-events: none;" @endif><em class="icon ni ni-download"></em><span>Payment Receipt</span></a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->
@endsection
