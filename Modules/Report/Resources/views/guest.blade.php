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
                            <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal" title="filter" data-target="#modalFilterorder">
                                <em class="icon ni ni-filter"></em><span>Filter</span>
                            </a>
                        </li>
                        <li class="nk-block-tools-opt">
                            <a href="javascript:void(0);" data-href="{{ url('admin/report/guest-export') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Whatsapp Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Billing Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">City</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">State</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Postal Code</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">User Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Registration Date</span></th>
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
                                <x-inputs.verticalFormLabel label="Name" for="name" suggestion="Enter the name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="name" name="name" placeholder="Name" />
                            </div>
                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Country / Region" for="Country / Region" suggestion="Specify the country name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select name="billing_country" for="billing_country"
                                value="{{ isset($user) ? $user->country : old('country') }}"
                                class="country_to_state country_select" autocomplete="country"
                                data-placeholder="Select a country / region???" data-label="Country / Region"
                                tabindex="-1" aria-hidden="true">
                                <option value="">Select a country / region???</option>
                            </x-inputs.select>
                            @if ($errors->has('country'))
                            <span class="text-danger">{{ $errors->first('country') }}</span>
                        @endif
                            </div>
                        </div>
                        <div class="row g-3" >
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="State" for="State" suggestion="Specify the nationality." />
                            </div>
                            <div class="col-lg-7">
                                <div id="field_billing_state">
                                    <x-inputs.text  value="" for="billing_state" name="billing_state" id="billing_state" placeholder="State" />
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="City" for="city" suggestion="Enter the city." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="city" name="city" id="city" placeholder="City" />
                            </div>
                        </div>
                        {{-- <div class="row g-3 align-center">
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
                        </div> --}}
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
                                <x-inputs.verticalFormLabel label="Registration Date" for="registration_date" suggestion="Enter the postal code." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="registration_date" name="registration_date" id="registration_date" placeholder="Registration Date" class="date-picker" />
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
                            <button class="btn btn-primary submitBtn" data-dismiss="modal" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('footerScripts')
<script src="{{url('js/address.js')}}"></script>

    <script src="{{url('js/tableFlow.js')}}"></script>
    <script type="text/javascript">
        // $('#registration_date').datepicker({ format: 'dd/mm/yyyy' });

        $('.export_data').on('click', function (e) {
            var myUrl = $(this).attr('data-href');

            if($('#name').val() != ""){
                myUrl = addQSParm(myUrl,'name', $('#name').val());
            }
            if($('#city').val() != ""){
                myUrl = addQSParm(myUrl,'city', $('#city').val());
            }
            if($('#billing_state').val() != ""){
                myUrl = addQSParm(myUrl,'billing_state', $('#billing_state').val());
            }
            if($('#postal_code').val() != ""){
                myUrl = addQSParm(myUrl,'postal_code', $('#postal_code').val());
            }
            if($('#billing_country').val() != ""){
                myUrl = addQSParm(myUrl,'billing_country', $('#billing_country').val());
            }
            if($('#registration_date').val() != ""){
                myUrl = addQSParm(myUrl,'registration_date', $('#registration_date').val());
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
                '#city',
                '#billing_state',
                '#billing_country',
                '#name',
                '#postal_code',
                '#registration_date'
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
                        url: "{{ url('admin/report/guest') }}",
                    },
                    columns: [
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'mobile',
                            name: 'mobile'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'email',
                            name: 'email'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'mobile',
                            name: 'mobile'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'address',
                            name: 'address'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'city',
                            name: 'city'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'state',
                            name: 'state'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'country',
                            name: 'country'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'zip',
                            name: 'zip'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'id',
                            name: 'id'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'registration_date',
                            name: 'registration_date'
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
