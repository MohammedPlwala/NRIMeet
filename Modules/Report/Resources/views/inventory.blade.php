@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Inventory</h3>
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
                            <a href="javascript::void(0)" data-href="{{ url('admin/report/export-inventory') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb text-left"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb text-left"><span class="sub-text">Classification</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Alloted <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">MPT Reserve</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">MEA Reserved</span></th>
                        
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Opening Room <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Extra Bed Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Total Booking(In Rs.)</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Current Bookings</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Closing Room <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Person</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Mobile No.</span></th>
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
                                <x-inputs.verticalFormLabel label="Classification" for="rating" suggestion="Select the classification." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="rating" for="rating" placeholder="Select Classification">
                                    <option value="">Select</option>
                                    <option value="7 Star">7 Star</option>
                                    <option value="5 Star">5 Star</option>
                                    <option value="4 Star">4 Star</option>
                                    <option value="3 Star">3 Star</option>
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
                                <x-inputs.verticalFormLabel label="Room Count" for="room_count" suggestion="Enter the room count." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="room_count" name="room_count" placeholder="Enter Room Count" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Room Charges" for="room_charges" suggestion="Enter the room charges." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="room_charges" name="room_charges" placeholder="Enter Room Charges" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Status" for="status" suggestion="Select the status." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="status" for="status" placeholder="Select Status">
                                    <option value="">Select</option>
                                    <option value="Active">Active</option>
                                    <option value="Paused">Paused</option>
                                    <option value="Out of stock">Out of stock</option>
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
        if($('#rating').val() != ""){
            myUrl = addQSParm(myUrl,'rating', $('#rating').val());
        }
        if($('#room_type').val() != ""){
            myUrl = addQSParm(myUrl,'room_type', $('#room_type').val());
        }
        if($('#room_count').val() != ""){
            myUrl = addQSParm(myUrl,'room_count', $('#room_count').val());
        }
        if($('#room_charges').val() != ""){
            myUrl = addQSParm(myUrl,'room_charges', $('#room_charges').val());
        }
        if($('#status').val() != ""){
            myUrl = addQSParm(myUrl,'status', $('#status').val());
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
            '#rating',
            '#room_type',
            '#room_count',
            '#room_charges',
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
                    url: "{{ url('admin/report/inventory') }}",
                },
                columns: [
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'name',
                        name: 'name'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'classification',
                        name: 'classification'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'room_type_name',
                        name: 'room_type_name'
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
                        data: 'mea_rooms',
                        name: 'mea_rooms'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'opening_room',
                        name: 'opening_room'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-right",
                        data: 'rate',
                        name: 'rate'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-right",
                        data: 'extra_bed_rate',
                        name: 'extra_bed_rate'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-right",
                        data: 'total_booking',
                        name: 'total_booking'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'current_booking',
                        name: 'current_booking'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'available_rooms',
                        name: 'available_rooms'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'contact_person',
                        name: 'contact_person'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'contact_number',
                        name: 'contact_number'
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