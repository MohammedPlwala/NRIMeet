@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Bulk Booking Rooms</h3>
        </div><!-- .nk-block-head-content -->
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="more-options">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterorder">
                                <em class="icon ni ni-filter"></em><span>Filter</span>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking From</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Confirmation Number</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Designation</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Adult</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Child</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check In</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check Out</span></th>
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
                                <x-inputs.verticalFormLabel label="Booking From" for="booking_from" suggestion="Enter the booking from." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="booking_from" name="booking_from" placeholder="Enter Booking From" />
                            </div>
                        </div>
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
                '#booking_from',
                '#hotel_name',
                '#room_type',
                '#confirmation_number',
                '#guest_name',
                '#designation',
                '#adults',
                '#child',
                '#check_in_date',
                '#check_out_date',
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
                            data: 'booking_from',
                            name: 'booking_from'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_name',
                            name: 'hotel_name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'room_type',
                            name: 'room_type'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'confirmation_number',
                            name: 'confirmation_number'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'guest_name',
                            name: 'guest_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'designation',
                            name: 'designation'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'adult',
                            name: 'adult'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'child',
                            name: 'child'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'check_in_date',
                            name: 'check_in_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'check_out_date',
                            name: 'check_out_date'
                        }
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
