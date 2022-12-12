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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Booking Status</span></th>
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
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Payment Method</span></th>
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
                        <td class="nk-tb-col tb-col-lg">{{ $booking->registration_date }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->room_type_name }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->guests }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->booking_date }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->check_in_date }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->check_out_date }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->booking_status }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->rate }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->nights }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->adults }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->childs }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->extra_bed }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->room_charges }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->extra_bed_rate }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->tax }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $booking->tax_percentage }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->amount }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->contact_person }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->contact_number }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->hotel_email }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->payment_method }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->payment_via }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->transaction_id }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->transaction_status }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->utr_number }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->settlement_date }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->cancellation_date }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->cancellation_charges }} </td>
                        <td class="nk-tb-col tb-col-lg text-right">{{ $booking->refundable_amount }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $booking->refund_date }} </td>
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
                                <x-inputs.select  size="sm" name="hotel_name" for="hotel_name" placeholder="Select Hotel Name">
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
                                <x-inputs.verticalFormLabel label="Room Type" for="room_type" suggestion="Select the room type." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="room_type" for="room_type" placeholder="Select Room Type">
                                    <option value="">Select</option>
                                    @forelse ($room_types as $roomType)
                                        <option 
                                        @if(isset($request->room_type) && $request->room_type == $roomType->id) selected @endif
                                        value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Guest Count" for="guest_count" suggestion="Enter the guest count." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="{{ isset($request->guest_count) ? $request->guest_count : '' }}" for="guest_count" name="guest_count" placeholder="Enter Guest Count" />
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
                                    <input type="text" value="{{ isset($request->check_in_date) ? $request->check_in_date : '' }}" class="form-control date-picker" id="check_in_date" placeholder="Check in Date" data-date-format="yyyy-mm-dd">
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
                                    <input type="text" value="{{ isset($request->check_out_date) ? $request->check_out_date : '' }}" class="form-control date-picker" id="check_out_date" placeholder="Check out Date" data-date-format="yyyy-mm-dd">
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
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Booking Recevied') selected  @endif
                                    value="Booking Recevied">Booking Recevied</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Payment Completed') selected  @endif
                                    value="Payment Completed">Payment Completed</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Booking Shared') selected  @endif
                                    value="Booking Shared">Booking Shared</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Confirmation Recevied') selected  @endif
                                    value="Confirmation Recevied">Confirmation Recevied</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Cancellation Requested') selected  @endif
                                    value="Cancellation Requested">Cancellation Requested</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Cancellation Approved') selected  @endif
                                    value="Cancellation Approved">Cancellation Approved</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Refund Requested') selected  @endif
                                    value="Refund Requested">Refund Requested</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Refund Approved') selected  @endif
                                    value="Refund Approved">Refund Approved</option>
                                    <option 
                                    @if(isset($request->booking_status) && $request->booking_status == 'Refund Issued') selected  @endif
                                    value="Refund Issued">Refund Issued</option>
                                </x-inputs.select>
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Adults" for="adults" suggestion="Enter the adults." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="{{ isset($request->adults) ? $request->adults : '' }}" for="adults" name="adults" placeholder="Enter Adults" />
                            </div>
                        </div>
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Child" for="child" suggestion="Enter the child." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.number  value="{{ isset($request->child) ? $request->child : '' }}" for="child" name="child" placeholder="Enter Child" />
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
            if($('#room_type').val() != ""){
                myUrl = addQSParm(myUrl,'room_type', $('#room_type').val());
            }
            if($('#guest_count').val() != ""){
                myUrl = addQSParm(myUrl,'guest_count', $('#guest_count').val());
            }
            if($('#check_in_date').val() != ""){
                myUrl = addQSParm(myUrl,'check_in_date', $('#check_in_date').val());
            }
            if($('#check_out_date').val() != ""){
                myUrl = addQSParm(myUrl,'check_out_date', $('#check_out_date').val());
            }
            if($('#booking_status').val() != ""){
                myUrl = addQSParm(myUrl,'booking_status', $('#booking_status').val());
            }
            if($('#adults').val() != ""){
                myUrl = addQSParm(myUrl,'adults', $('#adults').val());
            }
            if($('#child').val() != ""){
                myUrl = addQSParm(myUrl,'child', $('#child').val());
            }
            if($('#check_in_date').val() != ""){
                myUrl = addQSParm(myUrl,'check_in_date', $('#check_in_date').val());
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
    </script>
@endpush
