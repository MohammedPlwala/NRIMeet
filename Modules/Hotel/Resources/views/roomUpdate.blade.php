@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em class="icon ni ni-chevron-left back-icon"></em> </a> @if (isset($room)) Edit @else Add @endif Room</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" action="{{ url('admin/hotel/rooms/add') }}" enctype="multipart/form-data"  >
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
                                            <option 
                                            @if (isset($room) && $room->hotel_id == $hotel->id) selected  @endif
                                            value="{{ $hotel->id }}">{{ ucfirst($hotel->name) }}</option>
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
                                            <option 
                                            @if (isset($room) && $room->type_id == $roomType->id) selected  @endif
                                            value="{{ $roomType->id }}">{{ ucfirst($roomType->name) }}</option>
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
                                    @php
                                        $value = "";
                                        if(isset($room)){
                                            $value = $room->name;
                                        }
                                    @endphp
                                    <x-inputs.text for="room_name" icon="umbrela" required="true" class="" placeholder="Enter Room Name" name="room_name" 
                                    value="{{ $value }}"
                                    />
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
                                    @php
                                        $value = "";
                                        if(isset($room)){
                                            $value = $room->rate;
                                        }
                                    @endphp
                                    <x-inputs.number 
                                    value="{{ $value }}" for="rate" icon="sign-inr" required="true" class="" placeholder="Enter Rate" name="rate" />
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
                                        <option 
                                        @if (isset($room) && $room->extra_bed_available == 0) selected  @endif
                                        value="0">No</option>
                                        <option 
                                        @if (isset($room) && $room->extra_bed_available == 1) selected  @endif
                                        value="1">Yes</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Extra Bed Rate" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    @php
                                        $value = "";
                                        if(isset($room)){
                                            $value = $room->extra_bed_rate;
                                        }
                                    @endphp
                                    <x-inputs.number value="{{ $value }}" for="extra_bed_rate" icon="sign-inr" required="true" class="" placeholder="Email" name="extra_bed_rate" />
                                    @if ($errors->has('extra_bed_rate'))
                                        <span class="text-danger custom-error-text">{{ $errors->first('extra_bed_rate') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Allocated Rooms" for="email" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    @php
                                        $value = "";
                                        if(isset($room)){
                                            $value = $room->allocated_rooms;
                                        }
                                    @endphp
                                    <x-inputs.number for="allocated_rooms" icon="home-alt" required="true" class="" placeholder="0" name="allocated_rooms" value="{{ $value }}"/>
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
                                    @php
                                        $value = "";
                                        if(isset($room)){
                                            $value = $room->mpt_reserve;
                                        }
                                    @endphp
                                    <x-inputs.number value="{{ $value }}" for="mpt_reserve" icon="umbrela" required="true" class="" placeholder="Email" name="mpt_reserve" />
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
                                   @php
                                        $value = 0;
                                        if(isset($room)){
                                            $value = $room->count;
                                        }
                                    @endphp
                                    {{ $value }}
                                </div>
                            </div>

                            @if (isset($room)) 
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            @endif

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="" suggestion="" required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="status" icon="mail" required="true" class="" placeholder="Select Hotel Type" name="status" >
                                        <option 
                                        @if (isset($room) && $room->status == 'active') selected  @endif
                                        value="active">Active</option>
                                        <option 
                                        @if (isset($room) && $room->status == 'inactive') selected  @endif
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
@endsection
