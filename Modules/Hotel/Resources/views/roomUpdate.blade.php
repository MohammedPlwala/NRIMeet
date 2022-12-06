@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($room)) Edit @else Add @endif Room</h3>
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
                                <h5 class="o-5">Room <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="hotel" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="hotel" icon="mail" required="true" class="" placeholder="Select Hotel" name="hotel" >
                                        <option>Select Hotel</option>
                                        @forelse($hotels as $key => $hotel)
                                            <option value="{{ $hotel->id }}">{{ ucfirst($hotel->name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Room Type" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="room_type" icon="mail" required="true" class="" placeholder="Select Hotel Type" name="room_type" >
                                        <option>Select Room Type</option>
                                        @forelse($roomTypes as $key => $roomType)
                                            <option value="{{ $roomType->id }}">{{ ucfirst($roomType->name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Room Name" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="room_name" icon="umbrela" required="true" class="" placeholder="Email" name="room_name" />
                                    @if ($errors->has('room_name'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('room_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Rate" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="" for="rate" icon="sign-inr" required="true" class="" placeholder="Email" name="rate" />
                                    @if ($errors->has('rate'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('rate') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Extra Bed Available" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="extra_bed_available" icon="mail" required="true" class="" placeholder="Select Hotel Type" name="extra_bed_available" >
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Extra Bed Rate" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="" for="extra_bed_available" icon="sign-inr" required="true" class="" placeholder="Email" name="extra_bed_available" />
                                    @if ($errors->has('extra_bed_available'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('extra_bed_available') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Allocated Rooms" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number for="allocated_rooms" icon="home-alt" required="true" class="" placeholder="0" name="allocated_rooms" />
                                    @if ($errors->has('allocated_rooms'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('allocated_rooms') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="MPT Reserve" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="" for="mpt_reserve" icon="umbrela" required="true" class="" placeholder="Email" name="mpt_reserve" />
                                    @if ($errors->has('mpt_reserve'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('mpt_reserve') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Available Rooms" for="email" suggestion="." required="true" />
                                </div>
                                <div class="col-lg-7">
                                   35
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="status" icon="mail" required="true" class="" placeholder="Select Hotel Type" name="status" >
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </x-inputs.select>
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
