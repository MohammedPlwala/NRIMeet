@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Payment</h3>
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
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Order Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Rooms Booked</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Guest</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room / Night Charge</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Tax Collected</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Total Amount</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Method</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Via</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">UTR NO.</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Paytm Response</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">URT No.</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb text-center">1</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb">Guest name</td>
                        <td class="nk-tb-col tb-col-mb">11/11/2022</td>
                        <td class="nk-tb-col tb-col-mb">11/11/2022</td>
                        <td class="nk-tb-col tb-col-mb">India</td>
                        <td class="nk-tb-col tb-col-mb">Hotel name</td>
                        <td class="nk-tb-col tb-col-mb text-center">15</td>
                        <td class="nk-tb-col tb-col-mb text-center">30</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 5000</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 60000</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 90000</td>
                        <td class="nk-tb-col tb-col-mb">Refund Approved</td>
                        <td class="nk-tb-col tb-col-mb">Credit Card</td>
                        <td class="nk-tb-col tb-col-mb">VISA</td>
                        <td class="nk-tb-col tb-col-mb">#s445654adfsdfs</td>
                        <td class="nk-tb-col tb-col-mb">11/11/2022</td>
                        <td class="nk-tb-col tb-col-mb">454545</td>
                        <td class="nk-tb-col tb-col-mb">Pending</td>
                        <td class="nk-tb-col tb-col-mb">Test</td>
                        <td class="nk-tb-col tb-col-mb">5555</td>
                        <td class="nk-tb-col tb-col-mb">#d5454adsf4as5f4f</td>
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
                                <x-inputs.verticalFormLabel label="Guest Name" for="guest_name" suggestion="Enter the guest name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="guest_name" name="guest_name" placeholder="Enter Guest Name" />
                            </div>
                        </div>
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
                                <x-inputs.verticalFormLabel label="Status" for="status" suggestion="Select the status." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="status" for="status" placeholder="Select Status">
                                    <option value="">Select</option>
                                    <option value="Payment Recevied From Guest">Payment Recevied From Guest</option>
                                    <option value="Payment Completed to Hotel">Payment Completed to Hotel</option>
                                    <option value="Cancellation Requested">Cancellation Requested</option>
                                    <option value="Cancellation Approved">Cancellation Approved</option>
                                    <option value="Refund Requested">Refund Requested</option>
                                    <option value="Refund Approved">Refund Approved</option>
                                    <option value="Refund Issued">Refund Issued</option>
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