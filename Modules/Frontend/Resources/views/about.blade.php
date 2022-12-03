@extends('frontend.layouts.app')

@section('content')
    <div class="main-banner">
        <img src="./images/PBD2023-slider.png" alt="PBD2023-slider" class="m-hide" />
        <img src="./images/mobile-slider-2.png" alt="mobile-slider-2" class="d-hide" />
    </div>
    <div class="booking-form-wrap">
      <form action="https://pbdaccommodation.mptourism.com/bookings/" method="post" class="shb-booking-form-style-1 shb-booking-form-1-column-4 shb-clearfix" autocomplete="off">
	
        <p>this is just about page</p>	
          
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
          
              <input type="hidden" name="shb-guestclass-107" class="shb-guestclass" value="1">
        
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
          
              <input type="hidden" name="shb-guestclass-108" class="shb-guestclass" value="0">
        
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
            
                <input type="hidden" name="shb-guestclass-add-another-107" class="shb-guestclass" value="0">
          
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
            
                <input type="hidden" name="shb-guestclass-add-another-108" class="shb-guestclass" value="0">
          
              <!-- END .shb-guestclass-select-section -->
              </div>
            
             
            
          <button type="button" class="shb-qty-done shb-qty-ok">Ok</button> 
          <button type="button" class="add_another_room" onclick="return add_another_room()"><span id="add_another_room">+ ADD ANOTHER ROOM</span></button>
        <!-- END .shb-guestclass-select-dropdown -->
        </div>
       
             
        <!-- BEGIN .shb-booking-form-col -->
        <div class="shb-booking-form-col shbdp-checkin-wrapper shb-clearfix">
          
          <i class="far fa-calendar"></i>
          <div class="shb-booking-form-col-field">
            <label>Check In</label>
            <span class="shbdp-checkin-display">06/01/2023</span>
          </div>
          
        <!-- END .shb-booking-form-col -->
        </div>
        
        <!-- BEGIN .shb-booking-form-col -->
        <div class="shb-booking-form-col shbdp-checkout-wrapper shb-clearfix">
          
          <i class="far fa-calendar"></i>
          <div class="shb-booking-form-col-field">
            <label>Check Out</label>
            <span class="shbdp-checkout-display">07/01/2023</span>
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
                <a href="https://www.mea.gov.in/" target="_blank"><img src="./images/Group-64403.png" alt="Group-64403" /></a>
            </li>
            <li>
                <a href="https://www.india.gov.in/" target="_blank"><img src="./images/Group-64404.png" alt="Group-64404" /></a>
            </li>
            <li>
                <a href="https://mp.gov.in/" target="_blank"><img src="./images/Rectangle-16349.png" alt="Rectangle-16349" /></a>
            </li>
        </ul>
    </div>
@endsection
