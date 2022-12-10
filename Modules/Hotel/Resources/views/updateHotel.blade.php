@extends('admin.layouts.app')
@php
$userPermission = \Session::get('userPermission');
$organization_type = \Session::get('organization_type');
@endphp
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($hotel)) Edit @else Add @endif Hotel</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/hotel/add') }}" >
        @csrf
     
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Hotel<br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="hotelName" suggestion="Specify the hotel name." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->name : '' }}" for="hotelName" class="" icon="building-fill" required="true" placeholder="Hotel Name" name="hotelName" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Classification" for="classification" suggestion="Specify the hotel classification." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->classification : '' }}" for="classification" class="" icon="building-fill" required="true" placeholder="Classification Name" name="classification" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Location" for="location" suggestion="Specify the hotel location." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->location : '' }}" for="location" class="" icon="map-pin-fill" required="true" placeholder="Location" name="location" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Airport Distance" for="airport_distance" suggestion="Specify the hotel airport distance." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->airport_distance : '' }}" for="airport_distance" class="" icon="map-pin-fill" required="true" placeholder="Airport Distance" name="airport_distance" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Website" for="website" suggestion="Specify the hotel website." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->website : '' }}" for="website" class="" icon="b-edge" required="true" placeholder="Website Name" name="website" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Venue Distance" for="venue_distance" suggestion="Specify the hotel venue distance." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->venue_distance : '' }}" for="venue_distance" class="" icon="map-pin-fill" required="true" placeholder="Venue Distance" name="venue_distance" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Hotel Email" for="email" suggestion="Specify the hotel email." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->email : '' }}" for="email" class="" icon="user-fill" placeholder="Hotel Email" name="email" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Contact Person" for="contact_person" suggestion="Specify the venue distance." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->contact_person : '' }}" for="contact_person" class="" icon="user-fill" placeholder="Contact Person Name" name="contact_person" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Contact Number" for="contact_number" suggestion="Specify the contact number." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($hotel) ? $hotel->contact_number : '' }}" for="contact_number" class="" icon="contact-fill" placeholder="Contact Number" name="contact_number" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Image" for="image" suggestion="Specify the hotel image." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <input value="" type="file" for="image" class="" icon="img-fill" @if(isset($hotel))  @else required="true" @endif  placeholder="Image" name="image" />
                                    @if(isset($hotel))
                                        <img height="150" width="150" src="{{ url('uploads/hotels/'.$hotel->image) }}">
                                    @endif
                                </div>


                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Description" for="description" suggestion="Specify the hotel description." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="{{ isset($hotel) ? $hotel->description : '' }}" for="description" class="" icon="notes-alt" required="true" placeholder="Description" name="description" />
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Address" for="address" suggestion="Specify the hotel address." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="{{ isset($hotel) ? $hotel->address : '' }}" for="address" class="" icon="notes-alt" required="true" placeholder="Address" name="address" />
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="status" icon="mail" required="true" class="" placeholder="Select Hotel Type" name="status" >
                                        <option 
                                        @if (isset($hotel) && $hotel->status == 'active') selected  @endif
                                        value="active">Active</option>
                                        <option 
                                        @if (isset($hotel) && $hotel->status == 'inactive') selected  @endif
                                        value="inactive">Inactive</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
       
      
         
        <div class="nk-block">
            @isset($hotel)
                <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}">
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
