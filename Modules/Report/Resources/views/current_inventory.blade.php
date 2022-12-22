@extends('admin.layouts.app')
@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Current Inventory</h3>
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
                            <a  href="javascript::void(0)" data-href="{{ url('admin/report/current-inventory?type=export') }}" class="btn btn-primary export_data"><em class="icon ni ni-download"></em><span>Export</span></a>
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
                        <th class="nk-tb-col tb-col-mb text-left"><span class="sub-text">Hotel Name</span></th>
                        
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Room Type</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Alloted Rooms</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">MPT Reserve</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">06 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">07 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">08 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">09 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">10 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">11 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">12 JAN</span></th>
                        <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">13 JAN</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $key => $room)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col tb-col-lg">{{ $room->name }} </td>
                        <td class="nk-tb-col tb-col-lg">{{ $room->room_type_name }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->allocated_rooms }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->mpt_reserve }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->six }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->seven }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->eight }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->nine }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->ten }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->eleven }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->twelve }} </td>
                        <td class="nk-tb-col tb-col-lg text-center">{{ $room->thirteen }} </td>
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
                                <x-inputs.verticalFormLabel label="Room Type" for="room_type" suggestion="Select the room type." />
                            </div>
                            <div class="col-lg-7">
                                <x-inputs.select  size="sm" name="room_type" for="room_type" placeholder="Select Room Type">
                                    <option value="">Select</option>
                                    @forelse ($room_types as $roomType)
                                        <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
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
                            <button data-href="{{ url('admin/report/current-inventory') }}" class="btn btn-primary submitBtn" type="button">Submit</button>
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
                NioApp.setStatusTag(statusTagData)
            });
        })
    </script>
@endpush
