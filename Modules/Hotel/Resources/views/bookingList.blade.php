@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Bookings</h3>
                <p>You have total <span class="record_count">{{ '0' }}</span> Bookings.</p>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal"
                                    title="filter" data-target="#modalFilterUser">
                                    <em class="icon ni ni-filter"></em><span>Filter</span>
                                </a>
                            </li>


                           <li class="nk-block-tools-opt">
                                <a href="{{url('/admin/bookings/add')}}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bookings</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block table-compact">
        <!--  Filter Tag List -->
        <div id="filter_tag_list" class="filter-tag-list"></div>
        <!-- -->
        <div class="nk-tb-list is-separate mb-3">
            <table class="broadcast-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Order #</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Confirmation #</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Hotel</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Rooms</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Checkin Date</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Checkout Date</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Amount</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Booking Type</span></th>
                        <th class="nk-tb-col tb-col-md w-1 text-center" nowrap="true"><span class="sub-text">Status</span>
                        </th>
                        <th class="nk-tb-col nk-tb-col-tools text-right w-1" nowrap="true">
                            <span class="sub-text">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div><!-- .nk-block -->
        <div class="modal fade zoom" tabindex="-1" id="modalFilterUser">
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
                                        <x-inputs.verticalFormLabel label="Hotel Name" for="hotelName"
                                            suggestion="" />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.text value="" for="hotelName" icon="user" placeholder="Name"
                                            name="name" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="userId" name="user_id" value="0">
                        <div class="modal-footer bg-light">
                            <div class="row">
                                <div class="col-lg-12 p-0 text-right">
                                    <button class="btn btn-outline-light" data-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                    <button class="btn btn-danger resetFilter" data-dismiss="modal"
                                        aria-label="Close">Clear Filter</button>
                                    <button class="btn btn-primary submitBtn" type="button">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footerScripts')
    <script src="{{url('js/tableFlow.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            var root_url = "<?php echo url('/'); ?>";

            var logUrl = root_url + '/user/logs';
            NioApp.getAuditLogs('.broadcast-init', '.audit_logs', 'resourceid', logUrl, '#modalLogs');

            var items = [
                '#hotelName'
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
                        url: "{{ url('admin/bookings') }}",
                    },
                    columns: [
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'order_id',
                            name: 'order_id'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'confirmation_number',
                            name: 'confirmation_number'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'guest',
                            name: 'guest'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel',
                            name: 'hotel'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'rooms',
                            name: 'rooms'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'checkin_date',
                            name: 'checkin_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'checkout_date',
                            name: 'checkout_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'booking_type',
                            name: 'booking_type'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'booking_status',
                            name: 'booking_status'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-right",
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
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
