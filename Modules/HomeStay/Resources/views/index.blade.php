@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Delegate Request</h3>
                <p>You have total <span class="record_count">{{ $homeStayCount }}</span> Requests.</p>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Mobile</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Check In Date</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Check Out Date</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Host Name</span></th>
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
                        <!-- <div class="modal-body modal-body-lg">
                            <div class="gy-3">
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name" suggestion="Select the hotel name." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" placeholder="Select Hotel Name">
                                            <option value="">Select</option>
                                           
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Hotel City" for="hotel_city" suggestion="Select the hotel city." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="hotel_city" for="hotel_city" placeholder="Select Hotel City">
                                            <option value="">Select</option>
                                            <option value="Indore">Indore</option>
                                            <option value="Ujjain">Ujjain</option>
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Classification" for="star_rating" suggestion="Select the classification." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="star_rating" for="star_rating" placeholder="Select Classification" id="star_rating">
                                            <option value="">Select</option>
                                            
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Distance From Airport" for="distance_from_airport" suggestion="Select the distance from airport." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="distance_from_airport" for="distance_from_airport" placeholder="Select Distance From Airport" id="distance_from_airport">
                                            <option value="">Select</option>
                                            <option value="5">Under 5 km</option>
                                            <option value="10">Under 10 km</option>
                                            <option value="15">Under 15 km</option>
                                            <option value="25">Under 25 km</option>
                                            <option value="2000">Above 25 km</option>
                                        </x-inputs.select>
                                    </div>
                                </div>
                                <div class="row g-3 align-center">
                                    <div class="col-lg-5">
                                        <x-inputs.verticalFormLabel label="Distance From Venue" for="distance_from_venue" suggestion="Select the distance from venue." />
                                    </div>
                                    <div class="col-lg-7">
                                        <x-inputs.select  size="sm" name="distance_from_venue" for="distance_from_venue" placeholder="Select Distance From Venue" id="distance_from_venue">
                                            <option value="">Select</option>
                                            <option value="5">Under 5 km</option>
                                            <option value="10">Under 10 km</option>
                                            <option value="15">Under 15 km</option>
                                            <option value="25">Under 25 km</option>
                                            <option value="2000">Above 25 km</option>
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
                                            {{-- <option value="Out of stock">Out of stock</option> --}}
                                        </x-inputs.select>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
                '#hotel_name',
                '#hotel_city',
                '#star_rating',
                '#distance_from_airport',
                '#distance_from_venue',
                '#status'
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
                        url: "{{ url('admin/homestay/requests') }}",
                    },
                    columns: [
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'name',
                            name: 'name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'email',
                            name: 'email'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'address',
                            name: 'address'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'country',
                            name: 'country'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'check_in_date',
                            name: 'check_in_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'check_out_date',
                            name: 'check_out_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'hostName',
                            name: 'hostName'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'status',
                            name: 'status'
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
                // filterItems: items,
                tagId: '#filter_tag_list',
            });



        });
    </script>
@endpush
