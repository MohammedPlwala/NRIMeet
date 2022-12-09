@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Combined</h3>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="more-options">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterorder">
                                <div class="dot dot-primary"></div>
                                <em class="icon ni ni-filter-alt"></em>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a  href="javascript::void(0)" data-href="{{ url('admin/report/booking-export') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- .nk-block-between -->
</div><!-- .nk-block-head -->
<!--  Filter Tag List -->
<div id="filter_tag_list" class="filter-tag-list"></div>
<div class="nk-block table-compact">
    <div class="table-responsive">
        <div class="nk-tb-list is-separate is-medium mb-3">
            <table class="broadcast-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Total Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact 2</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Billing Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">City</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">State</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Postal Code</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">User Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Registration Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Guest Count</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check In</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check Out</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Booking Status</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room / Night Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Room Nights</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Adults</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Child</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Extra Bed</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Extra Bed Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">GST (Taxes)</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">GST (Tax%)</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Total Amount Paid</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Contact Person</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Contact No#</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Email-Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Landline (If Any)</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Method</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Via</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction Id</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Transaction Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction Response</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">UTR No (If Any)</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Cancellation Date</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Cancellation Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Refundable Amount</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Refund Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Refund Transaction UTR</span></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div><!-- .nk-tb-list -->
</div><!-- .nk-block -->
<div id="table_pagination"></div>


<div class="modal fade zoom" tabindex="-1" id="modalFilterorder">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <form role="form" class="mb-0" method="get" action="#">
                @csrf
                <div class="modal-body modal-body-lg">
                    <div class="gy-3">
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name" suggestion="Select the hotel name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" placeholder="Select Hotel Name">
                                    <option value="">Select</option>
                                    <option value="Hotel 1">Hotel 1</option>
                                    <option value="Hotel 2">Hotel 2</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Room Type" for="room_type" suggestion="Select the room type." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="room_type" for="room_type" placeholder="Select Room Type">
                                    <option value="">Select</option>
                                    <option value="Base">Base</option>
                                    <option value="Suite">Suite</option>
                                    <option value="Premier">Premier</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Guest Count" for="guest_count" suggestion="Enter the guest count." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="guest_count" name="guest_count" placeholder="Enter Guest Count" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Check in Date" for="check_in_date" suggestion="Select the check in date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="check_in_date" placeholder="Check in Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Check out Date" for="check_out_date" suggestion="Select the check out date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="check_out_date" placeholder="Check out Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Booking Status" for="booking_status" suggestion="Select the booking status." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="booking_status" for="booking_status" placeholder="Select Booking Status">
                                    <option value="">Select</option>
                                    <option value="Recevied">Recevied</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Booking Shared">Booking Shared</option>
                                    <option value="Confirmation Recevied">Confirmation Recevied</option>
                                    <option value="Cancellation Requested">Cancellation Requested</option>
                                    <option value="Cancellation Approved">Cancellation Approved</option>
                                    <option value="Refund Requested">Refund Requested</option>
                                    <option value="Refund Approved">Refund Approved</option>
                                    <option value="Refund Issued">Refund Issued</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Adults" for="adults" suggestion="Enter the adults." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="adults" name="adults" placeholder="Enter Adults" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Child" for="child" suggestion="Enter the child." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="child" name="child" placeholder="Enter Child" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Extra Bed" for="extra_bed" suggestion="Enter the extra bed." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="extra_bed" name="extra_bed" placeholder="Enter Extra Bed" />
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userId" name="user_id" value="0">
                <div class="modal-footer bg-light">
                    <div class="row">
                        <div class="col-lg-12 p-0 text-right">
                            <button class="btn btn-outline-light" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button class="btn btn-danger resetFilter" data-dismiss="modal" aria-label="Close">Clear Filter</button>
                            <button class="btn btn-primary submitBtn" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('footerScripts')
