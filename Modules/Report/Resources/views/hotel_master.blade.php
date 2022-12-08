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
                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterorder">
                                <div class="dot dot-primary"></div>
                                <em class="icon ni ni-filter-alt"></em>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="{{ url('report/export-hotel-master') }}" class="btn btn-primary"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Start Rating</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Room Count</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Charges</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Extra Bed Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Closing Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Person</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Number</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Whatsapp Number</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email ID</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Description</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Distance From Airport</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Distance From Venue</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Location</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Website</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb text-center">1</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb">Hotel name</td>
                        <td class="nk-tb-col tb-col-mb">Base</td>
                        <td class="nk-tb-col tb-col-mb text-center">3</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 5000</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 5000</td>
                        <td class="nk-tb-col tb-col-mb text-center">60</td>
                        <td class="nk-tb-col tb-col-mb">Sanjay Sharma</td>
                        <td class="nk-tb-col tb-col-mb">1234561234</td>
                        <td class="nk-tb-col tb-col-mb">1234561234</td>
                        <td class="nk-tb-col tb-col-mb">test@gmail.com</td>
                        <td class="nk-tb-col tb-col-mb">sadkfsal fjsadflkj sdfl;kadjf sal;dkfjsa</td>
                        <td class="nk-tb-col tb-col-mb text-center">5km</td>
                        <td class="nk-tb-col tb-col-mb text-center">5km</td>
                        <td class="nk-tb-col tb-col-mb">sadfsdfsa dfs dfsadf</td>
                        <td class="nk-tb-col tb-col-mb">http://www.test.com</td>
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
                                <x-inputs.verticalFormLabel label="Star Rating" for="star_rating" suggestion="Select the star rating." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="star_rating" for="star_rating" placeholder="Select Star Rating">
                                    <option value="">Select</option>
                                    <option value="5 Star">7 Star</option>
                                    <option value="5 Star Deluxe">5 Star Deluxe</option>
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
                                <x-inputs.verticalFormLabel label="Charges" for="charges" suggestion="Enter the charges." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="charges" name="charges" placeholder="Enter Charges" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Closing Inventory" for="closing_inventory" suggestion="Enter the closing inventory." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="closing_inventory" name="closing_inventory" placeholder="Enter Closing Inventory" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Distance From Airport" for="distance_from_airport" suggestion="Select the distance from airport." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="distance_from_airport" for="distance_from_airport" placeholder="Select Distance From Airport">
                                    <option value="">Select</option>
                                    <option value="1km">1km</option>
                                    <option value="2km">2km</option>
                                    <option value="3km">3km</option>
                                    <option value="4km">4km</option>
                                    <option value="5km">5km</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Distance From Venue" for="distance_from_venue" suggestion="Select the distance from venue." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="distance_from_venue" for="distance_from_venue" placeholder="Select Distance From Venue">
                                    <option value="">Select</option>
                                    <option value="1km">1km</option>
                                    <option value="2km">2km</option>
                                    <option value="3km">3km</option>
                                    <option value="4km">4km</option>
                                    <option value="5km">5km</option>
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