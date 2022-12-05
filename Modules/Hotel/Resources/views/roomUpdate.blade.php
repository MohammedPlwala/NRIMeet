@extends('admin.layouts.app')
@php
$userPermission = \Session::get('userPermission');
$organization_type = \Session::get('organization_type');
@endphp
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($user)) Edit @else Update @endif Room</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" enctype="multipart/form-data"  >
        @csrf
     
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Hotel <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="firstName" suggestion="Specify the first name of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="{{ isset($user) ? $user->email : old('email') }}" for="email" icon="mail" required="true" class="" placeholder="Email" name="email" >
                                        <option>
                                            Hotel
                                        </option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Room Type" for="Hotal Address" suggestion="Specify the last name of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="{{ isset($user) ? $user->email : old('email') }}" for="email" icon="mail" required="true" class="" placeholder="Email" name="email" >
                                        <option>
                                            Type
                                        </option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Allocated " for="email" suggestion="Specify the email of the user." required="true" />
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
                                    <x-inputs.verticalFormLabel label="Mobile Number" for="mobileNumber" suggestion="Specify the mobile number of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="{{ isset($user) ? $user->phone_number : old('mobileNumber') }}" for="mobileNumber" class="" icon="call" required="true" placeholder="Mobile Number" name="mobileNumber" 
                                    data-parsley-pattern="{{ \Config::get('constants.REGEX.VALIDATE_MOBILE_NUMBER_LENGTH') }}"
                                    />
                                    @if ($errors->has('mobileNumber'))
                                        <span class="text-danger">{{ $errors->first('mobileNumber') }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Approved" for="approved" suggestion="Specify the approval of the user." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.switch for="approved" size="md" name="approved"/>
                                </div>
                            </div> -->
                            
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
                                <em class="icon ni ni-map-pin fs-36px o-5"></em>
                                <h5 class="o-5">Rooms</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Suit" for="Suit" suggestion="Specify the room rate | inventory." />
                                </div>
                                <div class="col-lg-7">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <x-inputs.text value="0" for="rate" icon="sign-inr-alt" required="true" placeholder="Rate" name="rate"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <x-inputs.text value="0" for="Inventory" icon="db-fill" required="true" placeholder="Inventory" name="inventory"/>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Premium" for="Premium" suggestion="Specify the room rate | inventory." />
                                </div>
                                <div class="col-lg-7">
                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <x-inputs.text value="0" for="rate" icon="sign-inr-alt" required="true" placeholder="Rate" name="rate"/>
                                        </div>
                                        <div class="col-lg-6">
                                            <x-inputs.text value="0" for="Inventory" icon="db-fill" required="true" placeholder="Inventory" name="inventory"/>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
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
          
            var distributorRole = "{{\Config::get('constants.ROLES.SELLER')}}";
            var retailerRole = "{{\Config::get('constants.ROLES.BUYER')}}";
            var dspRole = "{{\Config::get('constants.ROLES.SP')}}";

            var role_type = $('#role_type').val();

            if(role_type == "" || role_type != retailerRole){
                // $('.buyer-section').hide();
                $( ".buyerFileds" ).prop( "disabled", true );
                $( ".buyerFileds" ).prop( "required", false );
            }


          

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
