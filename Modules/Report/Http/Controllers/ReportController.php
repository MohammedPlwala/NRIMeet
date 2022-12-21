<?php

namespace Modules\Report\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use App\Models\User;
use Modules\User\Entities\UserRole;
use Modules\User\Entities\Role;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BulkBookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;
use Modules\Hotel\Entities\FailedTransaction;
use Modules\User\Entities\CustomerCare;

use Modules\Report\Exports\GuestExport;
use Modules\Report\Exports\BookingExport;
use Modules\Report\Exports\HotelMasterExport;
use Modules\Report\Exports\InventoryExport;
use Modules\Report\Exports\PaymentExport;
use Modules\Report\Exports\CancellationExport;
use Modules\Report\Exports\RefundExport;
use Modules\Report\Exports\TotalInventoryDataExport;
use Modules\Report\Exports\BookingSummaryExport;
use Modules\Report\Exports\BookingStatusExport;
use Modules\Report\Exports\PendingConfirmationExport;
use Modules\Report\Exports\CombinedExport;
use Modules\Report\Exports\BookingCheckInStatusExport;
use Modules\Report\Exports\BookingCheckOutStatusExport;
use Modules\Report\Exports\BulkBookingRoomExport;
use Modules\Report\Exports\CallCenterExport;
use Modules\Report\Exports\FailedPaymentExport;
use Modules\Report\Exports\BookingInventoryExport;


use DataTables;


class ReportController extends Controller
{

