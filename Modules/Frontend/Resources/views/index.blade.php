@extends('frontend.layouts.app')

@section('content')
<div class="sohohotel-content-wrapper">
    <div class="main-banner">
        <img src="{{ url('images/PBD2023-slider.png') }}" alt="PBD2023-slider" class="m-hide" />
        <img src="{{ url('images/mobile-slider-2.png') }}" alt="mobile-slider-2" class="d-hide" />
    </div>
    <div class="booking-form-wrap booking-form-wrap-home desktop">
        <form action="{{ url('/search') }}" method="post"
            class="shb-booking-form-style-1 shb-booking-form-1-column-4 shb-clearfix" autocomplete="off">
            @csrf
            <div class="shbdp-cal-wrapper shbdp-clearfix" data-panels="2" style="top: 93px; left: 0px; display: none;">
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
                                    <td data-date="2023-01-01" class="shbdp-datepicker-date shbdp-cal-disabled">1</td>
                                </tr>
                                <tr>
                                    <td data-date="2023-01-02" class="shbdp-datepicker-date shbdp-cal-disabled">2</td>
                                    <td data-date="2023-01-03" class="shbdp-datepicker-date shbdp-cal-disabled">3</td>
                                    <td data-date="2023-01-04" class="shbdp-datepicker-date shbdp-cal-disabled">4</td>
                                    <td data-date="2023-01-05" class="shbdp-datepicker-date shbdp-cal-disabled">5</td>
                                    <td data-date="2023-01-06"
                                        class="shbdp-datepicker-date shbdp-cal-available shbdp-cal-selected-checkin shbdp-cal-selected-date">
                                        6</td>
                                    <td data-date="2023-01-07"
                                        class="shbdp-datepicker-date shbdp-cal-available shbdp-cal-selected-date shbdp-cal-selected-checkout">
                                        7</td>
                                    <td data-date="2023-01-08" class="shbdp-datepicker-date shbdp-cal-available">8</td>
                                </tr>
                                <tr>
                                    <td data-date="2023-01-09" class="shbdp-datepicker-date shbdp-cal-available">9</td>
                                    <td data-date="2023-01-10" class="shbdp-datepicker-date shbdp-cal-available">10</td>
                                    <td data-date="2023-01-11" class="shbdp-datepicker-date shbdp-cal-available">11</td>
                                    <td data-date="2023-01-12" class="shbdp-datepicker-date shbdp-cal-available">12</td>
                                    <td data-date="2023-01-13" class="shbdp-datepicker-date shbdp-cal-available">13</td>
                                    <td data-date="2023-01-14" class="shbdp-datepicker-date shbdp-cal-disabled">14</td>
                                    <td data-date="2023-01-15" class="shbdp-datepicker-date shbdp-cal-disabled">15</td>
                                </tr>
                                <tr>
                                    <td data-date="2023-01-16" class="shbdp-datepicker-date shbdp-cal-disabled">16</td>
                                    <td data-date="2023-01-17" class="shbdp-datepicker-date shbdp-cal-disabled">17</td>
                                    <td data-date="2023-01-18" class="shbdp-datepicker-date shbdp-cal-disabled">18</td>
                                    <td data-date="2023-01-19" class="shbdp-datepicker-date shbdp-cal-disabled">19</td>
                                    <td data-date="2023-01-20" class="shbdp-datepicker-date shbdp-cal-disabled">20</td>
                                    <td data-date="2023-01-21" class="shbdp-datepicker-date shbdp-cal-disabled">21</td>
                                    <td data-date="2023-01-22" class="shbdp-datepicker-date shbdp-cal-disabled">22</td>
                                </tr>
                                <tr>
                                    <td data-date="2023-01-23" class="shbdp-datepicker-date shbdp-cal-disabled">23</td>
                                    <td data-date="2023-01-24" class="shbdp-datepicker-date shbdp-cal-disabled">24</td>
                                    <td data-date="2023-01-25" class="shbdp-datepicker-date shbdp-cal-disabled">25</td>
                                    <td data-date="2023-01-26" class="shbdp-datepicker-date shbdp-cal-disabled">26</td>
                                    <td data-date="2023-01-27" class="shbdp-datepicker-date shbdp-cal-disabled">27</td>
                                    <td data-date="2023-01-28" class="shbdp-datepicker-date shbdp-cal-disabled">28</td>
                                    <td data-date="2023-01-29" class="shbdp-datepicker-date shbdp-cal-disabled">29</td>
                                </tr>
                                <tr>
                                    <td data-date="2023-01-30" class="shbdp-datepicker-date shbdp-cal-disabled">30</td>
                                    <td data-date="2023-01-31" class="shbdp-datepicker-date shbdp-cal-disabled">31</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><input type="hidden" class="shbdp-checkin" name="date_from" value=""><input type="hidden"
                    class="shbdp-checkout" name="date_to" value=""><input type="hidden" class="shbdp-min"
                    value=""><input type="hidden" class="shbdp-max" value="">
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

                    <input type="hidden" name="room_one_adult" class="shb-guestclass" value="1">

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

                    <input type="hidden" name="room_one_child" class="shb-guestclass" value="0">

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

                    <input type="hidden" name="room_two_adult" class="shb-guestclass" value="0">

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

                    <input type="hidden" name="room_two_child" class="shb-guestclass" value="0">

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
    </div>
    <div class="container mx-auto">
        <ul class="client-logos">
            <li>
                <a href="https://www.mea.gov.in/" target="_blank"><img src="{{ url('images/Group-64403.png') }}"
                        alt="Group-64403" /></a>
            </li>
            <li>
                <a href="https://www.india.gov.in/" target="_blank"><img src="{{ url('images/Group-64404.png') }}"
                        alt="Group-64404" /></a>
            </li>
            <li>
                <a href="https://mp.gov.in/" target="_blank"><img src="{{ url('images/Rectangle-16349.png') }}"
                        alt="Rectangle-16349" /></a>
            </li>
        </ul>
    </div>
  </div>
@endsection
