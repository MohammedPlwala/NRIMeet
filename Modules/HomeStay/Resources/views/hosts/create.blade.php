@extends('admin.layouts.app')
@php
$userPermission = \Session::get('userPermission');
$organization_type = \Session::get('organization_type');
@endphp
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($host)) Edit @else Add @endif Host</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/homestay/hosts/add') }}" >
        @csrf
     
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Host<br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Host Name" for="hostName" suggestion="Specify the host name." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($host) ? $host->name : '' }}" for="hostName" class="" icon="building-fill" required="true" placeholder="Host Name" name="hostName" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Email" for="email" suggestion="Specify the host email." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($host) ? $host->email : '' }}" for="email" class="" icon="building-fill" required="true" placeholder="email" name="email" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Mobile" for="mobile" suggestion="Specify the host Mobile." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="{{ isset($host) ? $host->mobile : '' }}" for="mobile" class="" icon="building-fill" required="true" placeholder="mobile" name="mobile" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Address" for="address" suggestion="Specify the host address." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="{{ isset($host) ? $host->address : '' }}" for="address" class="" icon="notes-alt" required="true" placeholder="Address" name="address" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="City" for="" suggestion="Specify the host city." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="city" icon="map-pin-fill" required="true" class="" placeholder="Select City" name="city" >
                                        <option value="Indore">Indore</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Food Habit" for="" suggestion="Specify the host food habit." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="food_habit" icon="" required="true" class="" placeholder="Select food habit" name="food_habit" >

                                        <option 
                                        @if (isset($host) && $host->food_habit == 'Pure Veg') selected  @endif
                                        value="Pure Veg">Pure Veg</option>

                                        <option 
                                        @if (isset($host) && $host->food_habit == 'Veg + Non Veg') selected  @endif
                                        value="Veg + Non Veg">Veg + Non Veg</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Vehicle" for="vehicle" suggestion="Specify the host vehicle." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($host) ? $host->vehicle : '' }}" for="vehicle" class="" icon="map-pin-fill" required="true" placeholder="vehicle" name="vehicle" />
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Vehicle number" for="vehicle_number" suggestion="Specify the host vehicle number." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($host) ? $host->vehicle_number : '' }}" for="vehicle_number" class="" icon="map-pin-fill" required="true" placeholder="vehicle number" name="vehicle_number" />
                                </div>
                            </div>
                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Location" for="map_link" suggestion="Specify the host location."  />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="{{ isset($host) ? $host->map_link : '' }}" for="map_link" class="" icon="map-pin-fill"  placeholder="Location" name="map_link" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Airport Distance" for="airport_distance" suggestion="Specify the host airport distance." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="{{ isset($host) ? $host->airport_distance : '' }}" for="airport_distance" class="" icon="map-pin-fill" required="true" placeholder="Airport Distance" name="airport_distance" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Venue Distance" for="venue_distance" suggestion="Specify the host venue distance." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.number value="{{ isset($host) ? $host->venue_distance : '' }}" for="venue_distance" class="" icon="map-pin-fill" required="true" placeholder="Venue Distance" name="venue_distance" />
                                </div>
                            </div>
                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Image" for="image_one" suggestion="Specify the host image." />
                                </div>
                                <div class="col-lg-7">
                                    <input value="" type="file" id="image_one" class="" icon="img-fill"   placeholder="Image" name="image_one" />
                                    @if(isset($host))
                                        @if(file_exists(url('uploads/hosts/'.$host->image_one)))
                                        <img height="150" width="150" src="{{ url('uploads/hosts/'.$host->image_one) }}">
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Image Two" for="image_two" suggestion="Specify the host image." />
                                </div>
                                <div class="col-lg-7">
                                    <input value="" type="file" id="image_two" class="" icon="img-fill"   placeholder="Image" name="image_two" />
                                    @if(isset($host))
                                        @if(file_exists(url('uploads/hosts/'.$host->image_two)))
                                        <img height="150" width="150" src="{{ url('uploads/hosts/'.$host->image_two) }}">
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Image Three" for="image_three" suggestion="Specify the host image."/>
                                </div>
                                <div class="col-lg-7">
                                    <input value="" type="file" id="image_three" class="" icon="img-fill" placeholder="Image" name="image_three" />
                                    @if(isset($host))
                                        @if(file_exists(url('uploads/hosts/'.$host->image_three)))
                                        <img height="150" width="150" src="{{ url('uploads/hosts/'.$host->image_three) }}">
                                        @endif
                                    @endif
                                </div>
                            </div>


                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="status" icon="mail" required="true" class="" placeholder="Select Host Type" name="status" >
                                        <option 
                                        @if (isset($host) && $host->status == 'active') selected  @endif
                                        value="active">Active</option>
                                        <option 
                                        @if (isset($host) && $host->status == 'inactive') selected  @endif
                                        value="inactive">Inactive</option>
                                        <option 
                                        @if (isset($host) && $host->status == 'draft') selected  @endif
                                        value="draft">Draft</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->
       
      
         
        <div class="nk-block">
            @isset($host)
                <input type="hidden" name="host_id" id="host_id" value="{{ $host->id }}">
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

    
@endsection
