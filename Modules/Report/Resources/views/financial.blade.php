@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Financial</h3>
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
                            <a href="{{ url('report/export-financial') }}" class="btn btn-primary"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">#</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Delegate Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount Paid by Delegate</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount received in Bank</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">No. of Rooms Booked</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">C/I Date</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">C/O Date</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Room Nights</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Total Due</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">75% Payment to Hotel</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Balance 25% to be Paid Amount</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">1</td>
                        <td class="nk-tb-col tb-col-mb">Sheraton Grand Palace Indore</td>
                        <td class="nk-tb-col tb-col-mb">5 Star Deluxe</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 50000</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 50000</td>
                        <td class="nk-tb-col tb-col-mb text-center">50</td>
                        <td class="nk-tb-col tb-col-mb text-center">20/11/2022</td>
                        <td class="nk-tb-col tb-col-mb text-center">20/11/2022</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 5000</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 10000</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 20000</td>
                    </tr>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">2</td>
                        <td class="nk-tb-col tb-col-mb">Sheraton Grand Palace Indore</td>
                        <td class="nk-tb-col tb-col-mb">5 Star Deluxe</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 50000</td>
                        <td class="nk-tb-col tb-col-mb">&#8377; 50000</td>
                        <td class="nk-tb-col tb-col-mb text-center">60</td>
                        <td class="nk-tb-col tb-col-mb text-center">20/11/2022</td>
                        <td class="nk-tb-col tb-col-mb text-center">20/11/2022</td>
                        <td class="nk-tb-col tb-col-mb text-center">5</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 5000</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 10000</td>
                        <td class="nk-tb-col tb-col-mb text-center">&#8377; 20000</td>
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
                                <x-inputs.verticalFormLabel label="Hotel Classification" for="hotel_classification" suggestion="Select the hotel classification." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="hotel_classification" for="hotel_classification" placeholder="Select Hotel Classification">
                                    <option value="">Select</option>
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
                                <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name" suggestion="Select the hotel name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" placeholder="Select Hotel Name">
                                    <option value="">Select</option>
                                    <option value="Sheraton Grand Palace Indore">Sheraton Grand Palace Indore</option>
                                    <option value="Kyriad Hotel">Kyriad Hotel</option>
                                    <!-- @for ($i = 2021; $i <= 2030; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor -->
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