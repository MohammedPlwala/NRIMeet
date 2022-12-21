@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>Home Stay Registration</h1>
  </div>
  <section class="mahakal-lok-darshan-wrap">
    <div class="container">
      
      <div class="ujjain">
        <h3 class="heading3">Registration</h3>
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
        <div class="custom-form">
          {!! NoCaptcha::renderJs() !!}
          <form action="{{url('/home-stay-registration')}}" method="post" enctype="multipart/form-data" autocomplete="off" data-parsley-validate="">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4 md:gap-y-2 gap-2">
              <div class="form-item large">
                <label class="form-label">Full Name: <span class="required" title="required">*</span></label>
                <input type="text" name="full_name" id="full_name" value="" placeholder="Full Name" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Email Id: <span class="required" title="required">*</span></label>
                <input type="email" name="email_id" id="email_id" value="" placeholder="Email Id" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Phone/Mobile No: <span class="required" title="required">*</span></label>
                <div class="form-input-group">
                  <div class="country-code">
                    <input type="tel" name="country_code" id="country_code" value="" size="40" placeholder="Country Code" required />
                  </div>
                  <div class="phone-or-mobile-no">
                    <input type="tel" name="phone_or_mobile_no" id="phone_or_mobile_no" data-parsley-type="number" value="" size="40" placeholder="Phone/Mobile No." required />
                  </div>
                </div>
              </div>
              <div class="form-item large">
                <label class="form-label">Address <span class="required" title="required">*</span></label>
                <textarea name="adress" required></textarea>
              </div>
              <div class="form-item large">
                <label class="form-label">Country of Residence <span class="required" title="required">*</span></label>
                <input type="text" name="country" value="" size="40" placeholder="Country of Residence" required />
              </div>
              <div class="form-item large">
                <label class="form-label">City <span class="required" title="required">*</span></label>
                <input type="text" name="city" value="" size="40" placeholder="City" required />
              </div>
            </div>

            <div>
              <div class="form-item large">
                <label class="form-label">Adult 1: <span class="required" title="required">*</span></label>
                <input type="text" name="guest_1_name" id="guest_1_name" value="" placeholder="Full Name" required />
                <input type="text" name="guest_1_age" id="guest_1_age" value="" placeholder="Age" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Adult 2: <span class="required" title="required">*</span></label>
                <input type="text" name="guest_2_name" id="guest_2_name" value="" placeholder="Full Name" required />
                <input type="text" name="guest_2_age" id="guest_2_age" value="" placeholder="Full Name" required />
              </div>
            </div>

            <div class="form-item-box">
              <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4 md:gap-y-2 gap-2">
                <div class="form-item large">
                  <div class="time_select">
                    <label class="form-label">From </label>
                    <span class="wpcf7-form-control-wrap" data-name="menu-998">
                        <input type="date" name="from_date">
                    </span>
                  </div>
                </div>
                <div class="form-item large">
                  <div class="time_select">
                    <label class="form-label">To   </label>
                    <span class="wpcf7-form-control-wrap" data-name="menu-573">
                        <input type="date" name="to_date">
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <p class="mahakal_lok">Shuttle service is organised by MP Govt on 10th Jan 2023.<br>
              Shuttle service are complimentary.
            </p>
            <div class="form-item large">
              {!! app('captcha')->display() !!}
            </div>

            <div class="form-button">	
              <button type="submit" class="primary-button md" name="mahakal_lok_darshan_form" id="mahakal_lok_darshan_form" value="Submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('footerScripts')
<script type="text/javascript">
  window.Parsley.addValidator('maxFileSize', {
    validateString: function(_value, maxSize, parsleyInstance) {
      var files = parsleyInstance.$element[0].files;
      return files.length != 1 || files[0].type == 'application/pdf' || files[0].type == 'image/jpeg';
    },
    requirementType: 'integer',
    messages: {
      en: 'This file should match file criteria'
    }
  });
</script>
@endpush
