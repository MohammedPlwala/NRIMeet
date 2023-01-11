@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Failed Payments</h3>
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
                            <a href="javascript::void(0)" data-href="{{ url('admin/report/export-failed-payments') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                    {{-- <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center" colspan="14"><span class="sub-text">Booking Information</span></th>
                        <th class="nk-tb-col tb-col-mb text-center" colspan="5"><span class="sub-text">Cancellation Details</span></th>
                    </tr> --}}
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Order Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Via</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        {{-- <th class="nk-tb-col tb-col-mb"><span class="sub-text">Unmapped Status</span></th> --}}
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Error Message</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction Date</span></th>
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
                                    @forelse ($hotels as $hotel)
                                        <option value="{{ $hotel->name }}">{{ $hotel->name }}</option>
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
                                </x-inputs.select>
                            </div>
                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Payment Via" for="payment_method" suggestion="Select the hotel name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="payment_method" for="payment_method" placeholder="Select payment via">
                                    <option value="">Select</option>
                                    <option value="Payu">Select</option>
                                    <option value="Razorpay">Razorpay</option>
                                </x-inputs.select>
                            </div>
                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Guest" for="guest" suggestion="Guest Name." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" class="form-control" name="guest" id="guest" placeholder="Guest name">
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Order ID" for="orderid" suggestion="Order ID." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user"></em>
                                    </div>
                                    <input type="text" name="orderid" class="form-control" id="orderid" placeholder="Order ID">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Transaction date" for="transaction_date" suggestion="Select the transaction date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="transaction_date" placeholder="Transaction Date" data-date-format="yyyy-mm-dd" name="transaction_date">
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
<script src="{{url('js/tableFlow.js')}}"></script>
<script type="text/javascript">

    $('.export_data').on('click', function (e) {
        var myUrl = $(this).attr('data-href');
        if($('#hotel_name').val() != ""){
            myUrl = addQSParm(myUrl,'hotel_name', $('#hotel_name').val());
        }
        if($('#guest').val() != ""){
            myUrl = addQSParm(myUrl,'guest', $('#guest').val());
        }
        if($('#payment_method').val() != ""){
            myUrl = addQSParm(myUrl,'payment_method', $('#payment_method').val());
        }
        if($('#transaction_date').val() != ""){
            myUrl = addQSParm(myUrl,'transaction_date', $('#transaction_date').val());
        }
        if($('#orderid').val() != ""){
            myUrl = addQSParm(myUrl,'orderid', $('#orderid').val());
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
            '#hotel_name',
            '#transaction_date',
            '#payment_method',
            '#guest',
            '#orderid'
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
                    url: "{{ url('admin/report/failed-payments') }}",
                },
                columns: [
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'guest',
                        name: 'guest'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'hotel',
                        name: 'hotel'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    // {
                    //     "class": "nk-tb-col tb-col-lg text-center",
                    //     // data: 'booking_status',
                    //     data: function(item){
                    //         setTimeout(() => {
                    //             NioApp.setStatusTag(item.status)
                    //         }, 500);
                    //         return '<span class="status-tag badge badge-success">'+item.status+'</span>'
                    //     },
                    //     name: 'booking_status',
                    // },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        // data: 'booking_status',
                        data: function(item){
                            setTimeout(() => {
                                NioApp.setStatusTag(item.unmappedstatus)
                            }, 200);
                            return '<span class="status-tag badge badge-success" data-status-name="'+item.unmappedstatus+'">'+item.unmappedstatus+'</span>'
                        },
                        name: 'booking_status',
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'error_message',

                        data: function(item){
                            return '<b>'+item.error_message+'</b>'
                        },

                        name: 'error_message'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'transaction_date',
                        name: 'transaction_date',
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
                $('#modalFilterorder').modal('toggle');
            },
            filterClearSubmit: '.resetFilter',
            filterModalId: '#modalFilterorder',
            filterItems: items,
            tagId: '#filter_tag_list',
        });

    });
</script>
@endpush