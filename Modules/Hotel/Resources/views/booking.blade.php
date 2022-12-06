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
                                        <option>Select Hotel</option>
                                        {{-- @forelse($guests as $key => $guest)
                                            <option value="{{ $guest->id }}">{{ ucfirst($guest->name) }}</option>
                                        @empty
                                        @endforelse --}}
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
                                        <option>Select Hotel</option>
                                        @forelse($hotels as $key => $hotel)
                                            <option value="{{ $hotel->id }}">{{ ucfirst($hotel->name) }}</option>
                                        @empty
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Select check IN and Check out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <x-inputs.text value="" for="date_of_birth" class="date-picker"
                                                icon="calender-date-fill" required="true" placeholder="Date of birth"
                                                name="date_of_birth" />
                                        </div>
                                        <div class="col-lg-6">
                                            <x-inputs.text value="" for="date_of_birth" class="date-picker"
                                                icon="calender-date-fill" required="true" placeholder="Date of birth"
                                                name="date_of_birth" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Rooms" for="" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <table class="table table-borderd">
                                        <tr>
                                            <th>Room Name</th>
                                            <th>Adult</th>
                                            <th>Child</th>
                                            <th>Extra Bed</th>
                                            <th>Per/Night</th>
                                            <th class="text-right">Price</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <x-inputs.select for="room_one_type" required="true" class=""
                                                    name="room_one_type">

                                                    <option value="1">Suit</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_one_adult" icon="mail" required="true"
                                                    class="" name="room_one_adult" id="room_one_adult">
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_one_child" icon="mail" required="true"
                                                    class="" name="room_two_child">

                                                    <option value="0">0</option>
                                                    <option value="1">1</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_one_extraBed" icon="mail" required="true"
                                                    class="" name="room_one_extraBed">

                                                    <option value="0">0</option>
                                                    <option value="1">1</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                ₹10800.00 / Night<br />
                                                <small>Tax Inclusive</small>
                                            </td>
                                            <td class="text-right">
                                                450000
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <x-inputs.select for="room_two_type" required="true" class=""
                                                    placeholder="Select Type" name="room_two_type">

                                                    <option value="1">Suit</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_two_adult" icon="mail" required="true"
                                                    class="" name="room_two_adult">

                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_two_child" icon="mail" required="true"
                                                    class="" name="room_two_child">

                                                    <option value="0">0</option>
                                                    <option value="1">1</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                <x-inputs.select for="room_two_extraBed" icon="mail" required="true"
                                                    class="" name="room_two_extraBed">

                                                    <option value="0">0</option>
                                                    <option value="1">1</option>

                                                </x-inputs.select>
                                            </td>
                                            <td>
                                                ₹10800.00 / Night<br />
                                                <small>Tax Inclusive</small>
                                            </td>
                                            <td class="text-right">
                                                450000
                                            </td>
                                        </tr>
                                    </table>
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
                        <div class="sp-plan-info card-inner">
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
                        <div class="sp-plan-info card-inner" >
                            <div id="cont_room_two_adult"></div>
                            <div id="cont_room_two_child"></div>
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

    <input type="hidden" name="role_type" id="role_type" value="{{ \Config::get('constants.ROLES.BUYER') }}">
    <input type="hidden" name="old_district" id="old_district" value="{{ old('district') }}">
    <input type="hidden" name="old_city" id="old_city" value="{{ old('city') }}">

    <script type="text/javascript">
        $(document).ready(function() {

            var distributorRole = "{{ \Config::get('constants.ROLES.SELLER') }}";
            var retailerRole = "{{ \Config::get('constants.ROLES.BUYER') }}";
            var dspRole = "{{ \Config::get('constants.ROLES.SP') }}";


            function addRoomDetails(container, value, room, isChild = false) {
                $(container).html('')
                var html = ''
                var label = isChild? 'Children':'Adults'
                var title = isChild? 'child_title' :  'title'
                var firstName = isChild? 'child_first_name' : 'first_name'
                var firstLast = isChild? 'child_last_name' : 'last_name'

                for (let index = 0; index < value; index++) {
                    html += `
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="${label} ${index + 1}" for="adults_one_title" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-lg-2">
                                            <x-inputs.select for="title-one-${index}" icon="mail" required="true" class=""
                                                placeholder="Select title" name="rooms[${room}][${title}][${index}]">
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
                addRoomDetails('#cont_room_two_adult', value, 0)
            });

            $("#room_two_child").on("change", function() {
                var value = $(this).val()
                addRoomDetails('#cont_room_two_child', value, 0, true)
            });


        });
    </script>
@endsection
