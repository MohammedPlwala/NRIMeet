@extends('admin.layouts.app')
@php
$userPermission = \Session::get('userPermission');
$organization_type = \Session::get('organization_type');
@endphp
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($user)) Edit @else Add @endif Guest</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" action="{{ url('admin/user/add') }}" enctype="multipart/form-data"  >
        @csrf
        <input type="hidden" name="role_id" value="{{$roleId->id}}">
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Guest Personal <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Full Name" for="FullName" suggestion="Specify the full name of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text  value="{{ isset($user) ? $user->full_name : old('fullname') }}" for="FullName" icon="user" placeholder="First name" name="fullname" required="true" />
                                    @if ($errors->has('fullname'))
                                        <span class="text-danger">{{ $errors->first('fullname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Email" for="email" suggestion="Specify the email of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.email value="{{ isset($user) ? $user->email : old('email') }}" for="email" icon="mail" required="true" class="" placeholder="Email" name="email" />
                                    @if ($errors->has('email'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Mobile Number" for="mobile" suggestion="Specify the mobile number of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->mobile : old('mobile') }}" for="mobile" class="" icon="call" required="true" placeholder="Mobile Number" name="mobile"
                                    />
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>
                            </div>

                            

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Date of birth" for="date_of_birth" suggestion="Specify the date of birth." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->date_of_birth : old('date_of_birth') }}" for="date_of_birth" class="date-picker" icon="calender-date-fill" required="true" placeholder="Date of birth" name="date_of_birth" 
                                    />
                                    @if ($errors->has('date_of_birth'))
                                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
        <div class="nk-block buyer-section">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Guest <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Country" for="country" suggestion="Specify the country name." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->country : old('country') }}" for="country" class="" icon="globe" required="true" placeholder="Country" name="country" 
                                    />
                                    @if ($errors->has('country'))
                                        <span class="text-danger">{{ $errors->first('country') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-item">
                                <label class="form-label">Country / Region <span class="required"
                                        title="required">*</span></label>
                                <select name="billing_country" id="billing_country"
                                    class="country_to_state country_select select2-hidden-accessible" autocomplete="country"
                                    data-placeholder="Select a country / region…" data-label="Country / Region"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select a country / region…</option>
                                </select>
                            </div>
                            <div class="form-item" id="state_wrapper">
                                <label class="form-label"><span id="billing_state_label">State</span> <span class="required"
                                        title="required">*</span></label>
                                <div id="field_billing_state">

                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Nationality" for="nationality" suggestion="Specify the nationality." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->nationality : old('nationality') }}" for="nationality" class="" icon="globe" required="true" placeholder="Nationality" name="nationality" 
                                    />
                                    @if ($errors->has('nationality'))
                                        <span class="text-danger">{{ $errors->first('nationality') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Address" for="address" suggestion="Specify the address." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="{{ isset($user) ? $user->address : old('address') }}" for="address" class="" icon="map-pin-fill" required="true" placeholder="Address" name="address" 
                                    />
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="ZIP" for="zip" suggestion="Specify the zip code." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="{{ isset($user) ? $user->zip : old('zip') }}" for="zip" class="" icon="location" required="true" placeholder="ZIP" name="zip" 
                                    />
                                    @if ($errors->has('zip'))
                                        <span class="text-danger">{{ $errors->first('zip') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Identity Type" for="identity_type" suggestion="Specify the identity type." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->identity_type : old('identity_type') }}" for="identity_type" class="" icon="user-fill-c" required="true" placeholder="Identity Type" name="identity_type" 
                                    />
                                    @if ($errors->has('identity_type'))
                                        <span class="text-danger">{{ $errors->first('identity_type') }}</span>
                                    @endif
                                </div>
                            </div>

                             <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Identity Number" for="identity_number" suggestion="Specify the identity number." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($user) ? $user->identity_number : old('identity_number') }}" for="identity_number" class="" icon="user-fill-c" required="true" placeholder="Identity Number" name="identity_number" 
                                    />
                                    @if ($errors->has('identity_number'))
                                        <span class="text-danger">{{ $errors->first('identity_number') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
       
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-thumbs-up fs-36px o-5"></em>
                                <h5 class="o-5">Approval</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="approved" suggestion="Specify the status of the user." />
                                </div>
                                <div class="col-lg-7">

                                    @php
                                        if(isset($user) && $user->status=='active'){
                                            $checked = 'checked';
                                        }else{
                                            $checked = '';
                                        }
                                    @endphp
                                    <x-inputs.switch for="status" size="md" name="status" checked={{$checked}}/>
                                    @if ($errors->has('approved'))
                                        <span class="text-danger">{{ $errors->first('approved') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->        
        <div class="nk-block">
            @isset($user)
                <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
            @endisset
            <div class="row">
                <div class="col-md-12">
                    <div class="sp-plan-info pt-0 pb-0 card-inner">  
                            <div class="row">
                                <div class="col-lg-7 text-right offset-lg-5">
                                    <div class="form-group">
                                        <a href="javascript:history.back()" class="btn btn-outline-light">Cancel</a>
                                        <x-button type="submit" class="btn btn-primary">Submit</x-button>
                                    </div>
                                </div>
                            </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
        <input type="hidden" name="userFound" id="userFound" value="0">
    </form>

    <input type="hidden" name="role_type" id="role_type" value="{{\Config::get('constants.ROLES.BUYER')}}">
    <input type="hidden" name="old_district" id="old_district" value="{{old('district')}}">
    <input type="hidden" name="old_city" id="old_city" value="{{old('city')}}">

    <script type="text/javascript">

        $(document).ready(function(){

            $('.checkUser').blur(function(){

                var userFound = $('#userFound').val();

                if(userFound == 0){
                    var root_url = "<?php echo Request::root(); ?>";
                    $.ajax({
                        url: root_url + '/user/check-user',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "searchKey": $(this).val(),
                            "role": $('#role').val()
                        },
                        //dataType: "html",
                        method: "POST",
                        cache: false,
                        success: function (response) {
                            if(response.user){
                                var user = response.user;
                                if(confirm("A user already exists with the same information. do you want to populate the same data ?")){
                                    $('#FullName').val(user.name).prop('readonly',true);
                                    $('#lastName').val(user.last_name).prop('readonly',true);
                                    $('#email').val(user.email).prop('readonly',true);
                                    $('#mobile').val(user.phone_number).prop('readonly',true);
                                    $('#shopName').val(user.shop_name).prop('readonly',true);
                                    $('#gst').val(user.gst).prop('readonly',true);
                                    $('#address1').val(user.address1).prop('readonly',true);
                                    $('#address2').val(user.address2).prop('readonly',true);
                                    $('#pincode').val(user.pincode).prop('readonly',true);
                                    $('#state').val(user.stateId).trigger('change');
                                    $('#userFound').val(user.id);
                                    
                                    changeDistrict(user.districtId);
                                    changeCity(user.districtId,user.cityId);

                                    $('#district').prop('readonly',true);
                                    $('#city').prop('readonly',true);
                                    $('#state').prop('readonly',true);
                                    $('#country').prop('readonly',true);

                                    $('.userFoundBox').hide();
                                    $('.userFoundInput').prop( "disabled", true );
                                    $('.userFoundInput').prop( "required", false );
                                }
                            }else{
                                $('#FullName').prop('readonly',false);
                                $('#lastName').prop('readonly',false);
                                $('#email').prop('readonly',false);
                                $('#mobile').prop('readonly',false);
                                $('#shopName').prop('readonly',false);
                                $('#gst').prop('readonly',false);
                                $('#address1').prop('readonly',false);
                                $('#address2').prop('readonly',false);
                                $('#pincode').prop('readonly',false);
                                $('#userFound').val(0)

                                $('.userFoundBox').show();
                                $('.userFoundInput').prop( "disabled", false );
                                $('.userFoundInput').prop( "required", true );
                            }
                        }
                    });

                }

            });

            $('.removeMedia').click(function(){
                if(confirm("Are you sure you want to delete this?")){
                    var id = $(this).attr('data-id');
                    var root_url = "<?php echo Request::root(); ?>";
                    $.ajax({
                        url: root_url + '/user/remove-image/'+id,
                        data: {
                        },
                        //dataType: "html",
                        method: "GET",
                        cache: false,
                        success: function (response) {
                            if(response.success){
                                $('.media_box').remove();
                            }
                        }
                    });
                }
                else{
                    return false;
                }
            });

            var distributorRole = "{{\Config::get('constants.ROLES.SELLER')}}";
            var retailerRole = "{{\Config::get('constants.ROLES.BUYER')}}";
            var dspRole = "{{\Config::get('constants.ROLES.SP')}}";

            var role_type = $('#role_type').val();

            if(role_type == "" || role_type != retailerRole){
                // $('.buyer-section').hide();
                $( ".buyerFileds" ).prop( "disabled", true );
                $( ".buyerFileds" ).prop( "required", false );
            }


            $("#role").on("change", function () {
                var role = $( "#role option:selected" ).text().toLowerCase();
                var role = role.split(' ').join('_');
                if(role != retailerRole){
                    $('.buyer-section').hide();
                    $( ".buyerFileds" ).prop( "disabled", true );
                    $( ".buyerFileds" ).prop( "required", false );
                }else{
                    $('.buyer-section').show();
                    $( ".buyerFileds" ).prop( "disabled", false );
                    $( ".buyerFileds" ).prop( "required", false );
                }

            });

            var old_district = $('#old_district').val();
            if(old_district != ""){
                changeDistrict();
            }

            var old_city = $('#old_city').val();
            if(old_city != ""){
                var old_district = $('#old_district').val();
                changeCity(old_district);
            }

            $("#state").on("change", function () {
                changeDistrict();
            });

            function changeDistrict(userDistrict = 0){
                var state = $('#state').val();
                var root_url = "<?php echo Request::root(); ?>";
                $.ajax({
                    url: root_url + '/user/districts/'+state,
                    data: {
                    },
                    //dataType: "html",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        $("#district").html('');
                        $("#district").append($('<option></option>').val('').html('Select district'));
                        $.each(response.districts, function (key, value) {
                            if(value.id != 0) {
                                if(value.id == old_district || value.id == userDistrict) {
                                    $("#district").append($('<option></option>').val(value.id).html(value.name).prop('selected', 'selected'));    
                                } else {
                                    $("#district").append($('<option></option>').val(value.id).html(value.name));
                                }
                            }
                        });
                    }
                });
            }

            $("#district").on("change", function () {
                var district = $('#district').val();
                changeCity(district);
            });

            function changeCity(district,userCity = 0){
                var root_url = "<?php echo Request::root(); ?>";
                
                $.ajax({
                    url: root_url + '/user/cities/'+district,
                    data: {
                    },
                    //dataType: "html",
                    method: "GET",
                    cache: false,
                    success: function (response) {
                        $("#city").html('');
                        $("#city").append($('<option></option>').val('').html('Select city'));
                        $.each(response.cities, function (key, value) {
                            if(value.id != 0) {
                                if(value.id == old_city || value.id == userCity) {
                                    $("#city").append($('<option></option>').val(value.id).html(value.name).prop('selected', 'selected'));    
                                } else {
                                    $("#city").append($('<option></option>').val(value.id).html(value.name));
                                }
                            }
                        });
                    }
                });
            }

        });
    </script>
@endsection
@push('footerScripts')
<script src="{{url('js/address.js')}}"></script>
@endpush