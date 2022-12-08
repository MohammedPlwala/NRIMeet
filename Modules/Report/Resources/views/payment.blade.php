@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Payment</h3>
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
                            <a href="{{ url('report/export-payment') }}" class="btn btn-primary"><em class="icon ni ni-download"></em><span>Export</span></a>
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
            <table id="sales_SP" class="products-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Order Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Rooms Booked</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Guest</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room / Night Charge</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Tax Collected</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Total Amount</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Method</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Via</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">UTR NO.</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Paytm Response</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">URT No.</span></th>
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
                                <x-inputs.verticalFormLabel label="Guest Name" for="guest_name" suggestion="Enter the guest name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="guest_name" name="guest_name" placeholder="Enter Guest Name" />
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
                                <x-inputs.verticalFormLabel label="Status" for="status" suggestion="Select the status." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="status" for="status" placeholder="Select Status">
                                    <option value="">Select</option>
                                    <option value="Payment Recevied From Guest">Payment Recevied From Guest</option>
                                    <option value="Payment Completed to Hotel">Payment Completed to Hotel</option>
                                    <option value="Cancellation Requested">Cancellation Requested</option>
                                    <option value="Cancellation Approved">Cancellation Approved</option>
                                    <option value="Refund Requested">Refund Requested</option>
                                    <option value="Refund Approved">Refund Approved</option>
                                    <option value="Refund Issued">Refund Issued</option>
                                </x-inputs.select>
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
<script src="{{url('js/tableFlow.js')}}"></script>
<script type="text/javascript">

    $('.export_data').on('click', function (e) {
        var myUrl = $(this).attr('data-href');
        if($('#star_rating').val() != ""){
            myUrl = addQSParm(myUrl,'star_rating', $('#star_rating').val());
        }
        if($('#room_type').val() != ""){
            myUrl = addQSParm(myUrl,'room_type', $('#room_type').val());
        }
        if($('#charges').val() != ""){
            myUrl = addQSParm(myUrl,'charges', $('#charges').val());
        }
        if($('#closing_inventory').val() != ""){
            myUrl = addQSParm(myUrl,'closing_inventory', $('#closing_inventory').val());
        }
        if($('#distance_from_airport').val() != ""){
            myUrl = addQSParm(myUrl,'distance_from_airport', $('#distance_from_airport').val());
        }
        if($('#distance_from_venue').val() != ""){
            myUrl = addQSParm(myUrl,'distance_from_venue', $('#distance_from_venue').val());
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
        NioApp.getAuditLogs('.products-init', '.audit_logs', 'resourceid', logUrl, '#modalLogs');

        var items = [
            '#star_rating',
            '#room_type',
            '#charges',
            '#closing_inventory',
            '#distance_from_airport',
            '#distance_from_venue'
        ];
        var user_table = "";
        user_table = new CustomDataTable({
            tableElem: '.products-init',
            option: {
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    type: "GET",
                    url: "{{ url('admin/report/inventory') }}",
                },
                columns: [
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'classification',
                        name: 'classification'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'name',
                        name: 'name'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'hotel_type',
                        name: 'hotel_type'
                    },

                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'allocated_rooms',
                        name: 'allocated_rooms'
                    },

                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'mpt_reserve',
                        name: 'mpt_reserve'
                    },
                    // available_rooms == OPENING ROOM INVENTORY
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'available_rooms',
                        name: 'available_rooms'
                    },
                    // available_rooms == OPENING EXTRA BED INVENTORY
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'extra_bed_available',
                        name: 'extra_bed_available'
                    },
                    // available_rooms == Room Charge
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'rate',
                        name: 'rate'
                    },
                    // available_rooms == extra bed Charge
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'extra_bed_rate',
                        name: 'extra_bed_rate'
                    },
                    // available_rooms == Current Booking
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'current_booking',
                        name: 'current_booking'
                    },
                    // available_rooms == Current Booking Ammount
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'room_booking_amount',
                        name: 'room_booking_amount',
                        value: 'XXXX'
                    },
                    // {
                    //     "class": "nk-tb-col tb-col-lg",
                    //     data: 'airport_distance',
                    //     name: 'airport_distance'
                    // },
                    // {
                    //     "class": "nk-tb-col tb-col-lg",
                    //     data: 'venue_distance',
                    //     name: 'venue_distance'
                    // },
                    // {
                    //     "class": "nk-tb-col tb-col-lg",
                    //     data: 'address',
                    //     name: 'address'
                    // },
                    // {
                    //     "class": "nk-tb-col tb-col-lg",
                    //     data: 'website',
                    //     name: 'website'
                    // }
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
                $('#modalFilterorder').modal('toggle');
            },
            filterClearSubmit: '.resetFilter',
            filterModalId: '#modalFilterorder',
            // filterItems: items,
            tagId: '#filter_tag_list',
        });

    });
</script>
@endpush