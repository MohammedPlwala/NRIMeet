@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Guest</h3>
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
                            <a href="{{ url('report/export-guest') }}" class="btn btn-primary"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Salutation</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Whatsapp Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Billing Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">City</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">State</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Postal Code</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Registration Date</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">1</td>
                        <td class="nk-tb-col tb-col-mb">Mr</td>
                        <td class="nk-tb-col tb-col-mb">Rajpal Tyagi</td>
                        <td class="nk-tb-col tb-col-mb">965-2240 7422</td>
                        <td class="nk-tb-col tb-col-mb">test@gmail.com</td>
                        <td class="nk-tb-col tb-col-mb">965-2240 7422</td>
                        <td class="nk-tb-col tb-col-mb">asdfkas jfldls;afasdf;l asfl;akdsfs</td>
                        <td class="nk-tb-col tb-col-mb">Indore</td>
                        <td class="nk-tb-col tb-col-mb">M.P.</td>
                        <td class="nk-tb-col tb-col-mb">India</td>
                        <td class="nk-tb-col tb-col-mb">546255</td>
                        <td class="nk-tb-col tb-col-mb">04/11/2022</td>
                    </tr>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-mb">2</td>
                        <td class="nk-tb-col tb-col-mb">Mr</td>
                        <td class="nk-tb-col tb-col-mb">Rajpal Tyagi</td>
                        <td class="nk-tb-col tb-col-mb">965-2240 7422</td>
                        <td class="nk-tb-col tb-col-mb">test@gmail.com</td>
                        <td class="nk-tb-col tb-col-mb">965-2240 7422</td>
                        <td class="nk-tb-col tb-col-mb">asdfkas jfldls;afasdf;l asfl;akdsfs</td>
                        <td class="nk-tb-col tb-col-mb">Indore</td>
                        <td class="nk-tb-col tb-col-mb">M.P.</td>
                        <td class="nk-tb-col tb-col-mb">India</td>
                        <td class="nk-tb-col tb-col-mb">546255</td>
                        <td class="nk-tb-col tb-col-mb">04/11/2022</td>
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
                                <x-inputs.verticalFormLabel label="Salutation" for="salutation" suggestion="Enter the salutation." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="salutation" name="salutation" placeholder="Salutation" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="City" for="city" suggestion="Enter the city." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="city" name="city" placeholder="City" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="State" for="state" suggestion="Select the state." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="state" for="state" placeholder="Select State">
                                    <option value="">Select</option>
                                    <option value="State">State</option>
                                    <!-- @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ date('F',strtotime('2012-'.$i.'-12')) }}</option>
                                    @endfor -->
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Country" for="country" suggestion="Select the country." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="country" for="country" placeholder="Select Country">
                                    <option value="">Select</option>
                                    <option value="India">India</option>
                                    <!-- @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ date('F',strtotime('2012-'.$i.'-12')) }}</option>
                                    @endfor -->
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Postal Code" for="postal_code" suggestion="Enter the postal code." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="" for="postal_code" name="postal_code" placeholder="Postal Code" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Registration Date" for="registration_date" suggestion="Select the registration date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" id="registration_date" placeholder="Registration Date" data-date-format="yyyy-mm-dd">
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
            NioApp.getAuditLogs('.broadcast-init', '.audit_logs', 'resourceid', logUrl, '#modalLogs');

            var items = [
                '#room_name',
                '#hotel_name'
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
                        url: "{{ url('admin/hotel/rooms') }}",
                    },
                    columns: [
                        // {
                        //     "class": "nk-tb-col tb-col-lg nk-tb-col-check",
                        //     data: 'DT_RowIndex',
                        //     name: 'DT_RowIndex',
                        //     orderable: false,
                        //     searchable: false,
                        //     render: function(data, type, row, meta) {
                        //         return '<td class="nk-tb-col nk-tb-col-check"><div class="custom-control custom-control-sm custom-checkbox notext"><input type="checkbox" class="custom-control-input cb-check" id="cb-' +
                        //             row.id + '" value="' + row.id +
                        //             '" name="checked_items[]"><label class="custom-control-label" for="cb-' +
                        //             row.id + '"></label></div></td>'
                        //     }
                        // },
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
                            "class": "nk-tb-col tb-col-lg",
                            data: 'hotel_name',
                            name: 'hotel_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'rate',
                            name: 'rate'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'allocated_rooms',
                            name: 'allocated_rooms'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'mpt_reserve',
                            name: 'mpt_reserve'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'count',
                            name: 'count'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'status',
                            name: 'status'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
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
                filterItems: items,
                tagId: '#filter_tag_list',
            });



        });
    </script>
@endpush
