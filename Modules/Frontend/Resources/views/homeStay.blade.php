@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>MP Government Offer FREE Home Stay</h1>
  </div>
  <section class="mahakal-lok-darshan-wrap">
    <div class="container">
      
      <div class="ujjain">
        <h3 class="heading3">FREE Home Stay Registration</h3>

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

        @if ($registered == 1)
        <div class="alert alert-info alert-block">
            <strong>You have successfully registered for Free Home Stay.</strong>
        </div>

        @elseif ($soldOut == 1)
        <div class="alert alert-info alert-block">
            {{-- <button type="button" class="close" data-dismiss="alert">×</button>     --}}
            <strong>Sorry, request for registrations are closed for now. Please check later. </strong>
        </div>
        @endif

        @if ($registered == 0 && $soldOut == 0)
        <div class="custom-form">
          {!! NoCaptcha::renderJs() !!}
          <form action="{{url('/home-stay-registration')}}" method="post" enctype="multipart/form-data" autocomplete="off" data-parsley-validate="">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4 md:gap-y-2 gap-2">
              <div class="form-item large">
                <label class="form-label">Full Name: <span class="required" title="required">*</span></label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Full Name" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Email Id: <span class="required" title="required">*</span></label>
                <input type="email" name="email_id" id="email_id" value="{{ old('email_id') }}" placeholder="Email Id" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Phone/Mobile No: <span class="required" title="required">*</span></label>
                <div class="form-input-group">
                  <div class="country-code">
                    <input type="tel" name="country_code" id="country_code" value="{{ old('country_code') }}" size="40" placeholder="Country Code" required />
                  </div>
                  <div class="phone-or-mobile-no">
                    <input type="tel" name="phone_or_mobile_no" id="phone_or_mobile_no" data-parsley-type="number" size="40" placeholder="Phone/Mobile No." value="{{ old('phone_or_mobile_no') }}" required />
                  </div>
                </div>
              </div>
              <div class="form-item large">
                <label class="form-label">Address <span class="required" title="required">*</span></label>
                <textarea name="address" required>{{ old('address') }}</textarea>
              </div>
              <div class="form-item large">
                <label class="form-label">Country of Residence <span class="required" title="required">*</span></label>
                <input type="text" name="country" size="40" value="{{ old('country') }}" placeholder="Country of Residence" required />
              </div>
              <div class="form-item large">
                <label class="form-label">City <span class="required" title="required">*</span></label>
                <input type="text" name="city" value="{{ old('city') }}" size="40" placeholder="City" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Adult & Age 1 <span class="required" title="required">*</span></label>
                <div class="row g-3 align-center">
                <div class="col-lg-6">
                    <input type="text" name="adult_name_1" value="{{ old('adult_name_1') }}" size="40" placeholder="Name" required />
                </div>
                <div class="col-lg-6">
                    <input type="number" name="adult_age_1" value="{{ old('adult_age_1') }}" size="40" placeholder="Age" required />
                </div>
              </div>
              </div>
              <div class="form-item large">
                <label class="form-label">Adult & Age 2 </label>
                <div class="row g-3 align-center">
                    <div class="col-lg-6">
                        <input type="text" name="adult_name_2" value="" size="40" placeholder="Name" />
                    </div>
                    <div class="col-lg-6">
                        <input type="number" name="adult_age_2" value="" size="40" placeholder="Age" />
                    </div>
                </div>
              </div>
              <div class="form-item large">
                <label class="form-label">Special Request </label>
                <textarea name="special_request" placeholder="Special Request">{{ old('special_request') }}</textarea>
              </div>
            </div>

             <!-- <div class="sp-plan-info card-inner pt-0"> -->
            <!-- </div> -->

            <div class="form-item-box">
              <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-4 md:gap-y-2 gap-2">
                <div class="form-item large">
                  <div class="time_select">
                    <label class="form-label">Check In Date <span class="required" title="required">*</span></label>
                    <span class="wpcf7-form-control-wrap" data-name="menu-998">
                        <select name="check_in_date" required>
                          <option value="06-01-2023">06 Jan 2023</option>
                          <option value="07-01-2023">07 Jan 2023</option>
                          <option value="08-01-2023">08 Jan 2023</option>
                          <option value="09-01-2023">09 Jan 2023</option>
                          <option value="10-01-2023">10 Jan 2023</option>
                          <option value="11-01-2023">11 Jan 2023</option>
                        </select>
                    </span>
                  </div>
                </div>
                <div class="form-item large">
                  <div class="time_select">
                    <label class="form-label">Check Out Date <span class="required" title="required">*</span></label>
                    <span class="wpcf7-form-control-wrap" data-name="menu-573">
                        <select name="check_out_date" required>
                          <option value="06-01-2023">06 Jan 2023</option>
                          <option value="07-01-2023">07 Jan 2023</option>
                          <option value="08-01-2023">08 Jan 2023</option>
                          <option value="09-01-2023">09 Jan 2023</option>
                          <option value="10-01-2023">10 Jan 2023</option>
                          <option value="11-01-2023">11 Jan 2023</option>
                        </select>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-item large">
              {!! app('captcha')->display() !!}
            </div>

            <div class="form-button">	
              <button type="submit" class="primary-button md submitBtn" name="mahakal_lok_darshan_form" id="mahakal_lok_darshan_form" value="Submit">Submit</button>
            </div>
          </form>
        </div>
        @endif
      </div>
    </div>
  </section>
@endsection
@push('footerScripts')
<script type="text/javascript">
  $(document).ready(function(){
    var checkValid = function(){
      $('.submitBtn').attr("disabled", "disabled");
    }
    $.listen('parsley:form:success', checkValid)
  });
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
