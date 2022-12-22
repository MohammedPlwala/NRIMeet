@extends('admin.layouts.app')

@section('content')
    <form role="form" method="post" enctype="multipart/form-data">
        @csrf
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Request <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Name" for="name" suggestion="" />
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->name }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Email" for="email" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->email }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Contact" for="mobile" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->country_code }} {{ $request->mobile }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Address" for="address" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->address }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Country" for="country" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->country }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="City" for="city" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->city }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Adult 1 :  Name" for="adult_1_name" suggestion=""/>
                                </div>
                                <div class="col-lg-3">
                                    {{ $request->guest_name_1 }}
                                </div>
                                <div class="col-lg-2">
                                    <x-inputs.verticalFormLabel label="Age" for="adult_1_age" suggestion=""/>
                                </div>
                                <div class="col-lg-3">
                                    {{ $request->guest_age_1 }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Adult 2 :  Name" for="adult_2_name" suggestion=""/>
                                </div>
                                <div class="col-lg-3">
                                    {{ $request->guest_name_2 }}
                                </div>                    
                                <div class="col-lg-2">
                                    <x-inputs.verticalFormLabel label="Age" for="adult_2_age" suggestion=""/>
                                </div>
                                <div class="col-lg-3">
                                    {{ $request->guest_age_2 }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Check In & Check Out Date" for="hotel"
                                        suggestion="" required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="input-daterange date-picker-range input-group">
                                                <x-inputs.text value="" for="checkin_date" class="checkDate"
                                                    icon="calender-date-fill" value="{{ $request->check_in_date }}" placeholder="Check In Date"
                                                    name="checkin_date" disabled/>

                                                <div class="input-group-addon">TO</div>
                                                <x-inputs.text value="" for="checkout_date" class="checkDate"
                                                    icon="calender-date-fill" value="{{ $request->check_out_date }}" placeholder="Check Out Date"
                                                    name="checkout_date" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Email" for="email" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->check_in_date }}
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Email" for="email" suggestion=""/>
                                </div>
                                <div class="col-lg-8">
                                    {{ $request->check_out_date }}
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->

         {{-- Status & Confirmation --}}
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                
                                <h5 class="o-5">Host Allocation</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <x-inputs.verticalFormLabel label="Host" for="hotel" suggestion=""
                                        required="true" />
                                </div>
                                <div class="col-lg-8">
                                    <x-inputs.select for="status" icon="mail" required="true" class=""
                                        placeholder="Select Status" name="status">
                                        
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
                                    <x-button type="submit" class="btn btn-primary submitBtnx">Submit</x-button>
                                </div>
                            </div>
                        </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
        <input type="hidden" name="home_stay_request_id" id="home_stay_request_id" value="{{ $request->id }}">
    </form>

    <input type="hidden" name="role_type" id="role_type" value="{{ \Config::get('constants.ROLES.BUYER') }}">
@endsection
@push('footerScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {


        });
    </script>
@endpush
