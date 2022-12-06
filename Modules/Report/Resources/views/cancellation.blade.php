@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Cancellation</h3>
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
                        <li>
                            <div class="dropdown">
                                <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="dropdown">
                                    <em class="icon ni ni-setting"></em>
                                </a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <ul class="link-check">
                                        <li><span>Actions</span></li>
                                        <li><a href="{{ url('report/export-guest') }}"><em class="icon ni ni-file-xls m-r10"></em> Export Excel</a></li>
                                        <li><a href="{{ url('report/export-guest') }}"><em class="icon ni ni-file-pdf m-r10"></em> Export PDF</a></li>
                                    </ul>
                                </div>
                            </div>
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
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Booking Information</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Cancellation Details</span></th>
                    </tr>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Order Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Confirmation No</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Start Rating</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Guest Count</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check In</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check Out</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Adults</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Child</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Extra Bed</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb text-center">1</td>
                        <td class="nk-tb-col tb-col-mb">Guest name</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb">#fsfdas56456</td>
                        <td class="nk-tb-col tb-col-mb">5</td>
                        <td class="nk-tb-col tb-col-mb">Hotel Name</td>
                        <td class="nk-tb-col tb-col-mb">Base</td>
                        <td class="nk-tb-col tb-col-mb text-center">25</td>
                        <td class="nk-tb-col tb-col-mb">11/11/2022</td>
                        <td class="nk-tb-col tb-col-mb">11/11/2022</td>
                        <td class="nk-tb-col tb-col-mb text-center">3</td>
                        <td class="nk-tb-col tb-col-mb text-center">1</td>
                        <td class="nk-tb-col tb-col-mb text-center">2</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 90000</td>
                    </tr>
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
                                    <option value="Hotel 1">Hotel 1</option>
                                    <option value="Hotel 2">Hotel 2</option>
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
                                <x-inputs.verticalFormLabel label="Guest Count" for="guest_count" suggestion="Enter the guest count." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="guest_count" name="guest_count" placeholder="Enter Guest Count" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Check in Date" for="check_in_date" suggestion="Select the check in date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="check_in_date" placeholder="Check in Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Check out Date" for="check_out_date" suggestion="Select the check out date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="check_out_date" placeholder="Check out Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Booking Status" for="booking_status" suggestion="Select the booking status." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="booking_status" for="booking_status" placeholder="Select Booking Status">
                                    <option value="">Select</option>
                                    <option value="Recevied">Recevied</option>
                                    <option value="Confirmed">Confirmed</option>
                                    <option value="Booking Shared">Booking Shared</option>
                                    <option value="Confirmation Recevied">Confirmation Recevied</option>
                                    <option value="Cancellation Requested">Cancellation Requested</option>
                                    <option value="Cancellation Approved">Cancellation Approved</option>
                                    <option value="Refund Requested">Refund Requested</option>
                                    <option value="Refund Approved">Refund Approved</option>
                                    <option value="Refund Issued">Refund Issued</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Adults" for="adults" suggestion="Enter the adults." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="adults" name="adults" placeholder="Enter Adults" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Child" for="child" suggestion="Enter the child." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="child" name="child" placeholder="Enter Child" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Extra Bed" for="extra_bed" suggestion="Enter the extra bed." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="extra_bed" name="extra_bed" placeholder="Enter Extra Bed" />
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
<script src="{{url('js/APIDataTable.js')}}"></script>
<script src="{{url('js/dayjs.min.js?t='.time())}}"></script>
<script type="text/javascript">
    
    var token = '{{ \Session::get('token') }}';//get logged in user session.
    var organizationId = "{{ \Session::get('currentOrganization') }}";

    var dataTable = new APIDataTable({
        tableElem: '#sales_SP',
        pageinationElem: '#table_pagination',
        api: "{{ url('api/v1/report/total-inventory-data') }}/"+organizationId,
        authToken: 'Bearer '+token,
        filterIds: [
            '#month',
            '#year'
        ],
        filterSubmit: '.submitBtn',
        filterSubmitCallback: function(){
            $('#modalFilterorder').modal('toggle');
        },
        filterClearSubmit: '.resetFilter',
        filterModalId: '#modalFilterorder',
        tagId: '#filter_tag_list',
        columns: [{
                data: "order_number",
            },
            {
                data: "username",
            },
            {
                data: "amount",
                render:function(row){
                    return NioApp.formatToCurrency(row.amount);
                }
            },
            {
                data: "order_date",
                render: function(row) {
                    return row.order_date ? dayjs(row.order_date).format(
                        "DD MMM YYYY"
                    ) : "-";
                },
            },
        ]
    });
</script>
@endpush