<script src="{{url('js/address.js')}}"></script>

    <script src="{{url('js/tableFlow.js')}}"></script>
    <script type="text/javascript">

        $('.export_data').on('click', function (e) {
            var myUrl = $(this).attr('data-href');

            if($('#name').val() != ""){
                myUrl = addQSParm(myUrl,'name', $('#name').val());
            }
            if($('#city').val() != ""){
                myUrl = addQSParm(myUrl,'city', $('#city').val());
            }
            if($('#billing_state').val() != ""){
                myUrl = addQSParm(myUrl,'state', $('#billing_state').val());
            }
            if($('#postal_code').val() != ""){
                myUrl = addQSParm(myUrl,'postal_code', $('#postal_code').val());
            }
            if($('#billing_country').val() != ""){
                myUrl = addQSParm(myUrl,'country', $('#billing_country').val());
            }


            location.href = myUrl;
        });

        function addQSParm(myUrl,name, value) {
           var re = new RegExp("([?&]" + name + "=)[^&]+", "");

           function add(sep) {
              myUrl += sep + name + "=" + encodeURIComponent(value);
           }

           function change() {
              myUrl = myUrl.replace(re, "$1" + encodeURIComponent(value));
           }
           if (myUrl.indexOf("?") === -1) {
              add("?");
           } else {
              if (re.test(myUrl)) {
                 change();
              } else {
                 add("&");
              }
           }
           return myUrl;
        }

        $(function() {
            var root_url = "<?php echo url('/'); ?>";

            var logUrl = root_url + '/user/logs';
            NioApp.getAuditLogs('.broadcast-init', '.audit_logs', 'resourceid', logUrl, '#modalLogs');

            var items = [
                '#hotel_name',
                '#room_type',
                '#guest_count',
                '#check_in_date',
                '#check_out_date',
                '#adults',
                '#child',
                '#booking_status',
                '#extra_bed'
            ];
            var user_table = "";
            user_table = new CustomDataTable({
                tableElem: '.broadcast-init',
                option: {
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: {
                        type: "GET",
                        url: "{{ url('admin/report/booking') }}",
                    },
                    columns: [
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_name',
                            name: 'hotel_name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'total_inventory',
                            name: 'total_inventory'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'payment_id',
                            name: 'payment_id'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'guest_name',
                            name: 'guest_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'contact',
                            name: 'contact'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'email_address',
                            name: 'email_address'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'contact_2',
                            name: 'contact_2'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'billing_address',
                            name: 'billing_address'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'city',
                            name: 'city'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'state',
                            name: 'state'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'country',
                            name: 'country'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'postal_code',
                            name: 'postal_code'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'user_id',
                            name: 'user_id'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'registration_date',
                            name: 'registration_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'room_type',
                            name: 'room_type'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'guest_count',
                            name: 'guest_count'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'booking_date',
                            name: 'booking_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'check_in',
                            name: 'check_in'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'check_out',
                            name: 'check_out'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'booking_status',
                            name: 'booking_status'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'room_night_charge',
                            name: 'room_night_charge'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'total_room_nights',
                            name: 'total_room_nights'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'adults',
                            name: 'adults'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'child',
                            name: 'child'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'extra_bed',
                            name: 'extra_bed'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'room_charges',
                            name: 'room_charges'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'extra_bed_charges',
                            name: 'extra_bed_charges'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'gst_taxes',
                            name: 'gst_taxes'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'gst_tax',
                            name: 'gst_tax'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'total_amount_paid',
                            name: 'total_amount_paid'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_contact_person',
                            name: 'hotel_contact_person'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_contact_no',
                            name: 'hotel_contact_no'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_email_id',
                            name: 'hotel_email_id'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_landline',
                            name: 'hotel_landline'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'payment_method',
                            name: 'payment_method'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'payment_via',
                            name: 'payment_via'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'transaction_id',
                            name: 'transaction_id'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'transaction_status',
                            name: 'transaction_status'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'transaction_response',
                            name: 'transaction_response'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'utr_no',
                            name: 'utr_no'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'settlement_date',
                            name: 'settlement_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'cancellation_date',
                            name: 'cancellation_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'cancellation_charges',
                            name: 'cancellation_charges'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'refundable_amount',
                            name: 'refundable_amount'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'refund_date',
                            name: 'refund_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'refund_transaction_utr',
                            name: 'refund_transaction_utr'
                        },
                    ],
                    "fnDrawCallback": function() {
                        NioApp.BS.tooltip('[data-toggle="tooltip"]');
                        $('.changePassword').click(function() {
                            var resourceId = $(this).attr('data-resourceid');
                            $('#password_user_id').val(resourceId);
                            $('#modalUserPassword').modal('show');
                        });
                    }
                },
                filterSubmit: '.submitBtn',
                filterSubmitCallback: function() {
                    $('#modalFilterUser').modal('toggle');
                },
                filterClearSubmit: '.resetFilter',
                filterModalId: '#modalFilterUser',
                filterItems: items,
                tagId: '#filter_tag_list',
            });



        });
    </script>
@endpush