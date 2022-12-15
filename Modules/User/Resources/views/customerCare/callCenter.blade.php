@extends('admin.layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a href="javascript:history.back()" class="pt-3"><em
                            class="icon ni ni-chevron-left back-icon"></em> </a> Add Issue</h3>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <form role="form" method="post" action="{{ url('admin/call-center/store')}}" enctype="multipart/form-data">
        @csrf
        <div class="nk-block">
            <div class="card card-bordered sp-plan">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <div class="sp-plan-action card-inner">
                            <div class="icon">
                                <em class="icon ni ni-box fs-36px o-5"></em>
                                <h5 class="o-5">Guest Personal <br> Information</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="sp-plan-info card-inner">
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="S.no" for="S-no" suggestion="Specify the S.no"
                                        required="true" />
                                </div>
                                <div class="col-lg-7">
                                    {{isset($customerCare) ? $customerCare->id :'#####' }}
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Date" for="date" suggestion="Specify the date."
                                        required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="date" class="date-picker"
                                        icon="calender-date-fill" placeholder="Date" name="date" required="true"  value="{{ isset($customerCare) ? $customerCare->date : old('date') }}"/>
                                    @if ($errors->has('date'))
                                        <span class="text-danger">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Case ID" for="caseId"
                                        suggestion="Specify the case id."/>
                                </div>
                                <div class="col-lg-7">
                                    {{isset($customerCare) ? $customerCare->case_id :'#####' }}
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Staff Name" for="StaffName"
                                        suggestion="Specify the Staff Name." />
                                </div>
                                <div class="col-lg-7">
                                    {{isset($customerCare) ? $customerCare->staff_name :'#####' }}
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Guest Name" for="GuestName"
                                        suggestion="Specify the Guest Name." required="true"  />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="GuestName" icon="user" placeholder="Guest Name"
                                        name="guest_name" required="true" value="{{ isset($customerCare) ? $customerCare->guest_name : old('guest_name') }}" />
                                </div>
                            </div>

                            {{-- <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Country" for="country"
                                        suggestion="Specify the Country." required="true"  />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="country" icon="user" placeholder="Country"
                                        name="country" required="true" value="{{ isset($customerCare) ? $customerCare->country : old('country') }}" />
                                </div>
                            </div> --}}
                            {{--  --}}

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Country / Region" for="Country / Region" suggestion="Specify the country name." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select name="country" for="billing_country"
                                    value="{{ isset($user) ? $user->country : old('country') }}"
                                    class="country_to_state country_select" autocomplete="country"
                                    data-placeholder="Select a country / region…" data-label="Country / Region"
                                    tabindex="-1" aria-hidden="true">
                                    <option value="">Select a country / region…</option>
                                </x-inputs.select>
                                @if ($errors->has('country'))
                                <span class="text-danger">{{ $errors->first('country') }}</span>
                            @endif
                                </div>
                            </div>
                            {{-- <div class="row g-3" id="state_wrapper">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="State" for="State" suggestion="Specify the nationality." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <div id="field_billing_state">
                            
                                    </div>
                                </div>
                            </div> --}}

                            {{--  --}}

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Contact Number" for="ContactNumber"
                                        suggestion="Specify the Contact Number." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="ContactNumber" icon="call"
                                        placeholder="Contact Number" name="contact" required="true"  value="{{ isset($customerCare) ? $customerCare->contact : old('contact') }}"/>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Whatsapp Number" for="WhatsappNumber"
                                        suggestion="Specify the Whatsapp Number." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text value="" for="WhatsappNumber" icon="whatsapp-round"
                                        placeholder="Whatsapp Number" name="whatsapp" required="true" value="{{ isset($customerCare) ? $customerCare->whatsapp : old('whatsapp') }}" />
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Email Id" for="EmailId"
                                        suggestion="Specify the Email Id." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.email value="" for="EmailId" icon="mail-fill"
                                        placeholder="Email Id" name="email" required="true" value="{{ isset($customerCare) ? $customerCare->email : old('email') }}"/>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Method" for="method"
                                        suggestion="Specify the Method." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="" for="method" icon="send" placeholder="Method"
                                        name="method" required="true" value="{{ isset($customerCare) ? $customerCare->method : old('method') }}">
                                        <option value="">Select</option>
                                        <option value="Email">Email</option>
                                        <option value="Call">Call</option>
                                        <option value="Whatsapp">Whatsapp</option>
                                        <option value="MEA">MEA</option>
                                        <option value="MPT">MPT</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Issue" for="issue"
                                        suggestion="Specify the Issue." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="" for="issue" icon="send" placeholder="Issue"
                                        name="issue" required="true" value="{{ isset($customerCare) ? $customerCare->issue : old('issue') }}">
                                        <option value="">Select</option>
                                        <option value="Registration">Registration</option>
                                        <option value="Accommodation">Accommodation</option>
                                        <option value="Transportation">Transportation</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Sub Issue" for="subIssue"
                                        suggestion="Specify the Sub Issue." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="" for="subIssue" id="subIssue" icon="send"
                                        placeholder="Sub Issue" name="sub_issue" required="true" value="{{ isset($customerCare) ? $customerCare->sub_issue : old('sub_issue') }}">
                                        <option value="">Select</option>
                                        <option value="Login Issue">Login Issue</option>
                                        <option value="Payment Issue">Payment Issue</option>
                                        <option value="Profile Issue">Profile Issue</option>
                                        <option value="Password Issue">Password Issue</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Detailed issue" for="issue"
                                        suggestion="Specify the Detailed issue." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="" for="issue" icon="align-left"
                                        placeholder="Detailed issue" name="detailed_issue" required="true" value="{{ isset($customerCare) ? $customerCare->detailed_issue : old('detailed_issue') }}"/>

                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="status"
                                        suggestion="Specify the Status." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="" for="status" icon="send" placeholder="Status"
                                        name="status" required="true" value="{{ isset($customerCare) ? $customerCare->status : old('status') }}">
                                        <option value="">Select</option>
                                        <option value="Open">Open</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Resolved">Resolved</option>
                                        <option value="Pending">Pending</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Pending with" for="status"
                                        suggestion="Specify the Pending with." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select value="" for="pendingWidth" icon="send" placeholder="Detailed pendingWidth"
                                        name="pending" required="true" value="{{ isset($customerCare) ? $customerCare->pending : old('pending') }}">
                                        <option value="">Select</option>
                                        <option value="MEA">MEA</option>
                                        <option value="MPTDC">MPTDC</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Remark" for="remark"
                                        suggestion="Specify the Remark." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.textarea value="" for="remark" icon="align-left"
                                        placeholder="Remark" name="remark" required="true" value="{{ isset($customerCare) ? $customerCare->remark : old('remark') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block -->

        <div class="nk-block">
            @isset($customerCare)
                <input type="hidden" name="customerCareId" id="customerCareId" value="{{ $customerCare->id }}">
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
@endsection
@push('footerScripts')
    <script type="text/javascript">
        var issues = {
            'Registration': [
                "Login Issue",
                "Payment Issue",
                "Profile Issue",
                "Password Issue",
            ],
            "Accommodation": [
                "General Information",
                "Hotel Details",
                "Hotel Price related issue",
                "Login Issue",
                "Payment Issue",
                "Hotel Booking",
                "Bookings changes",
                "Confirmation",
                "Cancellation",
                "Refund",
                "Invoice",
                "Compalint regarding Hotel",
                "Early Check in",
                "Late Check out",
                "Vegetarian food",
                "Nov-vegetarian food",
            ],
            "Transportation": [
                "Transportatin Booking",
                "Car Did not show up",
                "Car showed up late",
                "Change my booking",
                "What are the different modes of payment you support?",
                "Can I buy for someone else using my credit/debit card?",
                "Is it safe to use my credit/debit card on your site? Do you store my card number and details?",
                "How is the total fare/price calculated for a intercity car rental service?",
                "How is the total fare/price calculated for a local car rental service?",
                "What is local, transfer and outstation car rental?",
                "My Driver asked to cancle the ride",
                "Driver asked for extra money ",
                "My driver declined to go",
                "My Driver did not arrive for pickup",
                "Different drive came for pickup",
                "Driver was impolite",
                "Driver misbehaved",
                "Driver did not know the route",
                "Driver did not answer the call ",
                "I was charged cancellation fees incoreectly",
                "I need copy of my invoice ",
                "I was charged more then given fare",
                "Does my charges include toll / parking fees",
                "My payment failed ",
                "Driver stoppped the car midway ",
                "I missed my flight / train ",
                "Issue with cab quality",
                "Issue with cab cleaniness",
                "I left my belongings at the vehicle ",
            ]

        }
        $(document).ready(function() {
            $('#issue').on('change', function() {
                var subIssues = issues[$(this).val()]
                var option = ''
                for (let index = 0; index < subIssues.length; index++) {
                    const val = subIssues[index];
                    option += '<option value="'+val+'">'+val+'</option>'
                }
                $('#subIssue').html(option)
            })
        });
    </script>
@endpush
@push('footerScripts')
<script src="{{url('js/address.js')}}"></script>
@endpush