    public function guest(Request $request)
    {

        try {

            $data =   User::from('users as u')
                        ->select('u.*',\DB::raw('DATE_FORMAT(u.created_at, "%d-%b-%Y") as registration_date'))
                        ->leftJoin('user_role as ur','u.id','=','ur.user_id')
                        ->leftJoin('roles as r','ur.role_id','=','r.id')
                        ->where('r.name','Guest')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('name') != '') {
                                    $query->where('u.full_name', 'like', '%' . $request->name . '%');
                                }

                                if ($request->get('city') != '') {
                                    $query->where('u.city', $request->get('city'));
                                }

                                if ($request->get('billing_state') != '') {
                                    $query->where('u.state', $request->get('billing_state'));
                                }

                                if ($request->get('billing_country') != '') {
                                    $query->where('u.country', $request->get('billing_country'));
                                }

                                if ($request->get('postal_code') != '') {
                                    $query->where('u.zip', $request->get('postal_code'));
                                }
                                if ($request->get('registration_date') != '') {
                                    $query->whereDate('u.created_at', date('Y-m-d',strtotime($request->get('registration_date'))));
                                }
                            }
                        })
                        ->orderby('u.full_name','asc')
                        ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('registration_date', function ($row) {
                            $registration_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->registration_date));
                            return $registration_date;
                        })
                        ->addColumn('status', function ($row) {
                            if($row->status == 'active'){
                                $statusValue = 'Active';
                            }else{
                                $statusValue = 'Inactive';
                            }

                            $value = ($row->status == 'active') ? 'badge badge-success' : 'badge badge-danger';
                            $status = '
                                <span class="tb-sub">
                                    <span class="'.$value.'">
                                        '.$statusValue.'
                                    </span>
                                </span>
                            ';
                            return $status;
                        })
                        
                        ->rawColumns(['status'])
                        ->make(true);
            }

            return view('report::guest');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function guestExport(Request $request)
    {

        try {
            $guests =   User::from('users as u')
                        ->select('u.full_name','u.mobile','u.email','u.mobile as wa','u.address','u.city','u.state','u.country','u.zip','u.id as user_id',\DB::raw('DATE_FORMAT(u.created_at, "%d-%b-%Y") as registration_date'))
                        ->leftJoin('user_role as ur','u.id','=','ur.user_id')
                        ->leftJoin('roles as r','ur.role_id','=','r.id')
                        ->where('r.name','Guest')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('name') != '') {
                                    $query->where('u.full_name', 'like', '%' . $request->name . '%');
                                }

                                if ($request->get('city') != '') {
                                    $query->where('u.city', $request->get('city'));
                                }

                                if ($request->get('billing_state') != '') {
                                    $query->where('u.state', $request->get('billing_state'));
                                }

                                if ($request->get('billing_country') != '') {
                                    $query->where('u.country', $request->get('billing_country'));
                                }

                                if ($request->get('postal_code') != '') {
                                    $query->where('u.zip', $request->get('postal_code'));
                                }
                                if ($request->get('registration_date') != '') {
                                    $query->whereDate('u.created_at', date('Y-m-d',strtotime($request->get('registration_date'))));
                                }
                            }
                        })
                        ->orderby('u.full_name','asc')
                        ->get();

            if(!empty($guests->toArray())){
                return (new GuestExport($guests->toArray()))->download('guests' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function hotelMaster(Request $request)
    {
        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = \Helpers::hotels();

            
            $room_types = \Helpers::roomTypes();

            $data =   Hotel::from('hotels as h')
                        ->select('h.name','h.city','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.address','h.contact_number','h.description','rt.name as room_type','hr.allocated_rooms','hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate')
                        ->Join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                        ->join('room_types as rt','rt.id','=','hr.type_id')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', $request->get('hotel_name'));
                                }

                                if ($request->get('star_rating') != '') {
                                    $query->where('h.classification', $request->star_rating);
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }

                                if ($request->get('charges') != '') {
                                    if($request->get('charges') == 1){
                                        $query->whereBetween('hr.rate', [5000, 10000]);
                                    }elseif($request->get('charges') == 2){
                                        $query->whereBetween('hr.rate', [10000, 15000]);
                                    }elseif($request->get('charges') == 3){
                                        $query->whereBetween('hr.rate', [15000, 20000]);
                                    }elseif($request->get('charges') == 4){
                                        $query->where('hr.rate','>', 20000);
                                    }
                                }

                                if ($request->get('distance_from_airport') != '') {
                                    $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                                }

                                if ($request->get('distance_from_venue') != '') {
                                    $query->where('h.venue_distance','<=', $request->get('distance_from_venue'));
                                }

                                if ($request->get('closing_inventory') != '') {
                                    $query->where('hr.count', $request->get('closing_inventory'));
                                }
                            }
                        })
                        ->orderby('h.name','asc')
                        ->get();
                       

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('rate', function ($row) { 
                            return '₹'.number_format($row->rate, 2);
                        })
                        ->addColumn('extra_bed_rate', function ($row) { 
                            return '₹'.number_format($row->extra_bed_rate, 2);
                        })
                        ->rawColumns(['status',])
                        ->make(true);
            }
            return view('report::hotel_master', ["classifications" => $classifications, "room_types" => $room_types, 'hotels' => $hotels]);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function hotelMasterExport(Request $request)
    {

        try{

            $hotels =   Hotel::from('hotels as h')
                        ->select('h.classification','h.name','h.city','hr.name as hotel_type','hr.allocated_rooms','hr.rate','hr.extra_bed_rate','hr.count as available_rooms','h.contact_person','h.contact_number','h.description','h.airport_distance','h.venue_distance','h.address','h.website')
                        ->Join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', $request->get('hotel_name'));
                                }
                                if ($request->get('star_rating') != '') {
                                    $query->where('h.classification', $request->star_rating);
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }

                                if ($request->get('charges') != '') {
                                    if($request->get('charges') == 1){
                                        $query->whereBetween('hr.rate', [5000, 10000]);
                                    }elseif($request->get('charges') == 2){
                                        $query->whereBetween('hr.rate', [10000, 15000]);
                                    }elseif($request->get('charges') == 3){
                                        $query->whereBetween('hr.rate', [15000, 20000]);
                                    }elseif($request->get('charges') == 4){
                                        $query->where('hr.rate','>', 20000);
                                    }
                                }

                                if ($request->get('distance_from_airport') != '') {
                                    $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                                }

                                if ($request->get('distance_from_venue') != '') {
                                    $query->where('h.venue_distance','<=', $request->get('distance_from_venue'));
                                }

                                if ($request->get('closing_inventory') != '') {
                                    $query->where('hr.count', $request->get('closing_inventory'));
                                }
                            }
                        })
                        ->orderby('h.name','asc')
                        ->get();

            if(!empty($hotels->toArray())){
                return (new HotelMasterExport($hotels->toArray()))->download('hotels' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/hotel-master')->with('error', 'No hotels');
            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function booking(Request $request)
    {

        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = \Helpers::hotels();

            $room_types = \Helpers::roomTypes();

            $data = BookingRoom::from('booking_rooms as br')
                    ->select('b.id as booking_id','b.created_at as booked_on','br.id','u.full_name as guest_name','u.email','u.mobile','b.order_id','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs','br.extra_bed','br.amount','b.booking_status')
                    ->Join('bookings as b','b.id','=','br.booking_id')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('star_rating') != '') {
                                $query->where('h.classification', $request->star_rating);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('hr.type_id', $request->get('room_type'));
                            }

                            if ($request->get('guest_count') != '') {
                                $query->where('br.guests', $request->get('guest_count'));
                            }

                            if ($request->get('adults') != '') {
                                $query->where('br.adults', $request->get('adults'));
                            }

                            if ($request->get('child') != '') {
                                $query->where('br.childs', $request->get('child'));
                            }

                            if ($request->get('extra_bed') != '') {
                                $query->where('br.extra_bed', $request->get('extra_bed'));
                            }

                            if ($request->get('booking_status') != '') {
                                $query->where('b.booking_status', $request->get('booking_status'));
                            }

                            if ($request->get('country') != '') {
                                $query->where('u.country', $request->get('country'));
                            }

                            if ($request->get('postal_code') != '') {
                                $query->where('u.zip', $request->get('postal_code'));
                            }
                            if ($request->get('check_in_date') != '') {
                                $query->whereDate('b.check_in_date', date('Y-m-d', strtotime($request->get('check_in_date'))));
                            }
                            if ($request->get('check_out_date') != '') {
                                $query->whereDate('b.check_out_date', date('Y-m-d', strtotime($request->get('check_out_date'))));
                            }
                        }
                    })
                    ->orderby('booked_on','desc')
                    ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('order_id', function ($row) {
                            $detail_url = url('/').'/admin/report/booking/booking_detail/'.$row->booking_id;
                            return '<a href="'.$detail_url.'">'.$row->order_id.'</a>';
                        })
                        ->addColumn('booked_on', function ($row) {
                            $booked_on = date(\Config::get('constants.DATE.DATE_FORMAT_FULL') , strtotime($row->booked_on));
                            return $booked_on;
                        })
                        ->addColumn('check_in_date', function ($row) {
                            $check_in_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_in_date));
                            return $check_in_date;
                        })
                        ->addColumn('check_out_date', function ($row) {
                            $check_out_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_out_date));
                            return $check_out_date;
                        })
                        ->addColumn('booking_status', function ($row) {
                            $booking_status_class = 'success';
                            if($row->booking_status == 'Booking Received'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Payment Completed'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Booking Shared'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Confirmation Recevied'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Cancellation Requested'){
                                $booking_status_class = 'warning';
                            }
                            if($row->booking_status == 'Cancellation Approved'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Refund Requested'){
                                $booking_status_class = 'warning';
                            }
                            if($row->booking_status == 'Refund Approved'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Refund Issued'){
                                $booking_status_class = 'danger';
                            }
                            $booking_status = '<span class="badge badge-'.$booking_status_class.'" >'. $row->booking_status .'</span>';
                            return $booking_status;
                        })
                        ->addColumn('amount', function ($row) { 
                            return '₹'.number_format($row->amount, 2);
                        })
                        ->rawColumns(['order_id', 'booking_status'])
                        ->make(true);
            }

            return view('report::booking', ["classifications" => $classifications, "room_types" => $room_types, 'hotels' => $hotels]);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingExport(Request $request)
    {
        try{

            $bookings = BookingRoom::from('booking_rooms as br')
                    ->select(
                        \DB::raw('DATE_FORMAT(b.created_at, "%d-%b-%Y") as booked_on'),
                        'b.order_id','u.full_name as guest_name','u.email','u.mobile','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','b.booking_status','br.adults','br.childs','br.extra_bed','br.amount')
                    ->Join('bookings as b','b.id','=','br.booking_id')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('star_rating') != '') {
                                $query->where('h.classification', $request->star_rating);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('hr.type_id', $request->get('room_type'));
                            }

                            if ($request->get('guest_count') != '') {
                                $query->where('br.guests', $request->get('guest_count'));
                            }

                            if ($request->get('adults') != '') {
                                $query->where('br.adults', $request->get('adults'));
                            }

                            if ($request->get('child') != '') {
                                $query->where('br.childs', $request->get('child'));
                            }

                            if ($request->get('extra_bed') != '') {
                                $query->where('br.extra_bed', $request->get('extra_bed'));
                            }

                            if ($request->get('booking_status') != '') {
                                $query->where('b.booking_status', $request->get('booking_status'));
                            }

                            if ($request->get('country') != '') {
                                $query->where('u.country', $request->get('country'));
                            }

                            if ($request->get('postal_code') != '') {
                                $query->where('u.zip', $request->get('postal_code'));
                            }
                        }
                    })
                    ->orderby('u.full_name','asc')
                    ->get();

            if(!empty($bookings->toArray())){
                return (new BookingExport($bookings->toArray()))->download('bookings' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/booking')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingDetail($id)
    {
        $booking_detail = Booking::from('bookings as b')->select('b.order_id','b.booking_type','b.created_at as booking_date','u.full_name as guest_name','u.email as guest_email','u.mobile as guest_contact','u.country as guest_country','u.registration_delegate_category as guest_category','h.classification as hotel_rating','h.name as hotel','rt.name as room_type','b.check_in_date','b.check_out_date','b.nights','b.amount as total_charge','b.special_request','b.confirmation_number','b.booking_status','t.payment_method','t.payment_mode','t.transaction_id','t.status','b.utr_number','b.settlement_date','b.settlement_id','t.created_at as payment_date','b.cancellation_request_date','b.cancellation_date','b.cancellation_charges','b.refund_request_date','b.refund_date','b.refundable_amount','b.refund_transaction_utr','u.registration_name','u.registration_email','u.registration_contact','u.registration_country','b.email_receipt','b.payment_receipt')->leftjoin('users as u','b.user_id','u.id')->leftjoin('hotels as h','b.hotel_id','h.id')->leftjoin('booking_rooms as br','b.id','br.booking_id')->leftjoin('hotel_rooms as hr','br.room_id','hr.id')->leftjoin('room_types as rt','rt.id','hr.type_id')->leftjoin('transactions as t','t.booking_id','b.id')->where('b.id',$id)->first();

        $bookingRooms = BookingRoom::from('booking_rooms as br')
                    ->select('br.*','hr.rate','rt.name as room_type')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->leftJoin('room_types as rt','hr.type_id','=','rt.id')
                    ->where('br.booking_id',$id)
                    ->get();
        // dd($bookingRooms);
        return view('report::bookingDetail', ["booking_detail" => $booking_detail, "bookingRooms" => $bookingRooms]);
    }

    public function inventory(Request $request)
    {

        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = \Helpers::hotels();

            
            $room_types = \Helpers::roomTypes();

            $data =   Hotel::from('hotels as h')
                        ->select('h.name','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.contact_number','h.address','h.contact_number','h.description','hr.allocated_rooms', 'hr.mpt_reserve' ,'hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate','rt.name as room_type_name',
                            \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as mea_rooms'),
                            \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                            \DB::Raw('COALESCE((select sum(booking_rooms.amount) from booking_rooms where booking_rooms.room_id = hr.id ),0) as total_booking'),
                        )
                        ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                        ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', $request->get('hotel_name'));
                                }

                                if ($request->get('star_rating') != '') {
                                    $query->where('h.classification', $request->star_rating);
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }
                                
                                

                                if ($request->get('room_charges') != '') {
                                    if($request->get('room_charges') == 1){
                                        $query->whereBetween('hr.rate', [5000, 10000]);
                                    }elseif($request->get('room_charges') == 2){
                                        $query->whereBetween('hr.rate', [10000, 15000]);
                                    }elseif($request->get('room_charges') == 3){
                                        $query->whereBetween('hr.rate', [15000, 20000]);
                                    }elseif($request->get('room_charges') == 4){
                                        $query->where('hr.rate','>', 20000);
                                    }
                                }

                                if ($request->get('distance_from_airport') != '') {
                                    $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                                }

                                if ($request->get('distance_from_venue') != '') {
                                    $query->where('h.venue_distance','<=', $request->get('distance_from_venue'));
                                }

                                if ($request->get('closing_inventory') != '') {
                                    $query->where('hr.count', $request->get('closing_inventory'));
                                }

                                if ($request->get('status') != '') {
                                    $query->where('hr.status', $request->get('status'));
                                }
                            }
                        })
                        ->orderby('h.name','asc')
                        ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('opening_room', function ($row) {
                            return $opening_room = $row->allocated_rooms-$row->mpt_reserve;
                        })
                        ->addColumn('rate', function ($row) { 
                            return '₹'.number_format($row->rate, 2);
                        })
                        ->addColumn('extra_bed_rate', function ($row) { 
                            return '₹'.number_format($row->extra_bed_rate, 2);
                        })
                        ->addColumn('total_booking', function ($row) { 
                            return '₹'.number_format($row->total_booking, 2);
                        })
                        ->rawColumns(['opening_room'])
                        ->make(true);
            }
            return view('report::inventory', ["classifications" => $classifications, "room_types" => $room_types, 'hotels' => $hotels]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function inventoryExport(Request $request)
    {
        try{

            $inventory =   Hotel::from('hotels as h')
                        ->select(
                            'h.name','h.classification','rt.name as room_type_name','hr.allocated_rooms', 'hr.mpt_reserve',
                            \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as mea_rooms'),
                            \DB::Raw('hr.allocated_rooms-hr.mpt_reserve as opening_room'),
                            'hr.rate','hr.extra_bed_rate',
                            \DB::Raw('COALESCE((select sum(booking_rooms.amount) from booking_rooms where booking_rooms.room_id = hr.id ),0) as total_booking'),
                            \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                            'hr.count as available_rooms','h.contact_person','h.contact_number'
                        )
                        ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                        ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', $request->get('hotel_name'));
                                }

                                if ($request->get('star_rating') != '') {
                                    $query->where('h.classification', $request->star_rating);
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }

                                if ($request->get('room_charges') != '') {
                                    if($request->get('room_charges') == 1){
                                        $query->whereBetween('hr.rate', [5000, 10000]);
                                    }elseif($request->get('room_charges') == 2){
                                        $query->whereBetween('hr.rate', [10000, 15000]);
                                    }elseif($request->get('room_charges') == 3){
                                        $query->whereBetween('hr.rate', [15000, 20000]);
                                    }elseif($request->get('room_charges') == 4){
                                        $query->where('hr.rate','>', 20000);
                                    }
                                }

                                if ($request->get('room_charges') != '') {
                                    $query->where('hr.rate', $request->get('room_charges'));
                                }                           

                                if ($request->get('closing_inventory') != '') {
                                    $query->where('hr.count', $request->get('closing_inventory'));
                                }
                                if ($request->get('status') != '') {
                                    $query->where('hr.status', $request->get('status'));
                                }
                            }
                        })
                        ->orderby('h.name','asc')
                        ->get();

            if(!empty($inventory->toArray())){
                return (new InventoryExport($inventory->toArray()))->download('inventory' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function payment(Request $request)
    {
        try{

            $data =     Booking::from('bookings as b')
                        ->select('b.order_id','u.full_name as guest',\DB::raw('DATE_FORMAT(b.created_at, "%d-%b-%Y") as booking_date'),
                            \DB::raw('DATE_FORMAT(t.created_at, "%d-%b-%Y") as payment_date'),'bd.city','bd.country', 'h.name as hotel',
                            \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                            \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                            'b.tax','b.amount','b.booking_status','t.payment_mode','t.payment_method','t.transaction_id','b.settlement_id',
                            \DB::raw('DATE_FORMAT(b.settlement_date, "%d-%b-%Y") as settlement_date'),
                            'b.utr_number'
                        )
                        ->leftJoin('transactions as t','b.id','=','t.booking_id')
                        ->leftJoin('users as u','u.id','=','b.user_id')
                        ->leftJoin('billing_details as bd','b.id','=','bd.booking_id')
                        ->leftJoin('hotels as h','b.hotel_id','=','h.id')
                        // ->where('booking_type','Online')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('booking_date') != '') {
                                    $query->whereDate('b.created_at', date('Y-m-d', strtotime($request->booking_date)));
                                }
                                if ($request->get('payment_date') != '') {
                                    $query->whereDate('t.created_at', date('Y-m-d', strtotime($request->payment_date)));
                                }
                                if ($request->get('country_name') != '') {
                                    $query->where('bd.country', 'like', '%' . $request->country_name.'%');
                                }
                                if ($request->get('city_name') != '') {
                                    $query->where('bd.city', 'like', '%' . $request->city_name.'%');
                                }
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', 'like', '%' . $request->hotel_name.'%');
                                }                         

                                if ($request->get('status') != '') {
                                    $query->where('b.booking_status', $request->get('status'));
                                }
                                if ($request->get('payment_method') != '') {
                                    $query->where('t.payment_method', $request->payment_method);
                                }
                                if ($request->get('payment_via') != '') {
                                    $query->where('t.payment_mode', 'like', '%' . $request->payment_via.'%');
                                }
                                if ($request->get('settlement_date') != '') {
                                    $query->whereDate('b.settlement_date', date('Y-m-d', strtotime($request->settlement_date)));
                                }
                            }
                        })
                        ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('booking_date', function ($row) {
                            $booking_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->booking_date));
                            return $booking_date;
                        })
                        ->addColumn('payment_date', function ($row) {
                            $payment_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->payment_date));
                            return $payment_date;
                        })
                        ->addColumn('tax', function ($row) { 
                            return '₹'.number_format($row->tax, 2);
                        })
                        ->addColumn('amount', function ($row) { 
                            return '₹'.number_format($row->amount, 2);
                        })
                        ->addColumn('booking_status', function ($row) {
                            $booking_status_class = 'success';
                            if($row->booking_status == 'Booking Received'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Payment Completed'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Booking Shared'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Confirmation Recevied'){
                                $booking_status_class = 'info';
                            }
                            if($row->booking_status == 'Cancellation Requested'){
                                $booking_status_class = 'warning';
                            }
                            if($row->booking_status == 'Cancellation Approved'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Refund Requested'){
                                $booking_status_class = 'warning';
                            }
                            if($row->booking_status == 'Refund Approved'){
                                $booking_status_class = 'success';
                            }
                            if($row->booking_status == 'Refund Issued'){
                                $booking_status_class = 'danger';
                            }
                            $booking_status = '<span class="badge badge-'.$booking_status_class.'" >'. $row->booking_status .'</span>';
                            return $booking_status;
                        })
                        ->addColumn('payment_mode', function ($row) {
                            $payment_mode_class = 'success';
                            if($row->payment_mode == 'Online'){
                                $payment_mode_class = 'success';
                            }
                            if($row->payment_mode == 'Offline'){
                                $payment_mode_class = 'danger';
                            }
                            $payment_mode = '<span class="badge badge-'.$payment_mode_class.'" >'. $row->payment_mode .'</span>';
                            return $payment_mode;
                        })
                        ->addColumn('settlement_date', function ($row) {
                            $settlement_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->settlement_date));
                            return $settlement_date;
                        })
                        ->rawColumns(['status', 'booking_status', 'payment_mode'])
                        ->make(true);
            }
            return view('report::payment');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function paymentExport(Request $request)
    {
        try{

            $payments = Booking::from('bookings as b')
                        ->select('u.full_name as guest','b.order_id',

                            \DB::raw('DATE_FORMAT(b.created_at, "%d-%b-%Y") as booking_date'),
                            \DB::raw('DATE_FORMAT(t.created_at, "%d-%b-%Y") as payment_date'),
                            'bd.city','bd.country', 'h.name as hotel',
                            \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                            \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                            'b.tax','b.amount','b.booking_status','t.payment_mode','t.payment_method','t.transaction_id','b.settlement_id',
                            \DB::raw('DATE_FORMAT(b.settlement_date, "%d-%b-%Y") as settlement_date'),
                            'b.utr_number'
                        )
                        ->leftJoin('transactions as t','b.id','=','t.booking_id')
                        ->leftJoin('users as u','u.id','=','b.user_id')
                        ->leftJoin('billing_details as bd','b.id','=','bd.booking_id')
                        ->leftJoin('hotels as h','b.hotel_id','=','h.id')
                        // ->where('booking_type','Online')
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('booking_date') != '') {
                                    $query->whereDate('b.created_at', date('Y-m-d', strtotime($request->booking_date)));
                                }
                                if ($request->get('payment_date') != '') {
                                    $query->whereDate('t.created_at', date('Y-m-d', strtotime($request->payment_date)));
                                }
                                if ($request->get('country_name') != '') {
                                    $query->where('bd.country', 'like', '%' . $request->country_name.'%');
                                }
                                if ($request->get('city_name') != '') {
                                    $query->where('bd.city', 'like', '%' . $request->city_name.'%');
                                }
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', 'like', '%' . $request->hotel_name.'%');
                                }                         

                                if ($request->get('status') != '') {
                                    $query->where('b.booking_status', $request->get('status'));
                                }
                                if ($request->get('payment_method') != '') {
                                    $query->where('t.payment_mode', $request->payment_method);
                                }
                                if ($request->get('payment_via') != '') {
                                    $query->where('t.payment_method', 'like', '%' . $request->payment_via.'%');
                                }
                                if ($request->get('settlement_date') != '') {
                                    $query->whereDate('b.settlement_date', date('Y-m-d', strtotime($request->settlement_date)));
                                }
                            }
                        })
                        ->get();

            
            if(!empty($payments->toArray())){
                return (new PaymentExport($payments->toArray()))->download('payments' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function cancellation(Request $request)
    {
        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $roomTypes = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();


            $data =   BookingRoom::from('booking_rooms as br')
            ->select(
                'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
                'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
                'br.childs','br.extra_bed','br.amount','b.booking_status','b.cancellation_request_date','b.cancellation_date'
            )
            ->leftJoin('bookings as b','br.booking_id','=','b.id')
            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
            ->leftJoin('hotel_rooms as hr','hr.id','=','br.room_id')
            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
            ->leftjoin('users as u','u.id','=','b.user_id')
            ->where(function ($query) use ($request) {
                if (!empty($request->toArray())) {

                    if ($request->get('hotel_name') != '') {
                        $query->where('h.name', $request->get('hotel_name'));
                    }

                    if ($request->get('star_rating') != '') {
                        $query->where('h.classification', $request->star_rating);
                    }

                    if ($request->get('room_type') != '') {
                        $query->where('hr.type_id', $request->get('room_type'));
                    }

                    if ($request->get('guest_count') != '') {
                        $query->where('br.guests', $request->get('guest_count'));
                    }

                    if ($request->get('check_in_date') != '') {
                        $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                    }

                    if ($request->get('check_out_date') != '') {
                        $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                    }

                    if ($request->get('cancellation_request_date') != '') {
                        $query->whereDate('b.cancellation_request_date', date('Y-m-d',strtotime($request->get('cancellation_request_date'))));
                    }
                    if ($request->get('cancellation_approved_date') != '') {
                        $query->whereDate('b.cancellation_date', date('Y-m-d',strtotime($request->get('cancellation_approved_date'))));
                    }

                    if ($request->get('booking_status') != '') {
                        $query->where('b.booking_status', $request->get('booking_status'));
                    } else {
                        $query->whereIn('b.booking_status', ['Cancellation Approved', 'Cancellation Requested', 'Refund Requested', 'Refund Approved', 'Refund Issued']);
                    }
                } else {
                    $query->whereIn('b.booking_status', ['Cancellation Approved', 'Cancellation Requested', 'Refund Requested', 'Refund Approved', 'Refund Issued']);
                }
                
            })
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check_in_date', function ($row) {
                        $check_in_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_in_date));
                        return $check_in_date;
                    })
                    ->addColumn('check_out_date', function ($row) {
                        $check_out_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_out_date));
                        return $check_out_date;
                    })
                    ->addColumn('cancellation_request_date', function ($row) {
                        $cancellation_request_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->cancellation_request_date));
                        return $cancellation_request_date;
                    })
                    ->addColumn('cancellation_date', function ($row) {
                        $cancellation_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->cancellation_date));
                        return $cancellation_date;
                    })
                    ->addColumn('amount', function ($row) { 
                        return '₹'.number_format($row->amount, 2);
                    })
                    ->rawColumns(['status'])
                    ->make(true);
            }

            return view('report::cancellation', ['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request, 'classifications' => $classifications]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function cancellationExport(Request $request){

        try{

            $cancellation =   BookingRoom::from('booking_rooms as br')
            ->select(
                'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
                'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
                'br.childs','br.extra_bed','br.amount','b.booking_status','b.cancellation_request_date','b.cancellation_date'
            )
            ->leftJoin('bookings as b','br.booking_id','=','b.id')
            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
            ->leftJoin('hotel_rooms as hr','hr.id','=','br.room_id')
            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
            ->leftjoin('users as u','u.id','=','b.user_id')
            ->where(function ($query) use ($request) {
                if (!empty($request->toArray())) {

                    if ($request->get('hotel_name') != '') {
                        $query->where('h.name', $request->get('hotel_name'));
                    }

                    if ($request->get('star_rating') != '') {
                        $query->where('h.classification', $request->star_rating);
                    }

                    if ($request->get('room_type') != '') {
                        $query->where('hr.type_id', $request->get('room_type'));
                    }

                    if ($request->get('guest_count') != '') {
                        $query->where('br.guests', $request->get('guest_count'));
                    }

                    if ($request->get('check_in_date') != '') {
                        $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                    }

                    if ($request->get('check_out_date') != '') {
                        $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                    }

                    if ($request->get('adult') != '') {
                        $query->where('br.adults', $request->get('adult'));
                    }
                    if ($request->get('child') != '') {
                        $query->where('br.childs', $request->get('child'));
                    }
                    if ($request->get('extra_bed') != '') {
                        $query->where('br.extra_bed', $request->get('extra_bed'));
                    }

                    if ($request->get('booking_status') != '') {
                        $query->where('b.booking_status', $request->get('booking_status'));
                    } else {
                        $query->whereIn('b.booking_status', ['Cancellation Approved', 'Cancellation Requested', 'Refund Requested', 'Refund Approved', 'Refund Issued']);
                    }
                } else {
                    $query->whereIn('b.booking_status', ['Cancellation Approved', 'Cancellation Requested', 'Refund Requested', 'Refund Approved', 'Refund Issued']);
                }
                
            })
            ->get();

            if(!empty($cancellation->toArray())){
                return (new CancellationExport($cancellation->toArray()))->download('cancellation' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function refund(Request $request)
    {

        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $roomTypes = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();


            $data =   BookingRoom::from('booking_rooms as br')
            ->select(
                'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
                'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
                'br.childs','br.extra_bed','br.amount','b.booking_status','b.refund_request_date','b.refund_date','br.refundable_amount','b.refund_transaction_utr'
            )
            ->leftJoin('bookings as b','br.booking_id','=','b.id')
            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
            ->leftJoin('hotel_rooms as hr','hr.id','=','br.room_id')
            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
            ->leftjoin('users as u','u.id','=','b.user_id')
            ->where(function ($query) use ($request) {
                if (!empty($request->toArray())) {

                    if ($request->get('hotel_name') != '') {
                        $query->where('h.name', $request->get('hotel_name'));
                    }

                    if ($request->get('star_rating') != '') {
                        $query->where('h.classification', $request->star_rating);
                    }

                    if ($request->get('room_type') != '') {
                        $query->where('hr.type_id', $request->get('room_type'));
                    }

                    if ($request->get('guest_count') != '') {
                        $query->where('br.guests', $request->get('guest_count'));
                    }

                    if ($request->get('check_in_date') != '') {
                        $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                    }

                    if ($request->get('check_out_date') != '') {
                        $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                    }

                    if ($request->get('refund_request_date') != '') {
                        $query->whereDate('b.refund_request_date', date('Y-m-d',strtotime($request->get('refund_request_date'))));
                    }

                    if ($request->get('refund_date') != '') {
                        $query->whereDate('b.refund_date', date('Y-m-d',strtotime($request->get('refund_date'))));
                    }

                    if ($request->get('adult') != '') {
                        $query->where('br.adults', $request->get('adult'));
                    }
                    if ($request->get('child') != '') {
                        $query->where('br.childs', $request->get('child'));
                    }
                    if ($request->get('extra_bed') != '') {
                        $query->where('br.extra_bed', $request->get('extra_bed'));
                    }

                    if ($request->get('booking_status') != '') {
                        $query->where('b.booking_status', $request->get('booking_status'));
                    } else {
                        $query->whereIn('b.booking_status', ['Refund Requested', 'Refund Approved', 'Refund Issued']);
                    }
                } else {
                    $query->whereIn('b.booking_status', ['Refund Requested', 'Refund Approved', 'Refund Issued']);
                }
                
            })
            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('check_in_date', function ($row) {
                        $check_in_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_in_date));
                        return $check_in_date;
                    })
                    ->addColumn('check_out_date', function ($row) {
                        $check_out_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_out_date));
                        return $check_out_date;
                    })
                    ->addColumn('refund_request_date', function ($row) {
                        $refund_request_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->refund_request_date));
                        return $refund_request_date;
                    })
                    ->addColumn('refund_date', function ($row) {
                        $refund_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->refund_date));
                        return $refund_date;
                    })
                    ->addColumn('amount', function ($row) { 
                        return '₹'.number_format($row->amount, 2);
                    })
                    ->addColumn('refundable_amount', function ($row) { 
                        return '₹'.number_format($row->refundable_amount, 2);
                    })
                    ->rawColumns(['status'])
                    ->make(true);
            }

            return view('report::refund', ['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request, 'classifications' => $classifications]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function refundExport(Request $request){

        try{

            $refund =   BookingRoom::from('booking_rooms as br')
            ->select(
                'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
                'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
                'br.childs','br.extra_bed','br.amount','b.booking_status','b.refund_request_date'
                ,'b.refund_date'
                ,'br.refundable_amount'
                ,'b.refund_transaction_utr'
            )
            ->leftJoin('bookings as b','br.booking_id','=','b.id')
            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
            ->leftJoin('hotel_rooms as hr','hr.id','=','br.room_id')
            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
            ->leftjoin('users as u','u.id','=','b.user_id')
            ->where(function ($query) use ($request) {
                if (!empty($request->toArray())) {

                    if ($request->get('hotel_name') != '') {
                        $query->where('h.name', $request->get('hotel_name'));
                    }

                    if ($request->get('star_rating') != '') {
                        $query->where('h.classification', $request->star_rating);
                    }

                    if ($request->get('room_type') != '') {
                        $query->where('hr.type_id', $request->get('room_type'));
                    }

                    if ($request->get('guest_count') != '') {
                        $query->where('br.guests', $request->get('guest_count'));
                    }

                    if ($request->get('check_in_date') != '') {
                        $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                    }

                    if ($request->get('check_out_date') != '') {
                        $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                    }

                    if ($request->get('refund_request_date') != '') {
                        $query->whereDate('b.refund_request_date', date('Y-m-d',strtotime($request->get('refund_request_date'))));
                    }

                    if ($request->get('refund_date') != '') {
                        $query->whereDate('b.refund_date', date('Y-m-d',strtotime($request->get('refund_date'))));
                    }

                    if ($request->get('adult') != '') {
                        $query->where('br.adults', $request->get('adult'));
                    }
                    if ($request->get('child') != '') {
                        $query->where('br.childs', $request->get('child'));
                    }
                    if ($request->get('extra_bed') != '') {
                        $query->where('br.extra_bed', $request->get('extra_bed'));
                    }

                    if ($request->get('booking_status') != '') {
                        $query->where('b.booking_status', $request->get('booking_status'));
                    } else {
                        $query->whereIn('b.booking_status', ['Refund Requested', 'Refund Approved', 'Refund Issued']);
                    }
                } else {
                    $query->whereIn('b.booking_status', ['Refund Requested', 'Refund Approved', 'Refund Issued']);
                }
                
            })
            ->get();

            if(!empty($refund->toArray())){
                return (new RefundExport($refund->toArray()))->download('refund' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }
    
    public function totalInventoryData(Request $request)
    {

        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $roomTypes = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();


            $data =    HotelRoom::from('hotel_rooms as hr')
                            ->select(
                                'h.classification','h.name','rt.name as room_type_name','hr.allocated_rooms', 

                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as mea_rooms'),


                                'hr.mpt_reserve','hr.count as available_rooms',
                                
                            )
                            ->join('hotels as h','hr.hotel_id','=','h.id')
                            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')

                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {

                                    if ($request->get('hotel_name') != '') {
                                        $query->where('h.name', $request->get('hotel_name'));
                                    }

                                    if ($request->get('star_rating') != '') {
                                        $query->where('h.classification', 'like', '%' . $request->star_rating.'%');
                                    }

                                    if ($request->get('room_type') != '') {
                                        $query->where('hr.type_id', $request->get('room_type'));
                                    }
                                }
                                
                            })

                            ->orderby('h.name','asc')
                            ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->make(true);
            }

            return view('report::total_inventory_data',['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request, 'classifications' => $classifications]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function totalInventoryDataExport(Request $request)
    {
        try{

            $data =    HotelRoom::from('hotel_rooms as hr')
                            ->select(
                                'h.classification','h.name','rt.name as room_type_name','hr.allocated_rooms', 

                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as mea_rooms'),


                                'hr.mpt_reserve','hr.count as available_rooms',
                                
                            )
                            ->join('hotels as h','hr.hotel_id','=','h.id')
                            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')

                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {

                                    if ($request->get('hotel_name') != '') {
                                        $query->where('h.name', $request->get('hotel_name'));
                                    }

                                    if ($request->get('star_rating') != '') {
                                        $query->where('h.classification', 'like', '%' . $request->star_rating.'%');
                                    }

                                    if ($request->get('room_type') != '') {
                                        $query->where('hr.type_id', $request->get('room_type'));
                                    }
                                }
                                
                            })

                            ->orderby('h.name','asc')
                            ->get();

            if(!empty($data->toArray())){
                return (new TotalInventoryDataExport($data->toArray()))->download('TotalInventoryData' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingSummary(Request $request)
    {
        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $roomTypes = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();


            $data =    HotelRoom::from('hotel_rooms as hr')
                            ->select('hr.id',
                                'h.classification','h.name','rt.name as room_type_name','hr.allocated_rooms','br.booking_id',
                            

                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as cancelled'),
                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as refunded'),
                                
                            )
                            ->join('hotels as h','hr.hotel_id','=','h.id')
                            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                            ->leftJoin('booking_rooms as br','br.id','=','hr.id')
                            ->leftJoin('bookings as b','br.booking_id','=','b.id')

                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {

                                    if ($request->get('hotel_name') != '') {
                                        $query->where('h.name', $request->get('hotel_name'));
                                    }

                                    if ($request->get('star_rating') != '') {
                                        $query->where('h.classification', 'like', '%' . $request->star_rating.'%');
                                    }

                                    if ($request->get('room_type') != '') {
                                        $query->where('hr.type_id', $request->get('room_type'));
                                    }
                                }
                                
                            })

                            ->orderby('h.name','asc')
                            ->get();

            $pendingStatus = array('Booking Received','Payment Completed','Booking Shared');
            $cancelStatus = array('Cancellation Requested','Cancellation Approved');
            $refundStatus = array('Refund Requested','Refund Approved','Refund Issued');

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        
                        ->addColumn('confirmed', function ($row) use($pendingStatus) {
                            $bookingRooms = BookingRoom::select(\DB::Raw('count(room_id) as confirmed'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$row->id)->whereIn('booking_status',['Confirmation Recevied'])->first();

                            return $bookingRooms->confirmed;
                        })                    

                        ->addColumn('pending', function ($row) use($pendingStatus) {
                            $bookingRooms = BookingRoom::select(\DB::Raw('count(room_id) as pending'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$row->id)->whereIn('booking_status',$pendingStatus)->first();

                            return $bookingRooms->pending;
                        })

                        ->addColumn('cancelled', function ($row) use($cancelStatus) {
                            $bookingRooms = BookingRoom::select(\DB::Raw('count(room_id) as cancelled'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$row->id)->whereIn('booking_status',$cancelStatus)->first();

                            return $bookingRooms->cancelled;
                        })

                        ->addColumn('refunded', function ($row) use($refundStatus) {
                            $bookingRooms = BookingRoom::select(\DB::Raw('count(room_id) as refunded'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$row->id)->whereIn('booking_status',$refundStatus)->first();

                            return $bookingRooms->refunded;
                        })
                        ->rawColumns(['pending','refunded','cancelled','confirmed'])
                        ->make(true);
            }

            return view('report::booking_summary',['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request, 'classifications' => $classifications]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingSummaryExport(Request $request){
        try{

            $bookings =    HotelRoom::from('hotel_rooms as hr')
                            ->select('hr.id',
                                'h.classification','h.name','rt.name as room_type_name','hr.allocated_rooms','br.booking_id',
                            

                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as cancelled'),
                                \DB::Raw('COALESCE((select sum(bulk_bookings.room_count) from bulk_bookings where bulk_bookings.room_type_id = hr.id ),0) as refunded'),
                                
                            )
                            ->join('hotels as h','hr.hotel_id','=','h.id')
                            ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                            ->leftJoin('booking_rooms as br','br.id','=','hr.id')
                            ->leftJoin('bookings as b','br.booking_id','=','b.id')

                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {

                                    if ($request->get('hotel_name') != '') {
                                        $query->where('h.name', $request->get('hotel_name'));
                                    }

                                    if ($request->get('star_rating') != '') {
                                        $query->where('h.classification', 'like', '%' . $request->star_rating.'%');
                                    }

                                    if ($request->get('room_type') != '') {
                                        $query->where('hr.type_id', $request->get('room_type'));
                                    }
                                }
                                
                            })

                            ->orderby('h.name','asc')
                            ->get();

            $pendingStatus = array('Booking Received','Payment Completed','Booking Shared');
            $cancelStatus = array('Cancellation Requested','Cancellation Approved');
            $refundStatus = array('Refund Requested','Refund Approved','Refund Issued');

            $data = array();
            if(!empty($bookings->toArray())){
                foreach ($bookings as $key => $booking) {

                    $confirmedRooms = BookingRoom::select(\DB::Raw('count(room_id) as confirmed'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$booking->id)->whereIn('booking_status',['Confirmation Recevied'])->first();

                    $pendingRooms = BookingRoom::select(\DB::Raw('count(room_id) as pending'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$booking->id)->whereIn('booking_status',$pendingStatus)->first();

                    $cancelledRooms = BookingRoom::select(\DB::Raw('count(room_id) as cancelled'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$booking->id)->whereIn('booking_status',$cancelStatus)->first();

                    $refundedRooms = BookingRoom::select(\DB::Raw('count(room_id) as refunded'))->leftJoin('bookings as b','booking_rooms.booking_id','=','b.id')->where('room_id',$booking->id)->whereIn('booking_status',$refundStatus)->first();

                    $data[] = array(
                                'classification' => $booking->classification,
                                'name' => $booking->name,
                                'room_type_name' => $booking->room_type_name,
                                'allocated_rooms' => $booking->allocated_rooms,
                                'confirmed' => $confirmedRooms->confirmed,
                                'pending' => $pendingRooms->pending,
                                'cancelled' => $cancelledRooms->cancelled,
                                'refunded' => $refundedRooms->refunded,
                            );
                }
            }

            if(!empty($bookings->toArray())){
                return (new BookingSummaryExport($data))->download('BookingSummary' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('ecommerce/orders')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }
    
    public function combined(Request $request)
    {
        try{

            $bookings = BookingRoom::from('booking_rooms as br')
                    ->select('h.name as hotel','hr.allocated_rooms','t.id as payment_id','u.full_name as guest_name','u.mobile as contact','u.email as email',
                        \DB::raw("CONCAT(bd.address_1,',',bd.address_2) AS billing_address"),
                        'bd.city','bd.state_province as state','bd.country','bd.zip_code as postal_code','u.id as user_id',
                        \DB::raw('DATE_FORMAT(u.created_at, "%d-%b-%Y") as registration_date'),
                        'rt.name as room_type_name','br.guests',
                        \DB::raw('DATE_FORMAT(b.created_at, "%d-%b-%Y") as booking_date'),
                        \DB::raw('DATE_FORMAT(b.check_in_date, "%d-%b-%Y") as check_in_date'),
                        \DB::raw('DATE_FORMAT(b.check_out_date, "%d-%b-%Y") as check_out_date'),
                        'b.booking_status','hr.rate','b.nights','br.adults','br.childs',

                        \DB::raw('(CASE WHEN br.extra_bed = 1 THEN "Yes" ELSE "No" END) AS extra_bed'),
                        \DB::raw('br.amount-br.tax as room_charges'),
                        'hr.extra_bed_rate','br.tax','br.tax_percentage','br.amount',
                        'h.contact_person','h.contact_number','h.email as hotel_email','t.payment_mode as payment_method','t.payment_method as payment_via','t.transaction_id','t.status as transaction_status','b.utr_number',
                        \DB::raw('DATE_FORMAT(b.settlement_date, "%d-%b-%Y") as settlement_date'),
                        \DB::raw('DATE_FORMAT(b.cancellation_date, "%d-%b-%Y") as cancellation_date'),
                        'b.cancellation_charges','br.refundable_amount',
                        \DB::raw('DATE_FORMAT(b.refund_date, "%d-%b-%Y") as refund_date'),
                        'b.refund_transaction_utr')

                    ->join('bookings as b','b.id','=','br.booking_id')
                    ->leftJoin('transactions as t','b.id','=','t.booking_id')
                    ->leftJoin('billing_details as bd','b.id','=','bd.booking_id')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }
                            if ($request->get('guest_name') != '') {
                                $query->where('u.full_name', 'like', '%' . $request->guest_name . '%');
                            }

                            if ($request->get('country') != '') {
                                $query->where('bd.country', 'like', '%' . $request->country . '%');
                            }

                            if ($request->get('state') != '') {
                                $query->where('bd.state', 'like', '%' . $request->state . '%');
                            }

                            if ($request->get('registration_date') != '') {
                                $query->whereDate('u.created_at', date('Y-m-d',strtotime($request->get('registration_date'))));
                            }

                            if ($request->get('payment_method') != '') {
                                $query->where('t.payment_method', 'like', '%' . $request->payment_method . '%');
                            }

                            if ($request->get('payment_via') != '') {
                                $query->where('t.payment_mode', 'like', '%' . $request->payment_via . '%');
                            }

                            if ($request->get('settlement_date') != '') {
                                $query->whereDate('b.settlement_date', date('Y-m-d',strtotime($request->settlement_date)));
                            }

                            if ($request->get('cancellation_date') != '') {
                                $query->whereDate('b.cancellation_date', date('Y-m-d',strtotime($request->get('cancellation_date'))));
                            }

                            if ($request->get('refundable_date') != '') {
                                $query->whereDate('b.refund_date', date('Y-m-d',strtotime($request->get('refundable_date'))));
                            }

                        }
                    })
                    ->orderby('br.created_at','desc')
                    ->get();

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $roomTypes = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();

            if(isset($request->type) && $request->type == 'export'){
                if(!empty($bookings->toArray())){
                    return (new CombinedExport($bookings->toArray()))->download('combined' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                }else{
                    return redirect('admin/report/combined')->with('error', 'No bookings');
                }
            }else{
                return view('report::combined',['bookings' => $bookings, 'hotels' => $hotels,'room_types' => $roomTypes, 'request' => $request]);
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingStatus(Request $request)
    {
        try{

            $data = Hotel::from('hotels as h')
                    ->select('h.id', 'h.name',
                    \DB::Raw('COALESCE((select sum(hotel_rooms.allocated_rooms) from hotel_rooms where hotel_rooms.hotel_id = h.id ),0) as allotedRooms', 'booking_rooms'),
                    \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as bookings'),
                    \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.room_id = hr.id ),0) as guests'),
                    // \DB::Raw('COALESCE((select sum(hotel_rooms.allocated_rooms) from hotel_rooms where hotel_rooms.hotel_id = h.id ),0) as allotedRooms', 'booking_rooms'),
                    )
                    ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->groupby('h.id')
                    ->orderby('h.name','asc')

                    ->get();

                    // echo "<pre>";
                    // print_r($data->toArray());
                    // die;
            
                    if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['order_id'])
                        ->skipPaging()
                        ->make(true);
            }

            return view('report::booking_status');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingStatusExport(Request $request)
    {
        try{

            $data = Hotel::from('hotels as h')
                    ->select('h.name',
                    \DB::Raw('COALESCE((select sum(hotel_rooms.allocated_rooms) from hotel_rooms where hotel_rooms.hotel_id = h.id ),0) as allotedRooms', 'booking_rooms'),
                    \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as bookings'),
                    \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.room_id = hr.id ),0) as guests'),
                    // \DB::Raw('COALESCE((select sum(hotel_rooms.allocated_rooms) from hotel_rooms where hotel_rooms.hotel_id = h.id ),0) as allotedRooms', 'booking_rooms'),
                    )
                    ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->groupby('h.id')
                    ->orderby('h.name','asc')

                    ->get();

            if(!empty($data->toArray())){
                return (new BookingStatusExport($data->toArray()))->download('booking-status' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/booking-status')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function pendingHotelConfirmation(Request $request)
    {
        try{

            $classifications = \Helpers::hotelClassifications();

            $hotels = \Helpers::hotels();

            $room_types = \Helpers::roomTypes();


            $data = BookingRoom::from('booking_rooms as br')
                    ->select('br.id','u.full_name as guest_name','u.email','u.mobile','b.order_id','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs','br.extra_bed','br.amount','b.booking_status',)
                    ->Join('bookings as b','b.id','=','br.booking_id')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where('b.booking_status','Payment Completed')
                    ->whereNull('b.confirmation_number')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('star_rating') != '') {
                                $query->where('h.classification', $request->star_rating);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('hr.type_id', $request->get('room_type'));
                            }

                            if ($request->get('guest_count') != '') {
                                $query->where('br.guests', $request->get('guest_count'));
                            }

                            if ($request->get('adults') != '') {
                                $query->where('br.adults', $request->get('adults'));
                            }

                            if ($request->get('child') != '') {
                                $query->where('br.childs', $request->get('child'));
                            }

                            if ($request->get('extra_bed') != '') {
                                $query->where('br.extra_bed', $request->get('extra_bed'));
                            }

                            if ($request->get('booking_status') != '') {
                                $query->where('b.booking_status', $request->get('booking_status'));
                            }

                            if ($request->get('country') != '') {
                                $query->where('u.country', $request->get('country'));
                            }

                            if ($request->get('postal_code') != '') {
                                $query->where('u.zip', $request->get('postal_code'));
                            }

                            if ($request->get('check_in_date') != '') {
                                $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                            }

                            if ($request->get('check_out_date') != '') {
                                $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                            }
                        }
                    })
                    ->orderby('u.full_name','asc')
                    ->get();

            if ($request->ajax()) {
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('order_id', function ($row) {
                            return $row->order_id;
                        })
                        ->addColumn('amount', function ($row) { 
                            return '₹'.number_format($row->amount, 2);
                        })
                        ->addColumn('check_in_date', function ($row) {
                            $check_in_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->check_in_date));
                            return $check_in_date;
                        })
                        ->addColumn('check_out_date', function ($row) {
                            $check_out_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->check_out_date));
                            return $check_out_date;
                        })
                        ->rawColumns(['order_id'])
                        ->make(true);
            }

            return view('report::pending_confirmation', ["classifications" => $classifications, "room_types" => $room_types, 'hotels' => $hotels]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function pendingHotelConfirmationExport(Request $request)
    {

        try{

            $bookings = BookingRoom::from('booking_rooms as br')
                    ->select('b.order_id','u.full_name as guest_name','u.email','u.mobile','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','b.booking_status','br.adults','br.childs','br.extra_bed','br.amount')
                    ->Join('bookings as b','b.id','=','br.booking_id')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where('b.booking_status','Payment Completed')
                    ->whereNull('b.confirmation_number')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('star_rating') != '') {
                                $query->where('h.classification', $request->star_rating);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('hr.type_id', $request->get('room_type'));
                            }

                            if ($request->get('guest_count') != '') {
                                $query->where('br.guests', $request->get('guest_count'));
                            }

                            if ($request->get('adults') != '') {
                                $query->where('br.adults', $request->get('adults'));
                            }

                            if ($request->get('child') != '') {
                                $query->where('br.childs', $request->get('child'));
                            }

                            if ($request->get('extra_bed') != '') {
                                $query->where('br.extra_bed', $request->get('extra_bed'));
                            }

                            if ($request->get('booking_status') != '') {
                                $query->where('b.booking_status', $request->get('booking_status'));
                            }

                            if ($request->get('country') != '') {
                                $query->where('u.country', $request->get('country'));
                            }

                            if ($request->get('postal_code') != '') {
                                $query->where('u.zip', $request->get('postal_code'));
                            }

                            if ($request->get('check_in_date') != '') {
                                $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                            }

                            if ($request->get('check_out_date') != '') {
                                $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                            }
                        }
                    })
                    ->orderby('u.full_name','asc')
                    ->get();

            if(!empty($bookings->toArray())){
                return (new PendingConfirmationExport($bookings->toArray()))->download('Pending Confirmation' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/pending-confirmation')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingCheckInStatus(Request $request)
    {
        try{

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $data = Booking::from('bookings as b')
                    ->select(\DB::raw('DATE_FORMAT(b.check_in_date, "%d-%b-%Y") as check_in_date'), 'h.name',
                        \DB::Raw('sum(case when (br.room_id!="") then 1 else 0 end) AS bookings'),
                        \DB::Raw('sum(case when (br.room_id!="") then br.guests else 0 end) AS guests'),
                    )
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('booking_rooms as br','br.booking_id','=','b.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('check_in_date') != '') {
                                $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                            }
                        }
                    })
                    ->groupby('b.check_in_date', 'h.name')
                    ->orderby('b.check_in_date','asc')
                    ->get();
            
                    if ($request->ajax()) {
                        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check_in_date', function ($row) {
                            $check_in_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->check_in_date));
                            return $check_in_date;
                        })
                        ->rawColumns(['order_id'])
                        ->skipPaging()
                        ->make(true);
            }

            return view('report::booking_checkin_status',['hotels' => $hotels]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingCheckInStatusExport(Request $request)
    {
        try{

           $data = Booking::from('bookings as b')
                    ->select(
                        \DB::raw('DATE_FORMAT(b.check_in_date, "%d-%b-%Y") as check_in_date'),
                         'h.name',
                        \DB::Raw('sum(case when (br.room_id!="") then 1 else 0 end) AS bookings'),
                        \DB::Raw('sum(case when (br.room_id!="") then br.guests else 0 end) AS guests'),
                    )
                    ->join('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('booking_rooms as br','br.booking_id','=','b.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('check_in_date') != '') {
                                $query->whereDate('b.check_in_date', date('Y-m-d',strtotime($request->get('check_in_date'))));
                            }
                        }
                    })
                    ->groupby('b.check_in_date', 'b.hotel_id')
                    ->orderby('b.check_in_date','asc')
                    ->get();

            if(!empty($data->toArray())){
                return (new BookingCheckInStatusExport($data->toArray()))->download('booking-checkin-status' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/booking-status')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingCheckOutStatus(Request $request)
    {
        try{

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $data = Booking::from('bookings as b')
                    ->select(\DB::raw('DATE_FORMAT(b.check_out_date, "%d-%b-%Y") as check_out_date'), 'h.name',
                        \DB::Raw('sum(case when (br.room_id!="") then 1 else 0 end) AS bookings'),
                        \DB::Raw('sum(case when (br.room_id!="") then br.guests else 0 end) AS guests'),
                    )
                    ->join('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('booking_rooms as br','br.booking_id','=','b.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('check_out_date') != '') {
                                $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                            }
                        }
                    })
                    ->groupby('b.check_out_date', 'h.name')
                    ->orderby('b.check_out_date','asc')
                    ->get();
            
                    if ($request->ajax()) {
                        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('check_out_date', function ($row) {
                            $check_out_date = date(\Config::get('constants.DATE.DATE_FORMAT'), strtotime($row->check_out_date));
                            return $check_out_date;
                        })
                        ->rawColumns(['order_id'])
                        ->skipPaging()
                        ->make(true);
            }

            return view('report::booking_checkout_status',['hotels' => $hotels]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bookingCheckOutStatusExport(Request $request)
    {
        try{

           $data = Booking::from('bookings as b')
                    ->select(
                        \DB::raw('DATE_FORMAT(b.check_out_date, "%d-%b-%Y") as check_out_date'),
                         'h.name',
                        \DB::Raw('sum(case when (br.room_id!="") then 1 else 0 end) AS bookings'),
                        \DB::Raw('sum(case when (br.room_id!="") then br.guests else 0 end) AS guests'),
                    )
                    ->join('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('booking_rooms as br','br.booking_id','=','b.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                            }

                            if ($request->get('check_out_date') != '') {
                                $query->whereDate('b.check_out_date', date('Y-m-d',strtotime($request->get('check_out_date'))));
                            }
                        }
                    })
                    ->groupby('b.check_out_date', 'h.name')
                    ->orderby('b.check_out_date','asc')
                    ->get();

            if(!empty($data->toArray())){
                return (new BookingCheckOutStatusExport($data->toArray()))->download('booking-checkout-status' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/booking-checkout-status')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function groupBookings(Request $request)
    {
        try{

            return view('report::group_bookings');
        
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function callCenter(Request $request)
    {
       
        try{

            $data = CustomerCare::from('customer_care as cc')
            ->select( 'cc.case_id', 'cc.date', 'cc.guest_name', 'cc.country', 'cc.contact','cc.email', 'cc.whatsapp'
               , 'cc.method', 'cc.issue', 'cc.sub_issue', 'cc.status', 'cc.remark')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('date') != '') {
                                $query->where('cc.date',  $request->date);
                            }

                            if ($request->get('method') != '') {
                                $query->where('cc.method',  $request->method );
                            }

                            if ($request->get('status') != '') {
                                $query->where('cc.status',  $request->status );
                            }

                            if ($request->get('issue') != '') {
                                $query->where('cc.issue',  $request->issue );
                            }

                            if ($request->get('sub_issue') != '') {
                                $query->where('cc.sub_issue',  $request->sub_issue );
                            }
                        }
                    })
                    ->get();

                    // echo "<pre>";
                    // print_r($data->toArray());
                    // die;

                    if ($request->ajax()) {
                        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('date', function ($row) {
                            $date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->date));
                            return $date;
                        })
                        // ->rawColumns(['order_id'])
                        ->make(true);
            }
            return view('report::call_center');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function callCenterExport(Request $request)
    {
       
        try{

            $data = CustomerCare::from('customer_care as cc')
            ->select( 'cc.case_id', 'cc.date', 'cc.guest_name', 'cc.contact','cc.email' 
               , 'cc.method', 'cc.issue', 'cc.sub_issue', 'cc.status', 'cc.remark')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('date') != '') {
                                $query->where('cc.date',  $request->date);
                            }

                            if ($request->get('method') != '') {
                                $query->where('cc.method',  $request->method );
                            }

                            if ($request->get('status') != '') {
                                $query->where('cc.status',  $request->status );
                            }

                            if ($request->get('issue') != '') {
                                $query->where('cc.issue',  $request->issue );
                            }

                            if ($request->get('sub_issue') != '') {
                                $query->where('cc.sub_issue',  $request->sub_issue );
                            }
                        }
                    })
                    ->get();

                    // echo "<pre>";
                    // print_r($data->toArray());
                    // die;

                    
            if(!empty($data->toArray())){
                return (new CallCenterExport($data->toArray()))->download('call-center' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/call-center')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }
    
    public function bulkBookingRooms(Request $request)
    {

        try{

            $hotels = Hotel::from('hotels as h')
            ->select('h.name', 'h.id')->get();

            $room_types = RoomType::from('room_types as rt')
            ->select('rt.name', 'rt.id')->get();

            $data = BulkBookingRoom::from('bulk_booking_rooms as bm')
                        ->select(
                            'bm.booking_id as confirmation_number',
                            'bm.guest_name',
                            'bm.guest_designation',
                            'bm.adult_count',
                            'bm.child_count',
                            'bb.name',
                            'bb.checkin_date',
                            'bb.checkout_date',
                            'bb.booking_person',
                            'bb.name',
                            'h.name as hotel_name',
                            'rt.name as room_type'
                    )
                    ->leftjoin('bulk_bookings as bb','bb.id','=','bm.bulk_booking_id')
                    ->leftjoin('hotels as h','h.id','=','bb.hotel_id')
                    ->leftjoin('hotel_rooms as hr','hr.id','=','bb.room_type_id')
                    ->leftjoin('room_types as rt','rt.id','=','hr.type_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.id',  $request->hotel_name);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('rt.id',  $request->room_type );
                            }

                            if ($request->get('booking_from') != '') {
                                $query->where('bb.booking_person',  $request->booking_from );
                            }

                            if ($request->get('booking_via') != '') {
                                $query->where('bb.name',  'like', '%' .  $request->booking_via . '%');
                            }

                            if ($request->get('checkin_date') != '') {
                                $query->whereDate('bb.checkin_date',  date('Y-m-d', strtotime($request->checkin_date)));
                            }

                            if ($request->get('checkout_date') != '') {
                                $query->where('bb.checkout_date',  $request->checkout_date );
                            }
                        }
                    })
                    ->get();

                    if ($request->ajax()) {
                        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('checkin_date', function ($row) {
                            $checkin_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->checkin_date));
                            return $checkin_date;
                        })
                        ->addColumn('checkout_date', function ($row) {
                            $checkout_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->checkout_date));
                            return $checkout_date;
                        })
                        // ->rawColumns(['order_id'])
                        ->make(true);
            }
            return view('report::bulk_booking_rooms', ['hotels' => $hotels, 'room_types' => $room_types]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function bulkBookingRoomsExport(Request $request)
    {
        try{

            $data = BulkBookingRoom::from('bulk_booking_rooms as bm')
                        ->select(
                            'bb.booking_person',
                            'bb.name',
                            'h.name as hotel_name',
                            'rt.name as room_type',
                            'bm.booking_id as confirmation_number',
                            'bm.guest_name',
                            'bm.guest_designation',
                            'bm.adult_count',
                            'bm.child_count',
                            'bb.checkin_date',
                            'bb.checkout_date',
                    )
                    ->leftjoin('bulk_bookings as bb','bb.id','=','bm.bulk_booking_id')
                    ->leftjoin('hotels as h','h.id','=','bb.hotel_id')
                    ->leftjoin('hotel_rooms as hr','hr.id','=','bb.room_type_id')
                    ->leftjoin('room_types as rt','rt.id','=','hr.type_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.id',  $request->hotel_name);
                            }

                            if ($request->get('room_type') != '') {
                                $query->where('rt.id',  $request->room_type );
                            }

                            if ($request->get('booking_from') != '') {
                                $query->where('bb.booking_person',  $request->booking_from );
                            }

                            if ($request->get('booking_via') != '') {
                                $query->where('bb.name',  'like', '%' .  $request->booking_via . '%');
                            }

                            if ($request->get('checkin_date') != '') {
                                $query->where('bb.checkin_date',  $request->checkin_date );
                            }

                            if ($request->get('checkout_date') != '') {
                                $query->where('bb.checkout_date',  $request->checkout_date );
                            }
                        }
                    })
                    ->get();

              
            if(!empty($data->toArray())){
                return (new BulkBookingRoomExport($data->toArray()))->download('bulk-booking-rooms' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/report/bulk-booking-rooms')->with('error', 'No order');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function failedPayments(Request $request)
    {

        $hotels = Hotel::from('hotels as h')
        ->select('h.name', 'h.id')->get();

        $data =   FailedTransaction::from('failed_transactions as ft')
        ->select(
            'u.full_name as guest', 'b.order_id', 'h.name as hotel',
            'ft.payment_method','ft.amount','ft.transaction_id','ft.status','ft.unmappedstatus','ft.error_message','ft.created_at as transaction_date'
        )
        ->leftJoin('bookings as b','ft.booking_id','=','b.id')
        ->leftJoin('hotels as h','h.id','=','ft.hotel_id')
        ->leftjoin('users as u','u.id','=','ft.user_id')
        ->where(function ($query) use ($request) {
            if (!empty($request->toArray())) {

                if ($request->get('hotel_name') != '') {
                    $query->where('h.name', $request->get('hotel_name'));
                }

                if ($request->get('guest') != '') {
                    $query->where('u.full_name', 'like', '%' . $request->guest . '%');
                }

                if ($request->get('orderid') != '') {
                    $query->where('b.order_id', $request->orderid);
                }

                if ($request->get('transaction_date') != '') {
                    $query->whereDate('ft.created_at', date('Y-m-d',strtotime($request->get('transaction_date'))));
                }

                if ($request->get('payment_method') != '') {
                    $query->where('ft.payment_method', $request->get('payment_method'));
                }
            }
            
        })
        ->orderby('ft.created_at','desc')
        ->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('transaction_date', function ($row) {
                    $transaction_date = date(\Config::get('constants.DATE.DATE_FORMAT_FULL') , strtotime($row->transaction_date));
                    return $transaction_date;
                })
                ->addColumn('amount', function ($row) { 
                    return '₹'.number_format($row->amount, 2);
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('report::failed_payments', ['hotels' => $hotels, 'request' => $request]);
    }

    public function failedPaymentsExport(Request $request)
    {

        $data =   FailedTransaction::from('failed_transactions as ft')
        ->select(
            'u.full_name as guest', 'b.order_id', 'h.name as hotel',
            'ft.payment_method','ft.amount','ft.transaction_id','ft.unmappedstatus','ft.error_message',
            \DB::raw('DATE_FORMAT(ft.created_at, "%d-%b-%Y") as transaction_date')
        )
        ->leftJoin('bookings as b','ft.booking_id','=','b.id')
        ->leftJoin('hotels as h','h.id','=','ft.hotel_id')
        ->leftjoin('users as u','u.id','=','ft.user_id')
        ->where(function ($query) use ($request) {
            if (!empty($request->toArray())) {

                if ($request->get('hotel_name') != '') {
                    $query->where('h.name', $request->get('hotel_name'));
                }

                if ($request->get('guest') != '') {
                    $query->where('u.full_name', 'like', '%' . $request->guest . '%');
                }

                if ($request->get('orderid') != '') {
                    $query->where('b.order_id', $request->orderid);
                }

                if ($request->get('transaction_date') != '') {
                    $query->whereDate('ft.created_at', date('Y-m-d',strtotime($request->get('transaction_date'))));
                }

                if ($request->get('payment_method') != '') {
                    $query->where('ft.payment_method', $request->get('payment_method'));
                }
            }
            
        })
        ->orderby('ft.created_at','desc')
        ->get();

        if(!empty($data->toArray())){
            return (new FailedPaymentExport($data->toArray()))->download('failed-payments' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }else{
            return redirect('/admin/report/failed-payments')->with('error', 'No payments');
        }
    }

    public function bookingInventory(Request $request)
    {
        try{
            
            $rooms =   Hotel::from('hotels as h')
                        ->select('h.name','h.classification','hr.allocated_rooms', 'hr.mpt_reserve' ,'rt.name as room_type_name','hr.id as room_id'
                        )
                        ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                        ->leftJoin('room_types as rt','rt.id','=','hr.type_id')

                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('hotel_name') != '') {
                                    $query->where('h.name', 'like', '%' . $request->hotel_name . '%');
                                }

                                if ($request->get('star_rating') != '') {
                                    $query->where('h.classification', $request->star_rating);
                                }

                                if ($request->get('room_type') != '') {
                                    $query->where('hr.type_id', $request->get('room_type'));
                                }
                            }
                        })

                        ->orderby('h.name','asc')
                        ->get();



            foreach ($rooms as $key => $room) {
                $dateData = array(
                    '06' => 0,
                    '07' => 0,
                    '08' => 0,
                    '09' => 0,
                    '10' => 0,
                    '11' => 0,
                    '12' => 0,
                    '13' => 0
                );
                $bookings = BookingRoom::from('booking_rooms as br')
                            ->select('br.room_id as booking_room_id','b.check_in_date','b.check_out_date')
                            ->leftJoin('bookings as b','br.booking_id','=','b.id')
                            ->where('br.room_id',$room->room_id)
                            ->whereIn('b.booking_status',['Payment Completed','Confirmation Recevied','Booking Shared'])
                            ->get();

                if(!empty($bookings->toArray())){
                    foreach ($bookings as $key => $booking) {
                        $checkInDate = date('d',strtotime($booking->check_in_date));
                        $checkOutDate = date('d',strtotime($booking->check_out_date));

                        if(isset($dateData[$checkInDate])){
                            $dateData[$checkInDate] = $dateData[$checkInDate]+1;
                        }
                        
                        $daysDiff = $checkOutDate-$checkInDate;
                        for ($i=1; $i <=$daysDiff ; $i++) { 

                            $dateKey = $checkInDate+$i;
                            $dateKey = sprintf("%02d", $dateKey);

                            if(isset($dateData[$dateKey])){
                                $dateData[$dateKey] = $dateData[$dateKey]+1;
                            }    
                        }

                        if(isset($dateData[$checkOutDate])){
                            $dateData[$checkOutDate] = $dateData[$checkOutDate]-1;
                        }

                    }
                }
                $room['six'] = (string)$dateData['06'];
                $room['seven'] = (string)$dateData['07'];
                $room['eight'] = (string)$dateData['08'];
                $room['nine'] = (string)$dateData['09'];
                $room['ten'] = (string)$dateData['10'];
                $room['eleven'] = (string)$dateData['11'];
                $room['twelve'] = (string)$dateData['12'];
                $room['thirteen'] = (string)$dateData['13'];
            }


            if(isset($request->type) && $request->type == 'export'){
                if(!empty($rooms->toArray())){
                    $rooms = $rooms->toArray();
                    array_walk($rooms, function (&$a, $k) {
                      unset($a['room_id']); 
                    });

                    return (new BookingInventoryExport($rooms))->download('booking-inventory' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                }else{
                    return redirect('admin/report/booking-inventory')->with('error', 'No data');
                }
            }else{
                $classifications = \Helpers::hotelClassifications();
                $hotels = \Helpers::hotels();
                $room_types = \Helpers::roomTypes();
                return view('report::booking_inventory', ['rooms' => $rooms, 'request' => $request,'classifications' => $classifications, 'hotels' => $hotels, 'room_types' => $room_types]);
            }

        } catch (\Exception $e) {
            return redirect('admin/report/booking-inventory')->back()->with('error', $e->getMessage());

        }
    }

    public function financial(Request $request)
    {
        try{
            
            return view('report::financial');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function financial2(Request $request)
    {
        try{
            
            return view('report::financial_2');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }
    
}
