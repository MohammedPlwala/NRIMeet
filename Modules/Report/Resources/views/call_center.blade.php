@extends('admin.layouts.app')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Call Center</h3>
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
                                <a href="javascript::void(0)" data-href="{{ url('admin/report/call-center-export') }}" class="btn btn-primary export_data"><em
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
                <table id="sales_SP" class="products-init nowrap nk-tb-list is-separate" data-auto-responsive="false">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Case Id</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Case Date</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Details</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact Details</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email Id</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Call Process</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Category</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Sub Category</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Status</span></th>
                            <th class="nk-tb-col tb-col-mb"><span class="sub-text">Remarks</span></th>
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
                                    <x-inputs.verticalFormLabel label="Issue Date" for="date"
                                        suggestion="Select the issue date." />
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" value="{{ isset($request->date) ? $request->date : '' }}"
                                        class="form-control date-picker" id="date" name="date" placeholder="Issue Date"
                                        data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Method" for="method"
                                        suggestion="Select the contact method." />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select size="sm" name="method" for="method"
                                        placeholder="Select contact method"
                                        value="{{ isset($request->method) ? $request->method : '' }}">
                                        <option value="">Select</option>
                                        <option value="Email">Email</option>
                                        <option value="Call">Call</option>
                                        <option value="Whatsapp">Whatsapp</option>
                                        <option value="MEA">MEA</option>
                                        <option value="MPT">MPT</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Issue" for="issue"
                                        suggestion="Specify the Issue." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select  for="issue" icon="send" placeholder="Issue"
                                        name="issue" required="true"
                                        value="{{ isset($request) ? $request->issue : '' }}">
                                        <option value="">Select</option>
                                        <option value="Registration">Registration</option>
                                        <option value="Accommodation">Accommodation</option>
                                        <option value="Transportation">Transportation</option>
                                    </x-inputs.select>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Sub Issue" for="sub_issue"
                                        suggestion="Specify the Sub Issue." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="sub_issue" id="subIssue" icon="send"
                                        placeholder="Sub Issue" name="sub_issue" required="true"
                                        value="{{ isset($request) ? $request->sub_issue : '' }}">
                                        <option value="">Select</option>
                                        <option value="Login Issue">Login Issue</option>
                                        <option value="Payment Issue">Payment Issue</option>
                                        <option value="Profile Issue">Profile Issue</option>
                                        <option value="Password Issue">Password Issue</option>
                                    </x-inputs.select>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-5">
                                    <x-inputs.verticalFormLabel label="Status" for="status"
                                        suggestion="Specify the Status." required="true" />
                                </div>
                                <div class="col-lg-7">
                                    <x-inputs.select for="status" icon="send" placeholder="Status"
                                        name="status" required="true"
                                        value="{{ isset($request) ? $request->status : '' }}">
                                        <option value="">Select</option>
                                        <option value="Open">Open</option>
                                        <option value="On Hold">On Hold</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Resolved">Resolved</option>
                                        <option value="Pending">Pending</option>
                                    </x-inputs.select>
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
                                <button class="btn btn-primary submitBtn"  data-dismiss="modal" type="button">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footerScripts')
    <script src="{{ url('js/tableFlow.js') }}"></script>
    <script src="{{ url('js/dayjs.min.js?t=' . time()) }}"></script>
    <script type="text/javascript">
    $('.export_data').on('click', function(e) {
            var myUrl = $(this).attr('data-href');

            if ($('#date').val() != "") {
                myUrl = addQSParm(myUrl, 'date', $('#date').val());
            }
            if ($('#method').val() != "") {
                myUrl = addQSParm(myUrl, 'method', $('#method').val());
            }
            if ($('#issue').val() != "") {
                myUrl = addQSParm(myUrl, 'issue', $('#issue').val());
            }
            if ($('#sub_issue').val() != "") {
                myUrl = addQSParm(myUrl, 'sub_issue', $('#sub_issue').val());
            }
            if ($('#status').val() != "") {
                myUrl = addQSParm(myUrl, 'status', $('#status').val());
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

        var token = '{{ \Session::get('token') }}'; //get logged in user session.
        var organizationId = "{{ \Session::get('currentOrganization') }}";

        var items = [
            '#date',
            '#method',
            '#status',
            "#issue",
            "#sub_issue",
        ];
        var user_table = "";
        user_table = new CustomDataTable({
            tableElem: '#sales_SP',
            option: {
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: {
                    type: "GET",
                    url: "{{ url('admin/report/call-center') }}",
                },
                columns: [{
                        "class": "nk-tb-col tb-col-lg",
                        data: 'case_id',
                        name: 'case_id'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'date',
                        name: 'date'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'guest_name',
                        name: 'guest_name'
                    },


                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'contact',
                        name: 'contact'
                    },

                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'email',
                        name: 'email'
                    },


                    {
                        "class": "nk-tb-col tb-col-lg text-center",
                        data: 'method',
                        name: 'method'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'issue',
                        name: 'issue'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'sub_issue',
                        name: 'sub_issue'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'status',
                        name: 'status'
                    },
                    {
                        "class": "nk-tb-col tb-col-lg",
                        data: 'remark',
                        name: 'remark'
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
        var issues = {
            'Registration': [
                "Login Issue",
                "Payment Issue",
                "Profile Issue",
                "Password Issue",
            ],
            "Accommodation": [
                "General Information",
                "Hotel Details",
                "Hotel Price related issue",
                "Login Issue",
                "Payment Issue",
                "Hotel Booking",
                "Bookings changes",
                "Confirmation",
                "Cancellation",
                "Refund",
                "Invoice",
                "Compalint regarding Hotel",
                "Early Check in",
                "Late Check out",
                "Vegetarian food",
                "Nov-vegetarian food",
            ],
            "Transportation": [
                "Transportatin Booking",
                "Car Did not show up",
                "Car showed up late",
                "Change my booking",
                "What are the different modes of payment you support?",
                "Can I buy for someone else using my credit/debit card?",
                "Is it safe to use my credit/debit card on your site? Do you store my card number and details?",
                "How is the total fare/price calculated for a intercity car rental service?",
                "How is the total fare/price calculated for a local car rental service?",
                "What is local, transfer and outstation car rental?",
                "My Driver asked to cancle the ride",
                "Driver asked for extra money ",
                "My driver declined to go",
                "My Driver did not arrive for pickup",
                "Different drive came for pickup",
                "Driver was impolite",
                "Driver misbehaved",
                "Driver did not know the route",
                "Driver did not answer the call ",
                "I was charged cancellation fees incoreectly",
                "I need copy of my invoice ",
                "I was charged more then given fare",
                "Does my charges include toll / parking fees",
                "My payment failed ",
                "Driver stoppped the car midway ",
                "I missed my flight / train ",
                "Issue with cab quality",
                "Issue with cab cleaniness",
                "I left my belongings at the vehicle ",
            ]

        }
        $(document).ready(function() {
            $('#issue').on('change', function() {
                var subIssues = issues[$(this).val()]
                var option = '<option value="">select</option>'
                if(subIssues){
                    for (let index = 0; index < subIssues.length; index++) {
                    const val = subIssues[index];
                    option += '<option value="' + val + '">' + val + '</option>'
                }
                $('#sub_issue').html(option)
                }
                
            })
        });
    </script>
@endpush
