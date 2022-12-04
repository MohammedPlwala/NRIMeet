@extends('frontend.layouts.app')

@section('content')
    <!-- Page Header -->
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
        <div class="shb-booking-page-wrapper shb-clearfix">
            <div class="shb-booking-page-main full-width">
                <div class="shb-booking-page-sidebar full-width">
                    <!-- BEGIN .shb-booking-your-stay-wrapper -->
                    <div class="shb-booking-your-stay-wrapper">
                        <!-- BEGIN .shb-booking-your-stay-items-wrapper -->
                        <div class="shb-booking-your-stay-items-wrapper">
                            <!-- BEGIN .shb-booking-your-stay-item-wrapper -->
                            @php
                            	$total = 0;
                            @endphp
                            @forelse ($rooms as $key => $room)
                            @php
                            	
	                            if($key == 0){
	                            	$adults = $room->room_one_adult;
	                            	$childs = $room->room_one_child;
	                            }
	                            else{
	                            	$adults = $room->room_two_adult;
	                            	$childs = $room->room_two_child;
	                            }
                            	$total += $cartData['nights']*$room->rate;
	                            
                            @endphp

                            <div class="shb-booking-your-stay-item-wrapper">
                                <h3>Room {{ $key+1 }}</h3>
                                <div class="sidebar_left">
                                    <ul>
                                        <li><span></span> Check in - {{ date('M d, Y',strtotime($cartData['date_from'])) }} Check out - {{ date('M d, Y',strtotime($cartData['date_to'])) }}</li>
                                        <li><span>Guests:</span> {{ $adults }} Adults, {{ $childs }} Child</li>
                                    </ul>
                                </div>
                                <div class="sidebar_center">
                                    <!-- BEGIN .shb-booking-your-stay-item -->
                                    <div class="shb-booking-your-stay-item shb-clearfix">
                                        <a href="#" class="shb-booking-stay-image">
                                            <img src="https://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/WOW-Hotel.jpg"
                                                alt="Bookings">
                                        </a>
                                        <div class="shb-booking-your-stay-item-info">
                                            <h4 class="shb-clearfix"><a href="#">{{ $room->hotel->name }}</a><span> ₹{{ $cartData['nights']*$room->rate }}</span>
                                            </h4>
                                            <p class="shb-booking-your-stay-item-info-detail">{{ $room->room_type }}</p>
                                            <p class="shb-booking-price-expand"><a href="#">{{ $cartData['nights'] }} Night</a><i
                                                    class="fas fa-chevron-down"></i></p>
                                            <div class="shb-booking-price-expanded">
                                                {{-- <p class="shb-clearfix"><span>Fri, Jan 06, 2023</span><span> ₹10,800</span> --}}
                                                <p class="shb-clearfix"><span> ₹{{ $room->rate }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- END .shb-booking-your-stay-item -->
                                    </div>
                                </div>
                                <div class="sidebar_right">
                                    <a href="https://pbdaccommodation.mptourism.com/bookings/?shb-delete-room=1">Remove</a>
                                </div>
                                @if($room->extra_bed_available)
                                <div class="custom_extra_bed">
                                    <!-- BEGIN .shb-additionalfee-result-wrapper -->
                                    <form class="shb-additionalfee-result-wrapper"
                                        action="https://pbdaccommodation.mptourism.com/bookings/?shb-step=2&amp;shb_selected_fee_room=1"
                                        method="post" autocomplete="off">
                                        <div class="shb-additionalfee-info">
                                            <h4>Extra Bed</h4>
                                            <div class="shb-additionalfee-price">
                                                <span> ₹2,500 | Per Person</span>
                                                <div>
                                                    <input type="submit" value="Select" class="primary-button sm" />
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="shb_accommodation_selected" value="1">
                                        <input type="hidden" name="shb_additionalfee_selected" value="1129">
                                    </form>
                                    <!-- END .shb-booking-your-stay-item -->
                                </div>
                                @endif
                                <!-- BEGIN .shb-booking-your-stay-controls -->
                                <div class="shb-booking-your-stay-controls shb-clearfix">
                                    <!-- END .shb-booking-your-stay-controls -->
                                </div>
                                <!-- END .shb-booking-your-stay-item-wrapper -->
                            </div>
                            @empty
                        	@endforelse
                            <!-- END .shb-booking-your-stay-items-wrapper -->
                        </div>
                        <!-- BEGIN .shb-booking-total -->
                        <div class="shb-booking-total border_bottom">
                            <h4>Total</h4>
                            <h4>₹{{ $total }}</h4>
                            <!-- END .shb-booking-total -->
                        </div>
                        <a href="javascript:void(0)" class="shb-booking-continue"
                            onclick="return shb_booking_continue()">Continue</a>
                        <!-- END .shb-booking-your-stay-wrapper -->
                    </div>
                    <!-- END .shb-booking-page-sidebar -->
                </div>


                <div class="guests_info_front_main_div">
                    <form method="POST" id="guests_info_front_form" action="{{ url('booking-summary') }}" autocomplete="off">
                        @csrf
                        @forelse ($rooms as $key => $room)

                        <input type="hidden" name="rooms[{{ $key }}][data]" value="{{ json_encode($room) }} ">

                        <div class="guestInformation">
	                        <h3>Room {{ $key+1 }}</h3>
	                        <h5>Guests</h5>

	                        @php
	                            if($key == 0){
	                            	$adults = $room->room_one_adult;
	                            	$childs = $room->room_one_child;
	                            }
	                            else{
	                            	$adults = $room->room_two_adult;
	                            	$childs = $room->room_two_child;
	                            }
                            @endphp


	                        @for ($i = 0; $i < $adults ; $i++)
	                        	<p>Adults {{ $i+1 }}</p>
	                        	<div class="Guests_info_front_box">
		                            <select required name="rooms[{{ $key }}][title][{{ $i }}]">
		                                <option value="Mr">Mr.</option>
		                                <option value="Miss">Miss</option>
		                                <option value="Mrs">Mrs.</option>
		                            </select>
		                            <div class="form-item">
		                                <input type="text" maxlength="25" required name="rooms[{{ $key }}][first_name][{{ $i }}]"
		                                    value="" placeholder="First Name">
		                            </div>
		                            <div class="form-item">
		                                <input type="text" maxlength="25" required name="rooms[{{ $key }}][last_name][{{ $i }}]"
		                                    value="" placeholder="Last Name">
		                            </div>
		                        </div>
	                        @endfor
	                        <h5>Children</h5>
	                        @for ($i = 0; $i < $childs ; $i++)
	                        <p>Children {{ $i+1 }}</p>
	                        <div class="Guests_info_front_box">
	                            <select required name="rooms[{{ $key }}][child_title][{{ $i }}]">
	                                <!--<option value="">Select Title</option> -->
	                                <option value="Mr">Mr.</option>
	                                <option value="Miss">Miss</option>
	                                <option value="Mrs">Mrs.</option>
	                            </select>
	                            <div class="form-item">
	                                <input type="text" maxlength="25" required
	                                    name="rooms[{{ $key }}][child_first_name][{{ $i }}]" value=""
	                                    placeholder="First Name" />
	                            </div>
	                            <div class="form-item">
	                                <input type="text" maxlength="25" required
	                                    name="rooms[{{ $key }}][child_last_name][{{ $i }}]" value=""
	                                    placeholder="Last Name" />
	                            </div>
	                        </div>
	                        @endfor
                        </div>
                        @empty
                        @endforelse


                        <p>
                            <label>Special Request</label>
                            <textarea maxlength="200" rows="1" name="special_request"></textarea>
                        </p>
                        <p>
                            <input type="checkbox"
                                data-mess=" Please accept the terms and conditions to proceed further with the booking process."
                                name="agree_on" required /> I Agree on <a target="_blank" href="about-us/">About Us</a> |
                            <a target="_blank" href="privacy-policy/">Privacy Policy</a> | <a target="_blank"
                                href="booking-policy/">Booking Policy</a> | <a target="_blank"
                                href="terms-and-conditions/">Terms and conditions</a> | <a target="_blank"
                                href="refund-cancellation-policy/">Refund &amp; Cancellation Policy</a>
                        </p>
                        <br>
                        <div class="sav_next">
                            <input type="submit" value="Save and Next" class="primary-button md" />
                        </div>
                    </form>
                </div>

                <!-- Billing Details -->
                <div>
                    <div class="columns-3">
                        <div class="form-item">
                            <label>First name <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="" value="" placeholder="First Name" required />
                        </div>
                        <div class="form-item">
                            <label>Last name <abbr class="required" title="required">*</abbr></label>
                            <input type="text" name="" value="" placeholder="Last Name" required />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
