@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
    <h1>Home Stay</h1>
  </div>
  <section class="mahakal-lok-darshan-wrap">
    <div class="container">
      <div class="u_heading">
        <h4>Immerse yourself in the spirituality of</h4>
        <h2>Mahakal Lok</h2>
        <h6>Visit the mesmerising 900 meter long corridor comprising of<br>
        192 statues, 53 murals, and 108 pillars of Lord Shiva.</h6>
      </div>
      
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
                <label class="form-label">Country of Residence <span class="required" title="required">*</span></label>
                <input type="text" name="country" value="" size="40" placeholder="Country of Residence" required />
              </div>
              <div class="form-item large">
                <label class="form-label">Total number of members <span class="required" title="required">*</span></label>
                <input type="tel" name="members" value="" size="40" placeholder="Total number of members" required />
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
