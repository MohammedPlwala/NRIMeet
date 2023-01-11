@extends('admin.layouts.app')

@section('content')
@php
    $userPermission = \Session::get('userPermission');
@endphp
	<div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Bulk Bookings</h3>
                <p>You have total <span class="record_count">{{ $bulkBookingCount }}</span> Bookings.</p>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterUser">
                                    <em class="icon ni ni-filter"></em><span>Filter</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="{{ url('/admin/bulk-bookings/create') }}" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bulk Booking</span></a>
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
                        <th class="nk-tb-col nk-tb-col-check">
                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                <input type="checkbox" class="custom-control-input" id="check-all" name="check_all"><label class="custom-control-label" for="check-all"></label>
                            </div>
                        </th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Order Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-md" nowrap="true"><span class="sub-text">From</span></th>
                        <th class="nk-tb-col tb-col-md text-center" nowrap="true"><span class="sub-text">Rooms</span></th>
                        <th class="nk-tb-col tb-col-md" nowrap="true"><span class="sub-text">Created At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-right w-1" nowrap="true">
                            <span class="sub-text">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
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
                                <x-inputs.verticalFormLabel label="Hotel" for="hotel" suggestion="Specify the name of the hotel." />
                            </div>
                            <div class="col-lg-7">
                                <!-- <x-inputs.text value="" for="firstName" icon="user" placeholder="Name" name="name"/> -->
                                <x-inputs.select for="hotel" icon="mail" class=""
                                    placeholder="Select" name="hotel_id" value="">
                                    <option value="">Select</option>
                                    @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                    @endforeach
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
                                <x-inputs.verticalFormLabel label="From" for="from" suggestion="Select booking from." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="from" for="from" placeholder="Select Booking From">
                                    <option value="">Select</option>
                                    <option value="MP Tourism">MP Tourism</option>
                                    <option value="MP GOVT">MP GOVT</option>
                                    <option value="YPBD">YPBD</option>
                                    <option value="MEA">MEA</option>
                                    <option value="AGI">AGI</option>
                                    <option value="Guest">Guest</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Created at" for="createdAt" suggestion="Select the dates of created at." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" placeholder="Created Date" data-date-format="yyyy-mm-dd" id="fromDate" name="fromDate">
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

    $(function() {

        

        var root_url = "<?php echo url('/'); ?>";

        var logUrl = root_url + '/user/logs';
        NioApp.getAuditLogs('.broadcast-init','.audit_logs','resourceid',logUrl,'#modalLogs');

        var items = [
            '#hotel',
            '#room_type',
            '#from',
            '#fromDate'
        ];
        var user_table = "";
        user_table = new CustomDataTable({
            tableElem: '.broadcast-init',
            option: {
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    type:"GET",
                    url: "{{ url('admin/bulk-bookings') }}",
                },
                columns: [{
                        "class": "nk-tb-col tb-col-lg nk-tb-col-check",
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return '<td class="nk-tb-col nk-tb-col-check"><div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input cb-check" id="cb-' + row.id + '" value="' + row.id + '" name="checked_items[]"><label class="custom-control-label" for="cb-' + row.id + '"></label></div></td>'
                        }
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'name',
                        name: 'name'
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
                        data: 'booking_person',
                        name: 'booking_person'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'room_count',
                        name: 'room_count'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg text-right",
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "fnDrawCallback":function(){
                    NioApp.BS.tooltip('[data-toggle="tooltip"]'); 
                    $('.changePassword').click(function(){
                        var resourceId = $(this).attr('data-resourceid');
                        $('#password_user_id').val(resourceId);
                        $('#modalUserPassword').modal('show');
                    });
                }
            },
            filterSubmit: '.submitBtn',
            filterSubmitCallback: function(){
                $('#modalFilterUser').modal('toggle');
            },
            filterClearSubmit: '.resetFilter',
            filterModalId: '#modalFilterUser',
            filterItems: items,
            tagId: '#filter_tag_list',
        });

        $('.broadcast-init').on("change","#check-all",function() {
            // If checked
            if (this.checked)
                $('.cb-check').prop('checked', true);
            else
                $('.cb-check').prop('checked', false);
        });

    });
</script>
@endpush