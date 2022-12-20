@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Inventory</h3>
                <p>You have total <span class="record_count">{{ $roomsCount }}</span> Rooms.</p>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em
                            class="icon ni ni-more-v"></em></a>
                    <!-- <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal"
                                    title="filter" data-target="#modalFilterUser">
                                    <em class="icon ni ni-filter"></em><span>Filter</span>
                                </a>
                            </li>


                            <li class="nk-block-tools-opt">
                                <a href="{{ url('/admin/hotel/rooms/add') }}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Rooms</span></a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block table-compact">
        <!--  Filter Tag List -->
        <div id="filter_tag_list" class="filter-tag-list"></div>
        <!-- -->
        <form role="form" method="post" enctype="multipart/form-data" action="{{ url('admin/update-inventory') }}">
        @csrf
        <div class="table-responsive">
            <div class="nk-tb-list is-separate mb-3 ">
                
                <table class="broadcast-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">classification</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Hotel Name</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                            <th class="nk-tb-col tb-col-md text-right"><span class="sub-text">Rate</span></th>
                            <th class="nk-tb-col tb-col-md text-center"><span class="sub-text">Allocated Rooms</span></th>
                            <th class="nk-tb-col tb-col-md text-center"><span class="sub-text">MPT Reserve</span></th>
                            <th class="nk-tb-col tb-col-md text-center"><span class="sub-text">Bookable Inventory</span></th>
                            <th class="nk-tb-col tb-col-md text-right"><span class="sub-text">Delegate Booking</span></th>
                            <th class="nk-tb-col tb-col-md text-center"><span class="sub-text">Available Rooms</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                                    <x-button type="submit" class="btn btn-primary submitBtnx right">Submit</x-button>
                                </div>
                            </div>
                        </div>
                    </div><!-- .sp-plan-info -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div>
        </form>
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

                                        <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" placeholder="Select Hotel" id="hotel_name">
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
                                        <x-inputs.verticalFormLabel label="Room Type" for="room_type" suggestion="Select the room type." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="room_type" for="room_type" placeholder="Select Room Type" id="room_type">
                                            <option value="">Select</option>
                                            @forelse ($room_types as $roomType)
                                                <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                            @empty
                                                {{-- empty expr --}}
                                            @endforelse
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Charges" for="charges" suggestion="Enter the charges." />
                                    </div>
                                    <div class="col-lg-7">
                                        <!-- <x-inputs.number  value="" for="charges" name="charges" placeholder="Enter Charges" /> -->
                                        <x-inputs.select  size="sm" name="charges" for="charges" placeholder="Select Charges" id="charges">
                                            <option value="">Select</option>
                                            <option value="1">5000 to 10000</option>
                                            <option value="2">10000 to 15000</option>
                                            <option value="3">15000 to 20000</option>
                                            <option value="4">Above 20000</option>
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
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </x-inputs.select>
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
                // '#room_name',
                '#hotel_name',
                '#room_type',
                '#charges',
                '#status'
            ];
            var user_table = "";
            user_table = new CustomDataTable({
                tableElem: '.broadcast-init',
                option: {
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    bPaginate: false,
                    ajax: {
                        type: "GET",
                        url: "{{ url('admin/available-inventory') }}",
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
                            data: 'classification',
                            name: 'classification'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_name',
                            name: 'hotel_name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'room_type_name',
                            name: 'room_type_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'rate',
                            name: 'rate'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'allocated_rooms',
                            name: 'allocated_rooms'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'mpt_reserve',
                            name: 'mpt_reserve'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'bookable_inventory',
                            name: 'bookable_inventory'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'current_booking',
                            name: 'current_booking'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'count',
                            name: 'count'
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
