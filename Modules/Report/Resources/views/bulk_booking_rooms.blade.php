@extends('admin.layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Bulk Booking Rooms</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal"
                                    title="filter" data-target="#modalFilterorder">
                                    <em class="icon ni ni-filter"></em><span>Filter</span>
                                </a>
                            </li>
                            <li class="nk-block-tools-opt">
                                <a href="javascript::void(0)" data-href="{{ url('admin/report/bulk-booking-rooms-export') }}"
                                    class="btn btn-primary export_data"><em
                                        class="icon ni ni-download"></em><span>Export</span></a>
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
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking From</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Via</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Confirmation Number</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Designation</span></th>
                            <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Adult</span></th>
                            <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Child</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check In</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check Out</span></th>
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
                                    <x-inputs.verticalFormLabel label="Booking From" for="booking_from"
                                        suggestion="Enter the booking from." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="booking_from" icon="mail" required="true" class="readonlyinput"
                                        placeholder="Select Guest" name="booking_from" id="booking_from">
                                        <option value="">Select</option>
                                        <option @if (isset($request->booking_from) && $request->booking_from == 'MP Tourism') selected @endif>
                                            MP Tourism</option>
                                        <option @if (isset($request->booking_from) && $request->booking_from == 'MP GOVT') selected @endif>
                                            MP GOVT</option>
                                        <option @if (isset($request->booking_from) && $request->booking_from == 'YPBD') selected @endif>
                                            YPBD</option>
                                        <option @if (isset($request->booking_from) && $request->booking_from == 'MEA') selected @endif>
                                            MEA</option>

                                        <option @if (isset($request->booking_from) && $request->booking_from == 'AGI') selected @endif>
                                        AGI</option>

                                        <option @if (isset($request->booking_from) && $request->booking_from == 'Guest') selected @endif>
                                        Guest</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Booking Via" for="booking_via" suggestion="Enter the booking name." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.text  value="" for="booking_via" id="booking_via" name="booking_via" placeholder="Enter Booking Name" />
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Hotel Name" for="hotel_name"
                                        suggestion="Select the hotel name." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select size="sm" name="hotel_name" for="hotel_name"
                                        placeholder="Select Hotel Name" id="hotel_name">
                                        <option value="">Select</option>
                                        @forelse ($hotels as $hotel)
                                            <option @if (isset($request->hotel_name) && $request->hotel_name == $hotel->id) selected @endif
                                                value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                        @empty
                                            {{-- empty expr --}}
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Room Type" for="room_type"
                                        suggestion="Select the room type." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select size="sm" name="room_type" for="room_type"
                                        placeholder="Select Room Type" id="room_type">
                                        <option value="">Select</option>
                                        @forelse ($room_types as $roomType)
                                            <option @if (isset($request->room_type) && $request->room_type == $roomType->id) selected @endif
                                                value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                        @empty
                                            {{-- empty expr --}}
                                        @endforelse
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Check in Date" for="checkin_date"
                                        suggestion="Select the check in date." />
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" class="form-control date-picker" id="checkin_date"
                                            placeholder="Check in Date" data-date-format="yyyy-mm-dd" name="checkin_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Check out Date" for="checkout_date"
                                        suggestion="Select the check out date." />
                                </div>
                                <div class="col-lg-7">
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" class="form-control date-picker" id="checkout_date" name="checkout_date"
                                            placeholder="Check out Date" data-date-format="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="userId" name="user_id" value="0">
                    <div class="modal-footer bg-light">
                        <div class="row">
                            <div class="col-lg-12 p-0 text-right">
                                <button class="btn btn-outline-light" data-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button class="btn btn-danger resetFilter" data-dismiss="modal" aria-label="Close">Clear
                                    Filter</button>
                                <button class="btn btn-primary submitBtn" data-dismiss="modal"  type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footerScripts')
    <script src="{{ url('js/address.js') }}"></script>

    <script src="{{ url('js/tableFlow.js') }}"></script>
    <script type="text/javascript">
        $('.export_data').on('click', function(e) {
            var myUrl = $(this).attr('data-href');

            if ($('#booking_from').val() != "") {
                myUrl = addQSParm(myUrl, 'booking_from', $('#booking_from').val());
            }
            if ($('#booking_via').val() != "") {
                myUrl = addQSParm(myUrl, 'booking_via', $('#booking_via').val());
            }
            if ($('#hotel_name').val() != "") {
                myUrl = addQSParm(myUrl, 'hotel_name', $('#hotel_name').val());
            }
            if ($('#room_type').val() != "") {
                myUrl = addQSParm(myUrl, 'room_type', $('#room_type').val());
            }
            if ($('#checkin_date').val() != "") {
                myUrl = addQSParm(myUrl, 'checkin_date', $('#checkin_date').val());
            }
            if ($('#checkout_date').val() != "") {
                myUrl = addQSParm(myUrl, 'checkout_date', $('#checkout_date').val());
            }


            location.href = myUrl;
        });

        function addQSParm(myUrl, name, value) {
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
                '#booking_from',
                '#booking_via',
                '#hotel_name',
                '#room_type',
                '#checkin_date',
                '#checkout_date'
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
                        url: "{{ url('admin/report/bulk-booking-rooms') }}",
                    },
                    columns: [{
                            "class": "nk-tb-col tb-col-lg",
                            data: 'booking_person',
                            name: 'booking_person'
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
                            data: 'confirmation_number',
                            name: 'confirmation_number'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'guest_name',
                            name: 'guest_name'
                        },

                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'guest_designation',
                            name: 'guest_designation'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'adult_count',
                            name: 'adult_count'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg text-center",
                            data: 'child_count',
                            name: 'child_count'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'checkin_date',
                            name: 'checkin_date'
                        },
                        {
                            "class": "nk-tb-col tb-col-lg",
                            data: 'checkout_date',
                            name: 'checkout_date'
                        }
                    ],
                    
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
