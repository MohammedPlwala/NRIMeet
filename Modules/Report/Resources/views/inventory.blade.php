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
                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterorder">
                                <div class="dot dot-primary"></div>
                                <em class="icon ni ni-filter-alt"></em>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="{{ url('report/export-inventory') }}" class="btn btn-primary"><em class="icon ni ni-download"></em><span>Export</span></a>
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
            <table id="sales_SP" class="products-init nowrap nk-tb-list is-separate table-head-top" data-auto-responsive="false">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center" colspan="15"><span class="sub-text">Inventory Details</span></th>
                        <th class="nk-tb-col tb-col-mb text-center" colspan="7"><span class="sub-text">Hotel Payment (to be filled manually) </span></th>
                    </tr>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Rating</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Old Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">New Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Alloted <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Alloted <br/>Extra bed</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">MPT Reserve</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Opening Room <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Opening Extra <br/>Bed Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Room Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Extra Bed Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Current Bookings</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Closing Room <br/>Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Closing Extra <br/>Bed Inventory</span></th>

                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Payable to hotel</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Payment Date</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Payment Made by <br/>(Bank, Card, UPI etc.)</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Mode of Payment</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Transaction ID</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Settlement ID</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">URT NO</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb text-center">1</td>
                        <td class="nk-tb-col tb-col-mb text-center">7</td>
                        <td class="nk-tb-col tb-col-mb">Sayaji</td>
                        <td class="nk-tb-col tb-col-mb">Premium</td>
                        <td class="nk-tb-col tb-col-mb">Base</td>
                        <td class="nk-tb-col tb-col-mb text-center">20</td>
                        <td class="nk-tb-col tb-col-mb text-center">3</td>
                        <td class="nk-tb-col tb-col-mb text-center">15</td>
                        <td class="nk-tb-col tb-col-mb text-center">80</td>
                        <td class="nk-tb-col tb-col-mb text-center">12</td>
                        <td class="nk-tb-col tb-col-mb">25645</td>
                        <td class="nk-tb-col tb-col-mb">12355</td>
                        <td class="nk-tb-col tb-col-mb text-center">45</td>
                        <td class="nk-tb-col tb-col-mb text-center">20</td>
                        <td class="nk-tb-col tb-col-mb text-center">10</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb">12/11/2022</td>
                        <td class="nk-tb-col tb-col-mb">Bank</td>
                        <td class="nk-tb-col tb-col-mb">Online</td>
                        <td class="nk-tb-col tb-col-mb text-center">20</td>
                        <td class="nk-tb-col tb-col-mb text-center">10</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
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
                                <x-inputs.verticalFormLabel label="Rating" for="rating" suggestion="Select the rating." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="rating" for="rating" placeholder="Select Rating">
                                    <option value="">Select</option>
                                    <option value="5 Star">7 Star</option>
                                    <option value="5 Star Deluxe">5 Star Deluxe</option>
                                    <option value="5 Star">5 Star</option>
                                    <option value="4 Star">4 Star</option>
                                    <option value="3 Star">3 Star</option>
                                    <!-- @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ date('F',strtotime('2012-'.$i.'-12')) }}</option>
                                    @endfor -->
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