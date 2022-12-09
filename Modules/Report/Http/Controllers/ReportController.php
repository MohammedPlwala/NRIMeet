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
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;

use Modules\Report\Exports\GuestExport;
use Modules\Report\Exports\BookingExport;
use Modules\Report\Exports\HotelMasterExport;
use Modules\Report\Exports\InventoryExport;
use Modules\Report\Exports\PaymentExport;
use Modules\Report\Exports\CancellationExport;

use DataTables;


class ReportController extends Controller
{

    public function guest(Request $request)
    {

        $data =   User::from('users as u')
                    ->select('u.*')
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

                            if ($request->get('state') != '') {
                                $query->where('u.state', $request->get('state'));
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

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    
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
    }

    public function guestExport(Request $request)
    {
        $guests =   User::from('users as u')
                    ->select('u.full_name','u.mobile','u.email','u.mobile as wa','u.address','u.city','u.state','u.country','u.zip')
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

        if(!empty($guests->toArray())){
            return (new GuestExport($guests->toArray()))->download('guests' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }else{
            return redirect('ecommerce/orders')->with('error', 'No order');
        }
    }

    public function hotelMaster(Request $request)
    {
        $data =   Hotel::from('hotels as h')
                    ->select('h.name','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.address','h.contact_number','h.description','hr.name as hotel_type','hr.allocated_rooms','hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate')
                    ->Join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
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
                    ->rawColumns(['status',])
                    ->make(true);
        }
        return view('report::hotel_master');
    }

    public function hotelMasterExport(Request $request)
    {
        $hotels =   Hotel::from('hotels as h')
                    ->select('h.classification','h.name','hr.name as hotel_type','hr.allocated_rooms','hr.rate','hr.extra_bed_rate','hr.count as available_rooms','h.contact_person','h.contact_number','h.description','h.airport_distance','h.venue_distance','h.address','h.website')
                    ->Join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
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
    }

    public function booking(Request $request)
    {

        $data = BookingRoom::from('booking_rooms as br')
                ->select('br.id','u.full_name as guest_name','b.order_id','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs','br.extra_bed','br.amount')
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

                        if ($request->get('room_type') != '') {
                            $query->where('rt.name', 'like', '%' . $request->room_type . '%');
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

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('order_id', function ($row) {
                        return $row->order_id;
                    })
                    ->rawColumns(['order_id'])
                    ->make(true);
        }

        return view('report::booking');
    }

    public function bookingExport(Request $request)
    {

        $bookings = BookingRoom::from('booking_rooms as br')
                ->select('u.full_name as guest_name','b.order_id','b.confirmation_number','h.classification','h.name as hotel','rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs','br.extra_bed','br.amount')
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

                        if ($request->get('room_type') != '') {
                            $query->where('rt.name', 'like', '%' . $request->room_type . '%');
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
    }


    public function inventory(Request $request)
    {
        $data =   Hotel::from('hotels as h')
                    ->select('h.name','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.address','h.contact_number','h.description','hr.allocated_rooms', 'hr.mpt_reserve' ,'hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate','rt.name as room_type_name',
                    \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                    )
                    ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('rating') != '') {
                                $query->where('h.classification', 'like', '%' . $request->rating.'%');
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
                    ->addColumn('opening_room', function ($row) {
                        return $opening_room = $row->allocated_rooms-$row->mpt_reserve;
                    })
                    ->rawColumns(['opening_room'])
                    ->make(true);
        }
        return view('report::inventory');
    }

    public function inventoryExport(Request $request)
    {
        $inventory =   Hotel::from('hotels as h')
                    ->select(
                        'h.classification','h.name','rt.name as room_type_name','hr.allocated_rooms', 'hr.mpt_reserve','hr.allocated_rooms',\DB::Raw('hr.allocated_rooms-hr.mpt_reserve as opening_room'),'hr.rate','hr.extra_bed_rate',
                        \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                        'hr.count as available_rooms'
                    )
                    ->join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    ->leftJoin('room_types as rt','rt.id','=','hr.type_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('rating') != '') {
                                $query->where('h.classification', 'like', '%' . $request->rating.'%');
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

                            if ($request->get('room_charges') != '') {
                                $query->where('hr.rate', $request->get('room_charges'));
                            }                           

                            if ($request->get('room_count') != '') {
                                $query->where('hr.count', $request->get('room_count'));
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
    }

    public function payment(Request $request)
    {
        $data =     Booking::from('bookings as b')
                    ->select('b.order_id','u.full_name as guest','b.created_at as booking_date','t.created_at as payment_date','bd.country', 'h.name as hotel',
                        \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                        'b.tax','b.amount','b.booking_status','b.booking_type','t.payment_method','t.transaction_id','b.settlement_date','b.utr_number'
                    )
                    ->leftJoin('transactions as t','b.id','=','t.booking_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->leftJoin('billing_details as bd','b.id','=','bd.booking_id')
                    ->leftJoin('hotels as h','b.hotel_id','=','h.id')
                    ->where('booking_type','Online')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('guest_name') != '') {
                                $query->where('u.full_name', 'like', '%' . $request->guest_name.'%');
                            }
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name.'%');
                            }                         

                            if ($request->get('status') != '') {
                                $query->where('b.booking_status', $request->get('status'));
                            }
                        }
                    })
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['status'])
                    ->make(true);
        }
        return view('report::payment');
    }

    public function paymentExport(Request $request)
    {
        $payments = Booking::from('bookings as b')
                    ->select('b.order_id','u.full_name as guest','b.created_at as booking_date','t.created_at as payment_date','bd.country', 'h.name as hotel',
                        \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                        'b.tax','b.amount','b.booking_status','b.booking_type','t.payment_method','t.transaction_id','b.settlement_date','b.utr_number'
                    )
                    ->leftJoin('transactions as t','b.id','=','t.booking_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->leftJoin('billing_details as bd','b.id','=','bd.booking_id')
                    ->leftJoin('hotels as h','b.hotel_id','=','h.id')
                    ->where('booking_type','Online')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('guest_name') != '') {
                                $query->where('u.full_name', 'like', '%' . $request->guest_name.'%');
                            }
                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', 'like', '%' . $request->hotel_name.'%');
                            }                         

                            if ($request->get('status') != '') {
                                $query->where('b.booking_status', $request->get('status'));
                            }
                        }
                    })
                    ->get();

        
        if(!empty($payments->toArray())){
            return (new PaymentExport($payments->toArray()))->download('payments' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }else{
            return redirect('ecommerce/orders')->with('error', 'No order');
        }
    }


    public function cancellation(Request $request)
    {
        $hotels = Hotel::from('hotels as h')
        ->select('h.name', 'h.id')->get();

        $roomTypes = RoomType::from('room_types as rt')
        ->select('rt.name', 'rt.id')->get();


        $data =   BookingRoom::from('booking_rooms as br')
        ->select(
            'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
            'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
            'br.childs','br.extra_bed','br.amount','b.booking_status','b.cancellation_request_date'
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

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('report::cancellation', ['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request]);
    }

    public function cancellationExport(Request $request){


        $cancellation =   BookingRoom::from('booking_rooms as br')
        ->select(
            'u.full_name as guest', 'b.order_id', 'b.confirmation_number',  'h.classification', 'h.name as hotel',
            'rt.name as room_type_name','br.guests','b.check_in_date','b.check_out_date','br.adults','br.childs',
            'br.childs','br.extra_bed','br.amount','b.booking_status','b.cancellation_request_date'
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
    }


    public function refund(Request $request)
    {
        return view('report::refund');
    }


    public function totalInventoryData(Request $request)
    {

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

        return view('report::total_inventory_data',['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request]);
    }


    public function bookingSummary(Request $request)
    {
        return view('report::booking_summary');
    }
    public function groupBookings(Request $request)
    {
        return view('report::group_bookings');
    }
    public function callCenter(Request $request)
    {
        return view('report::call_center');
    }
    public function financial(Request $request)
    {
        return view('report::financial');
    }
    public function financial2(Request $request)
    {
        return view('report::financial_2');
    }
}
