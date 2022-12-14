@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a>@if (isset($bulkBooking)) Edit @else Add @endif Bulk Booking</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" action="{{ url('admin/bulk-bookings/store') }}">
        @csrf
        
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Room <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="sp-plan-info card-inner">

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Name" for="name" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text for="name" icon="user" required="true" class="readonlyinput"
                                        placeholder="Enter Name" name="name"
                                        value="{{ isset($bulkBooking) ? $bulkBooking->name : old('name') }}" />

                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Hotel" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="hotel" icon="mail" required="true" class="readonlyinput"
                                        placeholder="Select" name="hotel" id="hotel">
                                        <option value="">Select</option>
                                        @foreach ($hotels as $hotel)
                                            <option
                                                @if (isset($bulkBooking) && $bulkBooking->hotel_id == $hotel->id) selected
                                        @elseif(old('hotel') == $hotel->id) 
                                        selected @endif
                                                value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Room Type" for="roomType" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="roomType" icon="mail" required="true"
                                        class="roomType readonlyinput" placeholder="Select" name="roomType">
                                        <option value="">Select</option>
                                        @if (isset($bulkBooking))
                                            @foreach ($roomTypes as $rooms)
                                                <option
                                                    @if (isset($bulkBooking) && $bulkBooking->room_type_id == $rooms->id) selected
                                        @elseif(old('roomType') == $rooms->id) 
                                        selected @endif
                                                    value="{{ $rooms->id }}">{{ $rooms->room_type_name }}</option>
                                            @endforeach
                                        @endif
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Booking From" for="bookingFrom" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="bookingFrom" icon="mail" required="true" class="readonlyinput"
                                        placeholder="Select Guest" name="bookingFrom">
                                        <option value="">Select</option>
                                        <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'MP Tourism') selected
                                        @elseif(old('bookingFrom') == 'MP Tourism') 
                                        selected @endif>
                                            MP Tourism</option>
                                        <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'MP GOVT') selected
                                        @elseif(old('bookingFrom') == 'MP GOVT') 
                                        selected @endif>
                                            MP GOVT</option>
                                        <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'YPBD') selected
                                        @elseif(old('bookingFrom') == 'YPBD') 
                                        selected @endif>
                                            YPBD</option>
                                            <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'MEA') selected
                                        @elseif(old('bookingFrom') == 'MEA') 
                                        selected @endif>
                                            MEA</option>

                                        <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'AGI') selected
                                        @elseif(old('bookingFrom') == 'AGI') 
                                        selected @endif>
                                            AGI</option>

                                            <option
                                            @if (isset($bulkBooking) && $bulkBooking->booking_person == 'Guest') selected
                                        @elseif(old('bookingFrom') == 'Guest') 
                                        selected @endif>
                                            Guest</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Select check IN and Check out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="input-daterange date-picker-range input-group">
                                                <x-inputs.text value="" for="checkin_date"
                                                    class="checkDate readonlyinput" icon="calender-date-fill"
                                                    required="true" placeholder="Check In Date" name="checkin_date"
                                                    value="{{ isset($bulkBooking) ? $bulkBooking->checkin_date : old('checkin_date') }}" />
                                                <div class="input-group-addon">TO</div>
                                                <x-inputs.text value="" for="checkout_date"
                                                    class="checkDate readonlyinput" icon="calender-date-fill"
                                                    required="true" placeholder="Check In Out" name="checkout_date"
                                                    value="{{ isset($bulkBooking) ? $bulkBooking->checkout_date : old('checkout_date') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="#Rooms" for="rooms" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.number for="rooms" icon="building" required="true"
                                        class="rooms readonlyinput" placeholder="Enter Rooms Number" name="rooms"
                                        value="{{ isset($bulkBooking) ? $bulkBooking->room_count : old('rooms') }}"
                                        max="{{ isset($availableRooms) ? $availableRooms->count : isset($bulkBooking) ? $bulkBooking->room_count : 0 }}" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->

        @isset($bulkBooking)
            <input type="hidden" name="bulkBookingId" id="bulkBookingId" value="{{ $bulkBooking->id }}">
            <input type="hidden" name="roomType" value="{{ $bulkBooking->room_type_id }}">
            <div class="nk-block"></div>
            <div class="nk-block">
                <div class="card card-bordered sp-plan">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <div class="sp-plan-action card-inner">
                                <div class="icon">
                                    <em class="icon ni ni-box fs-36px o-5"></em>
                                    <h5 class="o-5">Rooms <br> Booking Details</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="sp-plan-info card-inner">
                                <div class="row g-3 align-center">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-lg-10">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <x-inputs.verticalFormLabel label="Hotel Confirmation Number" for="name"  required="true"
                                                    suggestion="" />
                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.verticalFormLabel label="Adult Count" for="name" required="true"
                                                    suggestion="" />

                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.verticalFormLabel label="Child Count" for="name"
                                                    suggestion="" />

                                            </div>
                                            <div class="col-md-3">
                                                <x-inputs.verticalFormLabel label="Guest Name" for="name" 
                                                    suggestion="" />

                                            </div>
                                            <div class="col-md-2">
                                                <x-inputs.verticalFormLabel label="Guest Designation" for="name"
                                                    suggestion="" />

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @for ($i = 0; $i < $bulkBooking->room_count; $i++)
                                    <div class="row g-3 align-center">
                                        <div class="col-md-2">
                                            <x-inputs.verticalFormLabel label="Room {{ $i + 1 }}" for="name"
                                                suggestion=""  />
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <x-inputs.text for="bookingId[{{$i}}]" icon="building-fill" 
                                                        placeholder="Booking Id" name="bookingId[{{$i}}]" required="true"
                                                        value="{{ isset($bulkBookingRooms[$i]) && $bulkBookingRooms[$i]['booking_id'] ? $bulkBookingRooms[$i]['booking_id'] : '' }}" />
                                                </div>
                                                <div class="col-md-2">
                                                    <x-inputs.number for="adultCount[{{$i}}]" icon="users-fill" 
                                                        placeholder="Adult count" name="adultCount[{{$i}}]" required="true"
                                                        value="{{ isset($bulkBookingRooms[$i]) && $bulkBookingRooms[$i]['adult_count'] ? $bulkBookingRooms[$i]['adult_count'] : '' }}" />
                                                </div>
                                                <div class="col-md-2">
                                                    <x-inputs.number for="childCount[{{$i}}]" icon="users-fill" 
                                                        placeholder="Child count" name="childCount[{{$i}}]"
                                                        value="{{ isset($bulkBookingRooms[$i]) && $bulkBookingRooms[$i]['child_count'] ? $bulkBookingRooms[$i]['child_count'] : '0' }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <x-inputs.text for="guest_name[{{$i}}]" icon="users-fill" 
                                                        placeholder="Guest Name" name="guest_name[{{$i}}]"
                                                        value="{{ isset($bulkBookingRooms[$i]) && $bulkBookingRooms[$i]['guest_name'] ? $bulkBookingRooms[$i]['guest_name'] : 'NA' }}" />
                                                </div>
                                                <div class="col-md-2">
                                                    <x-inputs.text for="guest_designation[{{$i}}]" icon="users-fill" 
                                                        placeholder="Guest Designation" name="guest_designation[{{$i}}]"
                                                        value="{{ isset($bulkBookingRooms[$i]) && $bulkBookingRooms[$i]['guest_designation']  ? $bulkBookingRooms[$i]['guest_designation'] : 'NA' }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .nk-block -->
        @endisset
        <div class="nk-block">
            <div class="row">
                <div class="col-md-12">
                    <div class="sp-plan-info pt-0 pb-0 card-inner">
                        <div class="row">
                            <div class="col-lg-7 text-right offset-lg-5">
                                <div class="form-group">
                                    <a href="javascript:history.back()" class="btn btn-outline-light">Cancel</a>
                                    <x-button type="submit" class="btn btn-primary submitBtnx">Submit</x-button>
                                </div>
                            </div>
                        </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    </form>


    <script type="text/javascript">
        $(document).ready(function() {
            var checkValid = function(){
                    $('.submitBtnx').attr("disabled", "disabled");
                }
                $.listen('parsley:form:success', checkValid)
            @if (isset($bulkBooking))
                $('.readonlyinput').attr("disabled", true);
            @endif

            $('#hotel').change(function() {
                var root_url = "<?php echo Request::root(); ?>";
                $.ajax({
                    url: root_url + '/admin/hotel/hotel-rooms/' + $(this).val(),
                    data: {

                    },
                    //dataType: "html",
                    method: "GET",
                    cache: false,
                    success: function(response) {
                        if (response.success) {


                            $('.roomType')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Select Room</option>');

                            $.each(response.hotelRooms, function(key, room) {
                                $('.roomType')
                                    .append($("<option></option>")
                                        .attr("value", room.id)
                                        .attr("data-roomData", JSON.stringify(room))
                                        .text(room.room_type_name));
                            });

                        }
                    }
                });
            });

            $('.roomType').change(function() {
                var root_url = "<?php echo Request::root(); ?>";
                $.ajax({
                    url: root_url + '/admin/bulk-bookings/hotel-rooms/' + $(this).val(),
                    data: {

                    },
                    method: "GET",
                    cache: false,
                    success: function(response) {
                        console.log(response.hotelRooms.count);
                        if (response.success) {
                            $('.rooms').attr('max', response.hotelRooms.count);
                        }
                    }
                });
            });

        });
    </script>
@endsection
