@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Total Inventory Data</h3>
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
                            <a href="javascript::void(0)" data-href="{{ url('admin/report/total-inventory-data-export') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
            <table id="sales_SP" class="products-init nowrap nk-tb-list is-separate table-head-bottom" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb" rowspan="2"><span class="sub-text">Hotel Classification</span></th>
                        <th class="nk-tb-col tb-col-mb" rowspan="2"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb" rowspan="2"><span class="sub-text">Room Types</span></th>
                        <th class="nk-tb-col tb-col-mb" rowspan="2"><span class="sub-text">Room Count</span></th>
                        <th class="nk-tb-col tb-col-mb text-center" colspan="3"><span class="sub-text">Reserved Rooms Status</span></th>
                    </tr>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">MEA Rooms</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">20% Reserved MPT Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Available for PBD Delegates</span></th>
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
                                <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name" suggestion="Select the hotel name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" id="hotel_name" placeholder="Select Hotel Name">
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
                                <x-inputs.select  size="sm" name="room_type" for="room_type" id="room_type" placeholder="Select Room Type">
                                    <option value="">Select</option>
                                    @forelse ($room_types as $roomType)
                                        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
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

        if($('#hotel_name').val() != ""){
            myUrl = addQSParm(myUrl,'hotel_name', $('#hotel_name').val());
        }
        if($('#star_rating').val() != ""){
            myUrl = addQSParm(myUrl,'star_rating', $('#star_rating').val());
        }
        if($('#room_type').val() != ""){
            myUrl = addQSParm(myUrl,'room_type', $('#room_type').val());
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
            '#room_type'
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
                    url: "{{ url('admin/report/total-inventory-data') }}",
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
                        data: 'mea_rooms',
                        name: 'mea_rooms'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'mpt_reserve',
                        name: 'mpt_reserve'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'available_rooms',
                        name: 'available_rooms'
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