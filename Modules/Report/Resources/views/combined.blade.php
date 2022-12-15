@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Combined</h3>
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
                            <a  href="javascript::void(0)" data-href="{{ url('admin/report/combined?type=export') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Total Inventory</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Guest Name</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Contact</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Email Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Billing Address</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">City</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">State</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Postal Code</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">User Id</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Registration Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Guest Count</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check In</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Check Out</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Booking Status</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room / Night Charge</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Total Room Nights</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Adults</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Child</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Extra Bed</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Room Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Extra Bed Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">GST (Taxes)</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">GST (Tax%)</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Total Amount Paid</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Contact Person</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Contact No#</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Hotel Email-Id</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Payment Method</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Via</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Transaction Id</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Transaction Status</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">UTR No (If Any)</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Settlement Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Cancellation Date</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Cancellation Charges</span></th>
                        <th class="nk-tb-col tb-col-mb text-right"><span class="sub-text">Refundable Amount</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Refund Date</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Refund Transaction UTR</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $key => $booking)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-lg">{{ $booking->hotel }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->allocated_rooms }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->payment_id }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->guest_name }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->contact }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->email }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->billing_address }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->city }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->state }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->country }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->postal_code }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->user_id }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->registration_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->registration_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->room_type_name }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->guests }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->booking_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->booking_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->check_in_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->check_in_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->check_out_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->check_out_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg text-center"><span class="badge badge-success status-tag" data-status-name="{{ $booking->booking_status }}">{{ $booking->booking_status }}</span></td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->rate) </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->nights }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->adults }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->childs }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->extra_bed }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->room_charges) </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->extra_bed_rate) </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->tax) </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->tax_percentage }}% </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->amount) </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->contact_person }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->contact_number }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->hotel_email }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">
                            <span @if(isset($booking->payment_method) && $booking->payment_method == 'Online') class="badge badge-success" else class="badge badge-danger"  @endif>{{ $booking->payment_method }}</span>
                        </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->payment_via }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->transaction_id }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->transaction_status }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->utr_number }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->settlement_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->settlement_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->cancellation_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->cancellation_date)) : "-" }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->cancellation_charges) </td>
                        <td class="nk-tb-col tb-col-lg text-right">₹@convert($booking->refundable_amount) </td>
                        <td class="nk-tb-col tb-col-lg">{{ !is_null($booking->refund_date) ? date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($booking->refund_date)) : "-" }}</td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->refund_transaction_utr }} </td>
                    </tr>
                    @empty
                    @endforelse
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
                                <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" id="hotel_name" placeholder="Select Hotel Name">
                                    <option value="">Select</option>
                                    @forelse ($hotels as $hotel)
                                        <option 
                                        @if(isset($request->hotel_name) && $request->hotel_name == $hotel->name) selected @endif
                                        value="{{ $hotel->name }}">{{ $hotel->name }}</option>
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Guest Name" for="guest_name" suggestion="Enter the guest name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="{{ isset($request->guest_name) ? $request->guest_name : '' }}" for="guest_name" name="guest_name" id="guest_name" placeholder="Enter Guest Name" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Country Name" for="country" suggestion="Enter the country name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="{{ isset($request->country) ? $request->country : '' }}" for="country" name="country" id="country" placeholder="Enter Country Name" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="State Name" for="state" suggestion="Enter the state name." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="{{ isset($request->state) ? $request->state : '' }}" for="state" name="state" id="state" placeholder="Enter State Name" />
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
                                    <input type="text" value="{{ isset($request->registration_date) ? $request->registration_date : '' }}" class="form-control date-picker" id="registration_date" name="registration_date" placeholder="Registration Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Payment Via" for="payment_method" suggestion="Enter the payment method." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.text  value="" for="payment_method" id="payment_method" name="payment_method" placeholder="Enter Payment Method" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Payment Mode" for="payment_via" suggestion="Select the payment mode." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="payment_via" id="payment_via" for="payment_via" placeholder="Select Payment Mode">
                                    <option value="">Select</option>
                                    <option value="Online" @if(isset($request->payment_via) && $request->payment_via == 'Online') selected @endif>Online</option>
                                    <option value="Offline"  @if(isset($request->payment_via) && $request->payment_via == 'Offline') selected @endif>Offline</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Settlement Date" for="settlement_date" suggestion="Select the settlement date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" value="{{ isset($request->settlement_date) ? $request->settlement_date : '' }}" class="form-control date-picker" id="settlement_date" name="settlement_date" placeholder="Settlement Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Cancellation Date" for="cancellation_date" suggestion="Select the cancellation date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" value="{{ isset($request->cancellation_date) ? $request->cancellation_date : '' }}" class="form-control date-picker" id="cancellation_date" name="cancellation_date" placeholder="Cancellation Date" data-date-format="yyyy-mm-dd">
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Refundable Date" for="refundable_date" suggestion="Select the refundable date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" value="{{ isset($request->refundable_date) ? $request->refundable_date : '' }}" class="form-control date-picker" id="refundable_date" name="refundable_date" placeholder="Refundable Date" data-date-format="yyyy-mm-dd">
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
                            <button data-href="{{ url('admin/report/combined') }}" class="btn btn-primary submitBtn" type="button">Submit</button>
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

    {{-- <script src="{{url('js/tableFlow.js')}}"></script> --}}
    <script type="text/javascript">

        $('.resetFilter').on('click', function (e) {
            var myUrl = $('.submitBtn').attr('data-href');
            location.href = myUrl;
        });

        $('.export_data, .submitBtn').on('click', function (e) {
            var myUrl = $(this).attr('data-href');


            if($('#hotel_name').val() != ""){
                myUrl = addQSParm(myUrl,'hotel_name', $('#hotel_name').val());
            }
            if($('#guest_name').val() != ""){
                myUrl = addQSParm(myUrl,'guest_name', $('#guest_name').val());
            }
            if($('#country').val() != ""){
                myUrl = addQSParm(myUrl,'country', $('#country').val());
            }
            if($('#state').val() != ""){
                myUrl = addQSParm(myUrl,'state', $('#state').val());
            }
            if($('#registration_date').val() != ""){
                myUrl = addQSParm(myUrl,'registration_date', $('#registration_date').val());
            }
            if($('#payment_method').val() != ""){
                myUrl = addQSParm(myUrl,'payment_method', $('#payment_method').val());
            }
            if($('#payment_via').val() != ""){
                myUrl = addQSParm(myUrl,'payment_via', $('#payment_via').val());
            }
            if($('#settlement_date').val() != ""){
                myUrl = addQSParm(myUrl,'settlement_date', $('#settlement_date').val());
            }
            if($('#cancellation_date').val() != ""){
                myUrl = addQSParm(myUrl,'cancellation_date', $('#cancellation_date').val());
            }
            if($('#refundable_date').val() != ""){
                myUrl = addQSParm(myUrl,'refundable_date', $('#refundable_date').val());
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
        
        $('document').ready(function(){
            var statusTagCount = $('.status-tag').length;
            $('.status-tag').each(function( index, element ) {
                let statusTagData = $(this).attr('data-status-name');
                console.log('Get Status: ', statusTagData);
                // if(statusTagData == 'Payment Completed'){
                //     $('.status-tag[data-status-name="statusTagData"]').addClass('badge-suraj');
                // }
                // NioApp.setStatusTag(statusTagData)
            });
        })
    </script>
@endpush
