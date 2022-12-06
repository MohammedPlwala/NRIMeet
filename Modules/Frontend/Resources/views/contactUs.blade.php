@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>Contact Us</h1>
  </div>
  <section class="contact-us-wrap">
    <div class="container">
    	@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
		@endif
		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    <strong>{{ $message }}</strong>
		</div>
		@endif
      <h3 class="heading3 border-line">Contact Details</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-12 md:gap-y-2 gap-2">
        <div class="contact-us-left contact-form">
          {!! NoCaptcha::renderJs() !!}
          <form action="{{url('/contact')}}" method="post" autocomplete="off">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-4 md:gap-y-2 gap-2">
              <div class="form-item large">
                <input type="text" name="full_name" id="full_name" value="" placeholder="Full Name: *" required />
              </div>
              <div class="form-item large">
                <input type="email" name="contact_email" value="" size="40" placeholder="Email: *" required />
              </div>
              <div class="form-item large">
                <input type="tel" name="contact_tel" value="" size="40" placeholder="Phone: *" required />
              </div>
            </div>
            <div class="form-item large">
              <textarea name="contact_message" cols="40" rows="5" placeholder="Message: *" required></textarea>
            </div>
            <div class="form-item large">
              {!! app('captcha')->display() !!}
            </div>
            <div class="form-button">	
              <button type="submit" class="primary-button md" name="mahakal_lok_darshan_form" id="mahakal_lok_darshan_form" value="Submit">Submit</button>
            </div>
          </form>
        </div>
        <div class="contact-us-right">
          <p>Our representatives are available to assist you 24*7!<br> Hindi and English languages.</p>
          <ul class="contact-option-list">
            <li>
              <a href="https://api.whatsapp.com/send?phone=+919893908123&amp;text=Welcome%20to%20Pravasi%20Bharatiya%20Divas%202023" target="_blank" rel="noopener"><span class="icon whatsapp-icon"><i class="fab fa-whatsapp"></i></span> +91 9893908123</a>  | WhatsApp Support
            </li>
            <li>
              <a href="tel:+91 731 244 4404"><span class="icon"><i class="fas fa-phone-alt"></i></span> +91 731 244 4404</a>
            </li>
            <li>
              <a href="mailto: events@overseastravels.co.in"><span class="icon"><i class="fas fa-envelope"></i></span> events@overseastravels.co.in</a>
            </li>
          </ul>
          <!-- <div class="wpb_text_column wpb_content_element ">
            <div class="wpb_wrapper">
              <div class="contact_right_icon">
                <a href="https://api.whatsapp.com/send?phone=+919893908123&amp;text=Welcome%20to%20Pravasi%20Bharatiya%20Divas%202023" target="_blank" rel="noopener"> <i class="fab fa-whatsapp"></i> +91 9893908123</a> | WhatsApp Support
              </div>
              <div class="contact_right_icon">
                <a href="tel:+91 731 244 4404"> <i class="fa fa-phone"></i> +91 731 244 4404</a>
              </div>
            </div>
          </div>
          <div class="wpb_single_image wpb_content_element vc_align_left   email">	
            <figure class="wpb_wrapper vc_figure">
              <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="500" height="50" src="https://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/email.png" class="vc_single_image-img attachment-large" alt="" loading="lazy" title="email"></div>
            </figure>
          </div> -->
        </div>
      </div>
    </div>
  </section>
@endsection
