@extends('frontend.layouts.app')

@section('content')
    @php
        
        function roomTwoCheck()
        {
            $adult = \Session::get('room_two_adult');
            $child = \Session::get('room_two_child');
            return $adult || $child;
        }
    @endphp
    <div class="mt-14"> </div>
    <div class="container mx-auto mt-14">
        <div class="flex flex-row">
            <div class="lg:basis-1/4 lg:block hidden">
                <!-- BEGIN .shb-booking-page-sidebar -->
                <div class="shb-booking-page-sidebar customer_filter">
                    <!-- //v2care -->
                    <div class="custom_filter_main_div">
                        <form id="search" action="{{ url('/search') }}" method="post">
                          @csrf
                            <div class="custom_filter_innder_div">
                                <label for="shb-hotal-name" class="filter_label  mb-2 block">Hotel name</label>
                                <input id="s" name="name" id="shb-hotal-name" type="text"
                                    placeholder="Search by Hotel Name" value="{{$request->name}}"
                                    class="block text-sm mb-2shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-5" />
                            </div>
                            <div class="custom_rangeslider">
                                <label for="shb-hotal-rating" class="filter_label  mb-2 block">Price</label>
                                <div class="range-slider">
                                    <span class="rangeValues block mb-4 text-center"></span>
                                    <input 
                                    @if(isset($request->room_price_min))value="{{$request->room_price_min}}" @else value="3000" @endif
                                    min="3000" max="23000" step="500" type="range"
                                        name="room_price_min">
                                    <input @if(isset($request->room_price_max))value="{{$request->room_price_max}}" @else value="23000" @endif min="3000" max="23000" step="500" type="range"
                                        name="room_price_max">
                                </div>
                            </div>
                            <div class="custom_filter_innder_div">
                                <label for="shb-hotal-rating" class="filter_label mb-2 block">Rating</label>
                                <select name="classification" id="shb-hotal-rating"
                                onchange="this.form.submit()"
                                    class="form-control form-control-lg block text-sm mb-2shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Select Rating</option>
                                    @if(!empty($classifications->toArray()))
                                      @foreach ($classifications as $item)
                                        <option 
                                        @if(isset($request->classification) && $request->classification == $item->classification) selected @endif
                                        value="{{$item->classification}}">{{$item->classification}}</option>
                                      @endforeach
                                    @endif
                                </select>
                                <br>
                            </div>

                            <div class="custom_filter_innder_div filter_sortby mb-7">
                                <label class="filter_label mb-2 block">Sort By</label>
                                <label for="price_low_to_high"><input type="radio" id="price_low_to_high"
                                        onchange="this.form.submit()" name="shb-orderby" value="p1"
                                        class="mr-2 mt-1">Price Low to High</label>
                                <label for="price_high_to_low"><input type="radio" id="price_high_to_low"
                                        onchange="this.form.submit()" name="shb-orderby" value="p2"
                                        class="mr-2 mt-1">Price High to Low</label>
                                <label for="rating_5_star_to_1_star"><input type="radio" id="rating_5_star_to_1_star"
                                        onchange="this.form.submit()" name="rating_orderby" value="asc"
                                        class="mr-2 mt-1">Rating 5 Star Deluxe to
                                    3 Star</label>
                                <label for="rating_1_star_to_5_star"><input type="radio" id="rating_1_star_to_5_star"
                                        onchange="this.form.submit()" name="rating_orderby" value="desc"
                                        class="mr-2 mt-1">Rating 3 Star to 5 Star
                                    Deluxe</label>
                            </div>
                            <div class="flex justify-between content-end">
                                <a href="#" class="hotel-search-button_clear self-end">Clear All</a>
                                <input type="submit"
                                    class="hotel-search-button px-4 py-2 font-semibold text-sm bg-cyan-500 text-white rounded-full shadow-sm"
                                    name="" value="Search">
                            </div>
                            <input type="hidden" class="shbdp-checkin" name="date_from"
                                value="{{ \Session::get('date_from') }}" data-from="{{ \Session::get('date_from') }}">
                            <input type="hidden" class="shbdp-checkout" name="date_to"
                                value="{{ \Session::get('date_to') }}" data-to="{{ \Session::get('date_to') }}">
                            <input type="hidden" name="room_one_adult" class="shb-guestclass"
                                value="{{ \Session::get('room_one_adult') }}">
                            <input type="hidden" name="room_one_child" class="shb-guestclass"
                                value="{{ \Session::get('room_one_child') }}">
                            <input type="hidden" name="room_two_adult" class="shb-guestclass"
                                value="{{ \Session::get('room_two_adult') }}">
                            <input type="hidden" name="room_two_child" class="shb-guestclass"
                                value="{{ \Session::get('room_two_child') }}">
                        </form>
                    </div>
                </div>


                <!-- END .shb-booking-page-sidebar -->
            </div>
            <div class="lg:basis-3/4 booking-right-column">
                <div class="shb-booking-page-main">
                    <div class="shb-booking-step-wrapper shb-clearfix">
                      <div class="shb-booking-step shb-booking-step-current"><a href="javascript:void(0)">1</a><a href="javascript:void(0)">Rooms</a></div>
                      <div class="shb-booking-step "><a href="javascript:void(0)">2</a><a href="javascript:void(0)">Booking Summary</a></div>
                      <div class="shb-booking-step "><a href="javascript:void(0)">3</a><a href="javascript:void(0)">Payment</a></div>
                      <div class="shb-booking-step "><a href="javascript:void(0)">4</a><a href="javascript:void(0)">Complete</a></div>
                      <div class="shb-booking-step-line">
                        <div style="width:0%;"></div>
                      </div>
                    </div>
                    <div class="col">
                        <div class="booking-form-wrap desktop">
                            <form action="{{ url('/search') }}" method="post"
                                class="shb-booking-form-style-1 shb-booking-form-1-column-4 shb-clearfix"
                                autocomplete="off">
                                @csrf
                                <div class="shbdp-cal-wrapper shbdp-clearfix" data-panels="2"
                                    style="top: 93px; left: 0px; display: none;">
                                    <div class="shbdp-clearboth"></div>
                                    <div class="shbdp-cal">
                                        <div class="shbdp-item shbdp-item-open-1">
                                            <div class="shbdp-month-title">January 2023</div>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td>Mo</td>
                                                        <td>Tu</td>
                                                        <td>We</td>
                                                        <td>Th</td>
                                                        <td>Fr</td>
                                                        <td>Sa</td>
                                                        <td>Su</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td data-date="2023-01-01"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">1</td>
                                                    </tr>
                                                    <tr>
                                                        <td data-date="2023-01-02"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">2</td>
                                                        <td data-date="2023-01-03"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">3</td>
                                                        <td data-date="2023-01-04"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">4</td>
                                                        <td data-date="2023-01-05"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">5</td>
                                                        <td data-date="2023-01-06"
                                                            class="shbdp-datepicker-date shbdp-cal-available shbdp-cal-selected-checkin shbdp-cal-selected-date">
                                                            6</td>
                                                        <td data-date="2023-01-07"
                                                            class="shbdp-datepicker-date shbdp-cal-available shbdp-cal-selected-date shbdp-cal-selected-checkout">
                                                            7</td>
                                                        <td data-date="2023-01-08"
                                                            class="shbdp-datepicker-date shbdp-cal-available">8</td>
                                                    </tr>
                                                    <tr>
                                                        <td data-date="2023-01-09"
                                                            class="shbdp-datepicker-date shbdp-cal-available">9</td>
                                                        <td data-date="2023-01-10"
                                                            class="shbdp-datepicker-date shbdp-cal-available">10</td>
                                                        <td data-date="2023-01-11"
                                                            class="shbdp-datepicker-date shbdp-cal-available">11</td>
                                                        <td data-date="2023-01-12"
                                                            class="shbdp-datepicker-date shbdp-cal-available">12</td>
                                                        <td data-date="2023-01-13"
                                                            class="shbdp-datepicker-date shbdp-cal-available">13</td>
                                                        <td data-date="2023-01-14"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">14</td>
                                                        <td data-date="2023-01-15"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">15</td>
                                                    </tr>
                                                    <tr>
                                                        <td data-date="2023-01-16"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">16</td>
                                                        <td data-date="2023-01-17"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">17</td>
                                                        <td data-date="2023-01-18"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">18</td>
                                                        <td data-date="2023-01-19"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">19</td>
                                                        <td data-date="2023-01-20"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">20</td>
                                                        <td data-date="2023-01-21"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">21</td>
                                                        <td data-date="2023-01-22"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">22</td>
                                                    </tr>
                                                    <tr>
                                                        <td data-date="2023-01-23"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">23</td>
                                                        <td data-date="2023-01-24"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">24</td>
                                                        <td data-date="2023-01-25"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">25</td>
                                                        <td data-date="2023-01-26"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">26</td>
                                                        <td data-date="2023-01-27"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">27</td>
                                                        <td data-date="2023-01-28"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">28</td>
                                                        <td data-date="2023-01-29"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">29</td>
                                                    </tr>
                                                    <tr>
                                                        <td data-date="2023-01-30"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">30</td>
                                                        <td data-date="2023-01-31"
                                                            class="shbdp-datepicker-date shbdp-cal-disabled">31</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <input type="hidden" class="shbdp-checkin" name="date_from"
                                        value="{{ \Session::get('date_from') }}"
                                        data-from="{{ \Session::get('date_from') }}">
                                    <input type="hidden" class="shbdp-checkout" name="date_to"
                                        value="{{ \Session::get('date_to') }}" data-to="{{ \Session::get('date_to') }}">
                                    <input type="hidden" class="shbdp-min" value="">
                                    <input type="hidden" class="shbdp-max" value="">
                                </div>


                                <!-- BEGIN .shb-guestclass-select-dropdown -->
                                <div class="shb-guestclass-select-dropdown">
                                    <p>Room 1</p>

                                    <!-- BEGIN .shb-guestclass-select-section -->
                                    <div class="shb-guestclass-select-section shb-clearfix">

                                        <label>Adult <span>Age 12 year or above</span></label>

                                        <div class="shb-qty-selection shb-clearfix">
                                            <button type="button" class="shb-qty-decrease">-</button>
                                            <div class="shb-qty-display">{{ \Session::get('room_one_adult') }}</div>
                                            <button type="button" class="shb-qty-increase">+</button>
                                        </div>

                                        <input type="hidden" name="room_one_adult" class="shb-guestclass"
                                            value="{{ \Session::get('room_one_adult') }}">

                                        <!-- END .shb-guestclass-select-section -->
                                    </div>


                                    <!-- BEGIN .shb-guestclass-select-section -->
                                    <div class="shb-guestclass-select-section shb-clearfix">

                                        <label>Child <span>Age 12 year below</span></label>

                                        <div class="shb-qty-selection shb-clearfix">
                                            <button type="button" class="shb-qty-decrease">-</button>
                                            <div class="shb-qty-display">{{ \Session::get('room_one_child') }}</div>
                                            <button type="button" class="shb-qty-increase">+</button>
                                        </div>

                                        <input type="hidden" name="room_one_child" class="shb-guestclass"
                                            value="{{ \Session::get('room_one_child') }}">

                                        <!-- END .shb-guestclass-select-section -->
                                    </div>


                                    <p class="show_filter_2_room"
                                        style="display: {{ roomTwoCheck() ? 'block' : 'none' }}">Room 2</p>

                                    <!-- BEGIN .shb-guestclass-select-section -->
                                    <div class="shb-guestclass-select-section shb-clearfix show_filter_2_room"
                                        style="display: {{ roomTwoCheck() ? 'block' : 'none' }}">

                                        <label>Adult <span>Age 12 year or above</span></label>

                                        <div class="shb-qty-selection shb-clearfix">
                                            <button type="button" class="shb-qty-decrease">-</button>
                                            <div class="shb-qty-display" id="other-shb-qty-display-107">
                                                {{ \Session::get('room_two_adult') }}
                                            </div>
                                            <button type="button" class="shb-qty-increase">+</button>
                                        </div>

                                        <input type="hidden" name="room_two_adult" class="shb-guestclass"
                                            value="{{ \Session::get('room_two_adult') }}">

                                        <!-- END .shb-guestclass-select-section -->
                                    </div>


                                    <!-- BEGIN .shb-guestclass-select-section -->
                                    <div class="shb-guestclass-select-section shb-clearfix show_filter_2_room"
                                        style="display: {{ roomTwoCheck() ? 'block' : 'none' }}">

                                        <label>Child <span>Age 12 year below</span></label>

                                        <div class="shb-qty-selection shb-clearfix">
                                            <button type="button" class="shb-qty-decrease">-</button>
                                            <div class="shb-qty-display" id="other-shb-qty-display-108">
                                                {{ \Session::get('room_two_child') }}
                                            </div>
                                            <button type="button" class="shb-qty-increase">+</button>
                                        </div>

                                        <input type="hidden" name="room_two_child" class="shb-guestclass"
                                            value="{{ \Session::get('room_two_child') }}">

                                        <!-- END .shb-guestclass-select-section -->
                                    </div>



                                    <button type="button" class="shb-qty-done shb-qty-ok">Ok</button>
                                    <button type="button" class="add_another_room" onclick="return add_another_room()"
                                        style="background: {{ roomTwoCheck() ? 'rgb(207, 33, 86)' : 'rgb(30, 48, 106)' }}"><span
                                            id="add_another_room">
                                            {{ roomTwoCheck()
                                                ? 'X REMOVE THE ROOM'
                                                : '+ ADD ANOTHER
                                                                                        ROOM' }}
                                        </span></button>
                                    <!-- END .shb-guestclass-select-dropdown -->
                                </div>


                                <!-- BEGIN .shb-booking-form-col -->
                                <div class="shb-booking-form-col shbdp-checkin-wrapper shb-clearfix">

                                    <i class="far fa-calendar"></i>
                                    <div class="shb-booking-form-col-field">
                                        <label>Check In</label>
                                        <span class="shbdp-checkin-display">DD/MM/YYYY</span>
                                    </div>

                                    <!-- END .shb-booking-form-col -->
                                </div>

                                <!-- BEGIN .shb-booking-form-col -->
                                <div class="shb-booking-form-col shbdp-checkout-wrapper shb-clearfix">

                                    <i class="far fa-calendar"></i>
                                    <div class="shb-booking-form-col-field">
                                        <label>Check Out</label>
                                        <span class="shbdp-checkout-display">DD/MM/YYYY</span>
                                    </div>

                                    <!-- END .shb-booking-form-col -->
                                </div>

                                <!-- BEGIN .shb-booking-form-col -->
                                <div class="shb-booking-form-col shb-guestclass-selection shb-clearfix">

                                    <i class="fas fa-user-friends"></i>
                                    <div class="shb-booking-form-col-field">
                                        <label>Guests/Rooms</label>
                                        <span><span class="shb-guestclass-total">
                                                {{ \Session::get('room_one_adult') + \Session::get('room_one_child') + \Session::get('room_two_adult') + \Session::get('room_two_child') }}
                                            </span> Guest(s)</span>
                                    </div>

                                    <!-- END .shb-booking-form-col -->
                                </div>
                                <!-- BEGIN .shb-booking-form-col -->
                                <div class="shb-booking-form-col shb-clearfix">

                                    <input type="submit" value="Book Now" class="shb-booking-form-button">

                                    <!-- END .shb-booking-form-col -->
                                </div>

                                <!-- END .shb-booking-form-style-1 -->
                            </form>
                        </div>
                        <ul class="hotal-rooms-wrap">
                            @forelse ($hotels as $key => $hotel)
                                <li class="hotal-rooms-item">
                                    <div class="hotal-rooms" id="hotel-{{ $hotel->id }}">
                                        <div class="hotal-image">
                                            <a>
                                                <img src="{{ url('/uploads/hotels/' . $hotel->image) }}" alt="{{ $hotel->name }}" />
                                            </a>
                                        </div>
                                        <div class="hotal-detail">
                                            <h2> <a>{{ $hotel->name }}</a>
                                                <span class="status">Available</span>
                                            </h2>

                                            <span class="room-cat-drop">Room Category <i
                                                    class="fas fa-chevron-down"></i></span>
                                            <p>{{ $hotel->description }} </p>
                                            <ul class="info">
                                                <li>
                                                    <a href="{{ $hotel->location }}"><i class="fas fa-map-marker-alt"></i>Location</a>
                                                </li>
                                                <li><strong>Airport</strong>: {{ $hotel->airport_distance }}KM</li>
                                                <li><strong>Venue:</strong> {{ $hotel->venue_distance }}KM</li>
                                                <li><a href="{{ $hotel->website }}" target="_blank"><i class="fas fa-globe"></i>Website </a> </li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i><span>Rating:
                                                    </span>{{ $hotel->classification }}
                                                </li>
                                            </ul>
                                            <div class="rates hidden">
                                                <ul>
                                                    @forelse ($hotel->rooms as $key => $room)
                                                        <li>
                                                            <div
                                                                class="booking-rate-info flex content-center justify-between">
                                                                <div class="search_left w-70">
                                                                    <h3 class="custom_the_title"><a
                                                                            href="#">{{ $room->room_type }}</a></h3>
                                                                    <span class="custom_shb_short_description">Room type:
                                                                        {{ $room->name }}</span>
                                                                </div>
                                                                <div class="search_center">
                                                                    <h3 class="custom_the_per_night"><a
                                                                            href="javascript:void(0)" class="per_night">
                                                                            ₹@convert($room->rate)<span> / Night</span><span
                                                                                class="tax_inclusive">Tax
                                                                                Inclusive</span></a></h3>
                                                                </div>
                                                                <div class="search_right">
                                                                    <!-- <p class="custom_hotel_sold_out">Sold-out</p> -->
                                                                    <a href="javascript::void(0)"
                                                                        class="bookRoom hotel-search-button px-4 py-2 font-semibold text-sm bg-slate-900 text-white rounded-5 shadow-sm"
                                                                        data-room="{{ $room }}"> Book
                                                                        ₹@convert(Session::get('nights') * $room->rate) </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </li>
                            @empty
                            <p>No Record found!</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                var root_url = "<?php echo Request::root(); ?>";
                // $('.brand-init').on('click', '.editItem', function() {
                $('.bookRoom').click(function() {
                    var room = $(this).attr('data-room');
                    var hotel = $(this).attr('data-hotel');

                    $.ajax({
                        url: root_url + '/add-room',
                        data: {
                            'room': room,
                            "_token": "{{ csrf_token() }}",
                        },
                        //dataType: "html",
                        method: "POST",
                        cache: false,
                        success: function(data) {
                            if (data.success) {
                                if (data.addRooms) {
                                    // disabled
                                    var roomJson = JSON.parse(room)
                                    $('.hotal-rooms:not(#hotel-' + roomJson.hotel_id + ')').addClass('disabled')
                                    // $.alert({
                                    //     title: 'Warning!',
                                    //     content: 'Please add one more room!',
                                    // });

                                    lnv.alert({
                                        title: 'Warning!',
                                        content: 'Please add one more room!',
                                        alertBtnText: 'Ok',

                                    })


                                } else {
                                    window.location.href = root_url + '/booking-summary';
                                }
                            }
                        }
                    });
                });

                $('.room-cat-drop').click(function() {
                    var elem = $(this).closest('.hotal-rooms')
                    elem.find('.rates').slideToggle('slow')
                })
            </script>

        @endsection
