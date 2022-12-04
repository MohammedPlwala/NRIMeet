@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="pb-35">
    <div class="marquee">
      <marquee width="100%" direction="left" height="100px">
      Dear PBD Delegates, Govt of M.P. has revised the rates of hotel accommodation. Delegates who have booked the accommodation before 21/11/2022  16:00 hours IST, any excess amount charged will be refunded to their respective bank account with-in 15 working days.
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
              <div class="shb-booking-your-stay-item-wrapper">
                <h3>Room 1</h3>
                <div class="sidebar_left">
                <ul>
                  <li><span></span> Check in - Jan 06, 2023 Check out - Jan 07, 2023</li>
                  <li><span>Guests:</span> 2 Adults, 1 Child</li>
                </ul>
                </div>
                <div class="sidebar_center">
                <!-- BEGIN .shb-booking-your-stay-item -->
                <div class="shb-booking-your-stay-item shb-clearfix">
                  <a href="#" class="shb-booking-stay-image">
                    <img src="https://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/WOW-Hotel.jpg" alt="Bookings">
                  </a>
                  <div class="shb-booking-your-stay-item-info">
                    <h4 class="shb-clearfix"><a href="#">WOW Hotel</a><span> ₹10,800</span></h4>
                    <p class="shb-booking-your-stay-item-info-detail">Premium</p>
                    <p class="shb-booking-price-expand"><a href="#">1 Night</a><i class="fas fa-chevron-down"></i></p>
                    <div class="shb-booking-price-expanded">
                      <p class="shb-clearfix"><span>Fri, Jan 06, 2023</span><span> ₹10,800</span></p>							
                    </div>
                  </div>
                <!-- END .shb-booking-your-stay-item -->
                </div>
                </div>
                <div class="sidebar_right">
                  <a href="https://pbdaccommodation.mptourism.com/bookings/?shb-delete-room=1">Remove</a>
                </div>
                <div class="custom_extra_bed">
                  <!-- BEGIN .shb-additionalfee-result-wrapper -->
                  <form
                    class="shb-additionalfee-result-wrapper" 
                    action="https://pbdaccommodation.mptourism.com/bookings/?shb-step=2&amp;shb_selected_fee_room=1" 
                    method="post"
                    autocomplete="off"
                  >
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
                  <!-- END .shb-booking-additionalfee-result-wrapper -->
                  </form>
                </div>
                <!-- BEGIN .shb-booking-your-stay-controls -->
                <div class="shb-booking-your-stay-controls shb-clearfix">
                <!-- END .shb-booking-your-stay-controls -->
                </div>
              <!-- END .shb-booking-your-stay-item-wrapper -->
              </div>
            <!-- END .shb-booking-your-stay-items-wrapper -->
            </div>
            <!-- BEGIN .shb-booking-total -->
            <div class="shb-booking-total border_bottom">
              <h4>Total</h4>
              <h4>₹10,800</h4>
            <!-- END .shb-booking-total -->
            </div>            
            <a href="javascript:void(0)" class="shb-booking-continue" onclick="return shb_booking_continue()">Continue</a>  
          <!-- END .shb-booking-your-stay-wrapper -->
          </div>
        <!-- END .shb-booking-page-sidebar -->
        </div>


        <div class="guests_info_front_main_div">
          <form method="POST" id="guests_info_front_form" autocomplete="off">
            <h3>Room 1</h3>
            <h5>Guests</h5>
            <p>Adults 1</p>
            <div class="Guests_info_front_box">
              <select required name="shb_guest_info_detail[1][107][1][Title]">
                <!--<option value="">Select Title</option> -->
                <option value="Mr">Mr.</option>
                <option value="Miss">Miss</option>
                <option value="Mrs">Mrs.</option>
              </select>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][107][1][First]" value="" placeholder="First Name">
              </div>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][107][1][Last]" value="" placeholder="Last Name">
              </div>
            </div>
            <p>Adults 2</p>
            <div class="Guests_info_front_box">
              <select required name="shb_guest_info_detail[1][107][2][Title]">
                <!--<option value="">Select Title</option> -->
                <option value="Mr">Mr.</option>
                <option value="Miss">Miss</option>
                <option value="Mrs">Mrs.</option>
              </select>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][107][2][First]" value="" placeholder="First Name">
              </div>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][107][2][Last]" value="" placeholder="Last Name">
              </div>
            </div>
            <h5>Children</h5>
            <p>Children 1</p>
            <div class="Guests_info_front_box">
              <select required name="shb_guest_info_detail[1][108][1][Title]">
                <!--<option value="">Select Title</option> -->
                <option value="Mr">Mr.</option>
                <option value="Miss">Miss</option>
                <option value="Mrs">Mrs.</option>
              </select>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][108][1][First]" value="" placeholder="First Name" />
              </div>
              <div class="form-item">
                <input type="text" maxlength="25" required name="shb_guest_info_detail[1][108][1][Last]" value="" placeholder="Last Name" />
              </div>
            </div>
            <p>
              <label>Special Request</label>
              <textarea maxlength="200" rows="1" name="shb_guest_info_comment"></textarea>
            </p>
            <p>
              <input type="checkbox" data-mess=" Please accept the terms and conditions to proceed further with the booking process." name="agree_on" required /> I Agree on <a target="_blank" href="about-us/">About Us</a> | <a target="_blank" href="privacy-policy/">Privacy Policy</a> | <a target="_blank" href="booking-policy/">Booking Policy</a> | <a target="_blank" href="terms-and-conditions/">Terms and conditions</a> | <a target="_blank" href="refund-cancellation-policy/">Refund &amp; Cancellation Policy</a> </p>
              <br>
            <div class="sav_next">
              <input type="submit" value="Save and Next" class="primary-button md" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
