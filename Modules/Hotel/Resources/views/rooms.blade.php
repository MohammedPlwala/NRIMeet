@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Rooms</h3>
                <p>You have total <span class="record_count">{{ $roomsCount }}</span> Rooms.</p>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="modal"
                                    title="filter" data-target="#modalFilterUser">
                                    <div class="dot dot-primary"></div>
                                    <em class="icon ni ni-filter-alt"></em>
                                </a>
                            </li>


                            <li class="nk-block-tools-opt">
                                <a href="{{ url('/admin/hotel/rooms/add') }}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Rooms</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block table-compact pt-28">
        <!--  Filter Tag List -->
        <div id="filter_tag_list" class="filter-tag-list"></div>
        <!-- -->
        <div class="nk-tb-list is-separate mb-3">
            <table class="broadcast-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Hotel</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Rate</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Allocated Rooms</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">MPT Reserve</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Available Rooms</span></th>
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
                                        <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name"
                                            suggestion="" />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.text value="" for="hotel_name" icon="user" placeholder="Hotel Name" name="hotel_name" />
                                    </div>
                                </div>

                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Room Name" for="room_name"
                                            suggestion="" />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.text value="" for="room_name" icon="user" placeholder="Room Name" name="room_name" />
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
                '#room_name',
                '#hotel_name'
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
                        url: "{{ url('admin/hotel/rooms') }}",
                    },
                    columns: [
                        // {
                        //     "class": "nk-tb-col tb-col-lg nk-tb-col-check",
                        //     data: 'DT_RowIndex',
                        //     name: 'DT_RowIndex',
                        //     orderable: false,
                        //     searchable: false,
                        //     render: function(data, type, row, meta) {
                        //         return '<td class="nk-tb-col nk-tb-col-check"><div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input cb-check" id="cb-' +
                        //             row.id + '" value="' + row.id +
                        //             '" name="checked_items[]"><label class="custom-control-label" for="cb-' +
                        //             row.id + '"></label></div></td>'
                        //     }
                        // },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'name',
                            name: 'name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'room_type_name',
                            name: 'room_type_name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_name',
                            name: 'hotel_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'rate',
                            name: 'rate'
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
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'count',
                            name: 'count'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'status',
                            name: 'status'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
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
