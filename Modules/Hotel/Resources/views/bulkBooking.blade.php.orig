@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a>Add Bulk Booking</h3>
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
                                <h5 class="o-5">Rooms <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Name" for="name" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text for="name" icon="mail" required="true" class=""
                                        placeholder="Select" name="name" />
                                      
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Hotel" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="hotel" icon="mail" required="true" class=""
                                        placeholder="Select" name="hotel">
                                        <option>Select</option>
                                       
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Room Type" for="roomType" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="roomType" icon="mail" required="true" class=""
                                        placeholder="Select" name="roomType">
                                        <option>Select</option>
                                       
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Booking From" for="bookingFrom" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="bookingFrom" icon="mail" required="true" class=""
                                        placeholder="Select Guest" name="bookingFrom">
                                        <option>Select</option>
                                        <option>mp Tourism</option>
                                        <option>MP GOVT</option>
                                        <option>YPBD</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Select check IN and Check out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <x-inputs.text value="" for="checkin_date" class="date-picker checkDate"
                                                icon="calender-date-fill" required="true" placeholder="Date of birth"
                                                name="checkin_date" />
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <x-inputs.text value="" for="checkout_date" class="date-picker checkDate"
                                                icon="calender-date-fill" required="true" placeholder="Date of birth"
                                                name="checkout_date" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="#Rooms" for="rooms" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.text for="rooms" icon="building" required="true" class=""
                                        placeholder="#Rooms" name="rooms" />
                                      
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
                                <h5 class="o-5">Rooms <br> Booking Details</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    
                                </div>
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <x-inputs.verticalFormLabel label="Booking Id" for="name" suggestion=""
                                        />
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.verticalFormLabel label="Adult Count" for="name" suggestion=""
                                            />
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.verticalFormLabel label="Child Count" for="name" suggestion=""
                                            />
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-md-4">
                                    <x-inputs.verticalFormLabel label="Room 1" for="name" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <x-inputs.text for="bookingId" icon="building-fill" required="true"
                                            placeholder="Booking Id"  name="bookingId" value="" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.text for="adultCount" icon="users-fill" required="true"
                                            placeholder="Adult count" name="adultCount" value=""/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.text for="childCount" icon="users-fill" required="true"
                                            placeholder="Child count" name="childCount" value="" />
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


    <script type="text/javascript">
        $(document).ready(function() {
          


        });
    </script>
@endsection
