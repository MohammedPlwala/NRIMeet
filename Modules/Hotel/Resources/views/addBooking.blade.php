@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a>Add Booking</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" enctype="multipart/form-data">
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
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Guest Name" for="guest" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="guest" icon="mail" required="true" class=""
                                        placeholder="Select Guest" name="guest">
                                        <option value="">Select Guest</option>
                                        @forelse($guests as $key => $guest)
                                            <option value="{{ $guest->id }}">{{ ucfirst($guest->full_name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="hotel" icon="mail" required="true" class=""
                                        placeholder="Select Hotel" name="hotel">
                                        <option value="">Select Hotel</option>
                                        @forelse($hotels as $key => $hotel)
                                            <option value="{{ $hotel->id }}">{{ ucfirst($hotel->name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Check In and Check Out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="input-daterange date-picker-range input-group">
                                                <x-inputs.text value="" for="checkin_date" class="checkDate"
                                                    icon="calender-date-fill" required="true" placeholder="Check In Date"
                                                    name="checkin_date" />

                                                <div class="input-group-addon">TO</div>
                                                <x-inputs.text value="" for="checkout_date" class="checkDate"
                                                    icon="calender-date-fill" required="true" placeholder="Check Out Date"
                                                    name="checkout_date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Total Nights" for="hotel"
                                        suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div id="nights"></div>

                                        </div>
                                    </div>
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
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Room One <br> Guests</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderd">
                            <tr>
                                <th class="pt-3 pb-3">Room Name</th>
                                <th class="pt-3 pb-3">Adult</th>
                                <th class="pt-3 pb-3">Child</th>
                                <th class="pt-3 pb-3">Extra Bed</th>
                                <th class="pt-3 pb-3">Extra Bed Cost</th>
                                <th class="pt-3 pb-3">Per/Night</th>
                                <th class="text-right pt-3 pb-3">Price</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-control-required-wrap">
                                        <select id="room_one_type" required="true" class="form-select roomType"
                                            name="room_one_type">
                                            <option value="">Select Room</option>
                                        <select>
                                    </div>
                                </td>
                                <td>
                                    <x-inputs.select for="room_one_adult" icon="mail" required="true" class=""
                                        name="room_one_adult" id="room_one_adult">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_one_child" icon="mail" required="true" class=""
                                        name="room_one_child">

                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <select id="room_one_extraBed" icon="mail" required="true" class="form-select"
                                        name="room_one_extraBed">

                                        <option value="0">No</option>
                                        <option value="1">Yes</option>

                                    </select>
                                </td>
                                <td>
                                    ₹<span id="room_one_extraBed_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td>
                                    ₹<span id="room_one_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" id="room_one_price_input" name="room_one_price">
                                    <input type="hidden" id="room_one_data" name="room_one_data">
                                    ₹<span id="room_one_price"></span>
                                </td>
                            </tr>

                        </table>
                        <div class="sp-plan-info card-inner pt-0">
                            <div id="cont_room_one_adult"></div>
                            <div id="cont_room_one_child"></div>
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
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Room Two <br> Guests</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <table class="table table-borderd">
                            <tr>
                                <th class="pt-3 pb-3">Room Name</th>
                                <th class="pt-3 pb-3">Adult</th>
                                <th class="pt-3 pb-3">Child</th>
                                <th class="pt-3 pb-3">Extra Bed</th>
                                <th class="pt-3 pb-3">Extra Bed Cost</th>
                                <th class="pt-3 pb-3">Per/Night</th>
                                <th class="text-right pt-3 pb-3">Price</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-control-required-wrap">
                                        <select class="form-select roomType" id="room_two_type" placeholder="Select Type" name="room_two_type">
                                            <option value="">Select Room</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <x-inputs.select for="room_two_adult" icon="mail" required="true" class=""
                                        name="room_two_adult">

                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <x-inputs.select for="room_two_child" icon="mail" required="true" class=""
                                        name="room_two_child">

                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>

                                    </x-inputs.select>
                                </td>
                                <td>
                                    <select id="room_two_extraBed" icon="mail" required="true" class="form-select"
                                        name="room_two_extraBed">

                                        <option value="0">No</option>
                                        <option value="1">Yes</option>

                                    </select>
                                </td>
                                <td>
                                    ₹<span id="room_two_extraBed_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td>
                                    ₹<span id="room_two_rate"></span> / Night<br />
                                    <small>Tax Inclusive</small>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" id="room_two_price_input" name="room_two_price">
                                    <input type="hidden" id="room_two_data" name="room_two_data">
                                    ₹<span id="room_two_price"></span>
                                </td>
                            </tr>

                        </table>
                        <div class="sp-plan-info card-inner pt-0">
                            <div id="cont_room_two_adult"></div>
                            <div id="cont_room_two_child"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->

        {{-- Documents --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Documents</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Email Receipt" for="email_receipt" suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <input value="" type="file" for="email_receipt" class="" icon="img-fill" placeholder="email_receipt" name="email_receipt" accept=".jpg,.jpeg,.pdf,.xls,.xlsx" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Payment Receipt" for="payment_receipt"
                                        suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    <input value="" type="file" for="payment_receipt" class="" icon="img-fill" placeholder="payment_receipt" name="payment_receipt" accept=".jpg,.jpeg,.pdf,.xls,.xlsx" />
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
                                    <x-button type="submit" class="btn btn-primary submitBtnx">Submit</x-button>
                                </div>
                            </div>
                        </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
    </form>

    <input type="hidden" name="role_type" id="role_type" value="{{ \Config::get('constants.ROLES.BUYER') }}">
    <input type="hidden" name="old_district" id="old_district" value="{{ old('district') }}">
    <input type="hidden" name="old_city" id="old_city" value="{{ old('city') }}">
@endsection
@push('footerScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var checkValid = function(){
                    $('.submitBtnx').attr("disabled", "disabled");
                }
                $.listen('parsley:form:success', checkValid)

            $('#room_one_type').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', this).attr('data-roomdata');
                    $('#room_one_data').val(roomData);
                    roomData = JSON.parse(roomData);

                    if (roomData.extra_bed_available) {
                        $('#room_one_extraBed').prop('disabled', false);
                    } else {
                        $('#room_one_extraBed').prop('disabled', true);
                    }
                    $('#room_one_extraBed').val(0);
                    $('#room_one_extraBed').trigger('change');
                    var rate = parseFloat(roomData.rate);
                    rate = rate.toFixed(2);
                    $('#room_one_rate').text(rate);

                    var nights = getNights();
                    var price = (parseFloat(roomData.rate) * nights);
                    $('#room_one_price').text(price.toFixed(2));
                    $('#room_one_price_input').val(price.toFixed(2));
                }

            });

            $('#room_one_extraBed').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', '#room_one_type').attr('data-roomdata');
                    roomData = JSON.parse(roomData);
                    var price = 0;

                    var nights = getNights();

                    if ($(this).val() == 1) {

                        $('#room_one_extraBed_rate').text(roomData.extra_bed_rate);

                        price = ((parseFloat(roomData.rate) * nights) + (parseFloat(roomData
                            .extra_bed_rate) * nights));
                    } else {
                        price = (parseFloat(roomData.rate) * nights);
                        $('#room_one_extraBed_rate').text(0);
                    }
                    $('#room_one_price').text(price.toFixed(2));
                    $('#room_one_price_input').val(price.toFixed(2));
                }

            });

            $('#room_two_type').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', this).attr('data-roomdata');
                    $('#room_two_data').val(roomData);
                    roomData = JSON.parse(roomData);

                    if (roomData.extra_bed_available) {
                        $('#room_two_extraBed').prop('disabled', false);
                    } else {
                        $('#room_two_extraBed').prop('disabled', true);
                    }
                    $('#room_two_extraBed').val(0).trigger('change');
                    var rate = parseFloat(roomData.rate);
                    rate = rate.toFixed(2);
                    $('#room_two_rate').text(rate);

                    var nights = getNights();
                    var price = (parseFloat(roomData.rate) * nights);
                    $('#room_two_price').text(price.toFixed(2));
                    $('#room_two_price_input').val(price.toFixed(2));
                }

            });

            $('#room_two_extraBed').change(function() {
                if ($(this).val() != "") {
                    var roomData = $('option:selected', '#room_two_type').attr('data-roomdata');
                    roomData = JSON.parse(roomData);
                    var price = 0;

                    var nights = getNights();

                    if ($(this).val() == 1) {

                        $('#room_two_extraBed_rate').text(roomData.extra_bed_rate);

                        price = ((parseFloat(roomData.rate) * nights) + (parseFloat(roomData
                            .extra_bed_rate) * nights));
                    } else {

                        $('#room_two_extraBed_rate').text(0);

                        price = (parseFloat(roomData.rate) * nights);
                    }
                    $('#room_two_price').text(price.toFixed(2));
                    $('#room_two_price_input').val(price.toFixed(2));
                }

            });

            function getNights() {
                var nights = 0;
                var checkin_date = $('#checkin_date').val();
                var checkout_date = $('#checkout_date').val();

                if (checkin_date != "" && checkout_date != "") {
                    var diffInMs = new Date(checkout_date) - new Date(checkin_date)
                    nights = diffInMs / (1000 * 60 * 60 * 24);
                }

                return nights;
            }

            $('.checkDate').change(function() {
                var nights = getNights();
                $('#nights').html(parseFloat(nights))
                $('#room_one_type').trigger('change');
                $('#room_two_type').trigger('change');
            });


            $('#hotel').change(function() {
                var root_url = "<?php echo Request::root(); ?>";
                $.ajax({
                    url: root_url + '/admin/hotel/hotel-rooms/' + $(this).val()+'?requestFor=add',
                    data: {

                    },
                    //dataType: "html",
                    method: "GET",
                    cache: false,
                    success: function(response) {
                        if (response.success) {
                            $('#room_one_price').text('');
                            $('#room_one_price_input').val('');
                            $('#room_two_price').text('');
                            $('#room_two_price_input').val('');
                            // $('#room_one_extraBed').val(0).trigger('change');
                            // $('#room_two_extraBed').val(0).trigger('change');


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

                        }else{
                            $('.roomType')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value="">Select Room</option>');
                            alert('No rooms available for bookings in the selected hotel');
                        }
                    }
                });
            });

            function addRoomDetails(container, value, room, isChild = false) {
                $(container).html('')
                var html = ''
                var label = isChild ? 'Child' : 'Adult'
                var title = isChild ? 'child_title' : 'title'
                var firstName = isChild ? 'child_first_name' : 'first_name'
                var firstLast = isChild ? 'child_last_name' : 'last_name'

                for (let index = 0; index < value; index++) {
                    html += `
                            <div class="row g-3 align-center">
                                <div class="col-lg-2">
                                    <x-inputs.verticalFormLabel label="${label} ${index + 1}" for="adults_${room}_title" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-10">
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <x-inputs.select for="${title}-${room}-${index}" required="true" 
                                                 name="rooms[${room}][${title}][${index}]">
                                                    <option value="Mr">Mr.</option>
                                                    <option value="Miss">Miss</option>
                                                    <option value="Mrs">Mrs.</option>
                                            </x-inputs.select>
                                        </div>
                                        <div class="col-lg-5">
                                            <x-inputs.text value="" name="rooms[${room}][${firstName}][${index}]" placeholder="First Name" />
                                        </div>
                                        <div class="col-lg-5">
                                            <x-inputs.text value="" name="rooms[${room}][${firstLast}][${index}]" placeholder="Last Name"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                }
                $(container).append(html)
                NioApp.Select2.init();
            }


            $("#room_one_adult").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_one_adult', value, 0)

            });

            $("#room_one_child").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_one_child', value, 0, true)
            });

            $("#room_two_adult").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_two_adult', value, 1)
            });

            $("#room_two_child").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_two_child', value, 1, true)
            });



        });
    </script>
@endpush
