@extends('frontend.layouts.app')

@section('content')

    <div class="flex">
        <div class="flex-1 w-30">
            <!-- BEGIN .shb-booking-page-sidebar -->
            <div class="shb-booking-page-sidebar customer_filter">
                <!-- //v2care -->
                <div class="custom_filter_main_div">
                    <form id="search" action="https://pbdaccommodation.mptourism.com/bookings/" method="get">
                        <div class="custom_filter_innder_div">
                            <label for="shb-hotal-name" class="filter_label">Hotel name</label>
                            <input id="s" name="shb-hotal-name" id="shb-hotal-name" type="text"
                                placeholder="Search by Hotel Name" value="" />
                        </div>
                        <div class="custom_rangeslider">
                            <label for="shb-hotal-rating" class="filter_label">Price</label>
                            <div class="range-slider">
                                <span class="rangeValues"></span>
                                <input value="3000" min="3000" max="23000" step="500" type="range"
                                    name="shb-hotal-price-min">
                                <input value="23000" min="3000" max="23000" step="500" type="range"
                                    name="shb-hotal-price-max">
                            </div>
                        </div>
                        <div class="custom_filter_innder_div" style="margin-top: 76px;">
                            <label for="shb-hotal-rating" class="filter_label">Rating</label>
                            <select name="shb-hotal-rating" id="shb-hotal-rating" class="form-control form-control-lg">
                                <option value="">Select Rating</option>
                                <!-- END <option    value="1 Star">1 Star</option>
          <option    value="2 Star">2 Star</option> -->
                                <option value="5 Star">5 Star</option>
                                <option value="4 Star">4 Star</option>
                                <option value="3 Star">3 Star</option>


                            </select>
                            <br>
                        </div>

                        <div class="custom_filter_innder_div filter_sortby">
                            <label class="filter_label">Sort By</label>
                            <label for="price_low_to_high"><input type="radio" id="price_low_to_high"
                                    onchange="this.form.submit()" name="shb-orderby" value="p1">Price Low to
                                High</label>
                            <label for="price_high_to_low"><input type="radio" id="price_high_to_low"
                                    onchange="this.form.submit()" name="shb-orderby" value="p2">Price High to
                                Low</label>
                            <label for="rating_5_star_to_1_star"><input type="radio" id="rating_5_star_to_1_star"
                                    onchange="this.form.submit()" name="shb-orderby" value="r2">Rating 5 Star Deluxe to
                                3 Star</label>
                            <label for="rating_1_star_to_5_star"><input type="radio" id="rating_1_star_to_5_star"
                                    onchange="this.form.submit()" name="shb-orderby" value="r1">Rating 3 Star to 5 Star
                                Deluxe</label>

                        </div>
                        <a href="https://pbdaccommodation.mptourism.com/bookings/" class="hotel-search-button_clear">Clear
                            All</a>
                        <input type="submit" class="hotel-search-button" name="" value="Search">

                    </form>
                </div>
            </div>


            <!-- END .shb-booking-page-sidebar -->
        </div>
        <div class="flex-1 w-70">
            <div class="shb-booking-page-main">
                <div class="shb-booking-step-wrapper shb-clearfix">
                    <div class="shb-booking-step shb-booking-step-current"><a
                            href="https://pbdaccommodation.mptourism.com/bookings/?shb-step=1">1</a><a
                            href="https://pbdaccommodation.mptourism.com/bookings/?shb-step=1">Rooms</a></div>
                    <div class="shb-booking-step "><a href="#">2</a><a href="#">Booking Summary</a></div>
                    <div class="shb-booking-step "><a href="#">3</a><a href="#">Payment</a></div>
                    <div class="shb-booking-step "><a href="#">4</a><a href="#">Complete</a></div>
                    <div class="shb-booking-step-line">
                        <div style="width:0%;"></div>
                    </div>
                </div>
                <div class="pt-14"></div>
                <div class="pt-14"></div>
                <div class="pt-14"></div>
                <div class="col">
                    <div class="booking-form-wrap desktop">
                        <form action="/bookings/" method="post"
                            class="shb-booking-form-style-1 shb-booking-form-1-column-4 shb-clearfix" autocomplete="off">

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
                                </div><input type="hidden" class="shbdp-checkin" name="shbdp-checkin"
                                    value=""><input type="hidden" class="shbdp-checkout" name="shbdp-checkout"
                                    value=""><input type="hidden" class="shbdp-min" value=""><input
                                    type="hidden" class="shbdp-max" value="">
                            </div>



                            <!-- BEGIN .shb-guestclass-select-dropdown -->
                            <div class="shb-guestclass-select-dropdown">
                                <p>Room 1</p>

                                <!-- BEGIN .shb-guestclass-select-section -->
                                <div class="shb-guestclass-select-section shb-clearfix">

                                    <label>Adult <span>Age 12 year or above</span></label>

                                    <div class="shb-qty-selection shb-clearfix">
                                        <button type="button" class="shb-qty-decrease">-</button>
                                        <div class="shb-qty-display">1</div>
                                        <button type="button" class="shb-qty-increase">+</button>
                                    </div>

                                    <input type="hidden" name="room_one_adult" class="shb-guestclass"
                                        value="1">

                                    <!-- END .shb-guestclass-select-section -->
                                </div>


                                <!-- BEGIN .shb-guestclass-select-section -->
                                <div class="shb-guestclass-select-section shb-clearfix">

                                    <label>Child <span>Age 12 year or below</span></label>

                                    <div class="shb-qty-selection shb-clearfix">
                                        <button type="button" class="shb-qty-decrease">-</button>
                                        <div class="shb-qty-display">0</div>
                                        <button type="button" class="shb-qty-increase">+</button>
                                    </div>

                                    <input type="hidden" name="room_one_child" class="shb-guestclass"
                                        value="0">

                                    <!-- END .shb-guestclass-select-section -->
                                </div>


                                <p class="show_filter_2_room">Room 2</p>

                                <!-- BEGIN .shb-guestclass-select-section -->
                                <div class="shb-guestclass-select-section shb-clearfix show_filter_2_room">

                                    <label>Adult <span>Age 12 year or above</span></label>

                                    <div class="shb-qty-selection shb-clearfix">
                                        <button type="button" class="shb-qty-decrease">-</button>
                                        <div class="shb-qty-display" id="other-shb-qty-display-107">0</div>
                                        <button type="button" class="shb-qty-increase">+</button>
                                    </div>

                                    <input type="hidden" name="room_two_adult" class="shb-guestclass"
                                        value="0">

                                    <!-- END .shb-guestclass-select-section -->
                                </div>


                                <!-- BEGIN .shb-guestclass-select-section -->
                                <div class="shb-guestclass-select-section shb-clearfix show_filter_2_room">

                                    <label>Child <span>Age 12 year or below</span></label>

                                    <div class="shb-qty-selection shb-clearfix">
                                        <button type="button" class="shb-qty-decrease">-</button>
                                        <div class="shb-qty-display" id="other-shb-qty-display-108">0</div>
                                        <button type="button" class="shb-qty-increase">+</button>
                                    </div>

                                    <input type="hidden" name="room_two_child" class="shb-guestclass"
                                        value="0">

                                    <!-- END .shb-guestclass-select-section -->
                                </div>



                                <button type="button" class="shb-qty-done shb-qty-ok">Ok</button>
                                <button type="button" class="add_another_room" onclick="return add_another_room()"><span
                                        id="add_another_room">+ ADD ANOTHER ROOM</span></button>
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
                                    <span><span class="shb-guestclass-total">1</span> Guest(s)</span>
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

                        <ul>
                            <li>
                                <div class="hotal-rooms">
                                    <div class="hotal-image">
                                        <img src="" />
                                    </div>
                                    <div class="hotal-detail">
                                        <h2>Sheraton Grand Palace</h2>
                                        <span class="status">Available</span>
                                        <span class="room-cat-drop">Room Category</span>
                                        <p>One of the best luxury hotels in Indore, WOW is the epitome of luxury. Drawing
                                            inspiration for its décor from the Peacock, India’s national bird, WOW oozes
                                            oomph & panache. Its interior provokes a sense of lively ambiance with
                                            pigmenting bright emeralds, cobalt blues and turquoises, embedded with golden
                                            hues. </p>
                                        <ul>
                                            <li><a href="https://www.google.com/maps/place/WOW+Hotel+-+Hotel+in+Indore/@22.7488125,75.8937421,15z/data=!4m2!3m1!1s0x0:0x9279e450afac0e96?sa=X&amp;hl=en&amp;ved=2ahUKEwikxPaT5IX7AhVNcWwGHdBhA3AQ_BJ6BQjcARAF"
                                                    ><i class="fas fa-map-marker-alt"></i></a>Location </li>
                                            <li><strong>Airport</strong>: 19KM</li>
                                            <li><strong>Venue:</strong> 3.5KM</li>
                                            <li><a href="https://www.wowhotel.com/" target="_blank"><i
                                                        class="fas fa-globe"></i>Website </a> </li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i><span>Rating: </span>5 Star
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

    @endsection