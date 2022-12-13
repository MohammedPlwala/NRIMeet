@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Hotel Master</h3>
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
                            <a href="javascript:void(0);" data-href="{{ url('admin/report/export-hotel-master') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Classification</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Room Count</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Extra Bed Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Closing Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Person</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Number</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Description</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Distance From Airport</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Distance From Venue</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Location</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Website</span></th>
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
                                <x-inputs.verticalFormLabel label="Classification" for="star_rating" suggestion="Select the classification." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="star_rating" for="star_rating" placeholder="Select Classification" id="star_rating">
                                    <option value="">Select</option>
                                    @forelse ($classifications as $classification)
                                        <option value="{{ $classification->classification }}">{{ $classification->classification }}</option>
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
                                <x-inputs.verticalFormLabel label="Closing Inventory" for="closing_inventory" suggestion="Enter the closing inventory." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="closing_inventory" name="closing_inventory" placeholder="Enter Closing Inventory" id="closing_inventory" />
                            </div>
                        </div>
                        {{-- <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Distance From Airport" for="distance_from_airport" suggestion="Select the distance from airport." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="distance_from_airport" for="distance_from_airport" placeholder="Select Distance From Airport" id="distance_from_airport">
                                    <option value="">Select</option>
                                    <option value="5">Under 5 km</option>
                                    <option value="10">Under 10 km</option>
                                    <option value="15">Under 15 km</option>
                                    <option value="20">Under 25 km</option>
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
                                    <option value="20">Under 25 km</option>
                                    <option value="2000">Above 25 km</option>
                                </x-inputs.select>
                            </div>
                        </div> --}}
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
            '#hotel_name',
            '#star_rating',
            '#room_type',
            '#charges',
            '#closing_inventory',
            // '#distance_from_airport',
            // '#distance_from_venue'
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
                    url: "{{ url('admin/report/hotel-master') }}",
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
                        data: 'room_type',
                        name: 'room_type'
                    },

                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'allocated_rooms',
                        name: 'allocated_rooms'
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
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'available_rooms',
                        name: 'available_rooms'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'contact_person',
                        name: 'contact_person'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'contact_number',
                        name: 'contact_number'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        // data: 'description',
                        data: function(item){
                            if(item.description == null){
                                return '<span class="fixcol-200">&nbsp;</span>'
                            }else{
                                return '<span class="fixcol-200">'+item.description+'</span>'
                            }
                        },
                        name: 'description'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'airport_distance',
                        name: 'airport_distance'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'venue_distance',
                        name: 'venue_distance'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        // data: 'address',
                        data: function(item){
                            if(item.address == null){
                                return '<span class="fixcol-200">&nbsp;</span>'
                            }else{
                                return '<span class="fixcol-200">'+item.address+'</span>'
                            }
                        },
                        name: 'address'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        // data: 'website',
                        data: function(item){
                            return '<span class="fixcol-200">'+item.website+'</span>'
                        },
                        name: 'website'
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