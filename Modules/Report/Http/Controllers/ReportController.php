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
use Modules\Report\Exports\HotelMasterExport;

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
                    
                    ->rawColumns(['status',])
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

    public function inventory(Request $request)
    {
        $data =   Hotel::from('hotels as h')
                    ->select('h.name','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.address','h.contact_number','h.description','hr.name as hotel_type','hr.allocated_rooms', 'hr.mpt_reserve' ,'hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate',
                    \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                    )
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
        return view('report::inventory');
    }
    public function payment(Request $request)
    {
        $data =   Booking::from('bookings as b')
                    ->select('b.order_id', 
                    'b.created_at', 
                    'b.tax',
                    'b.amount',
                    // 'USER', 
                    // 'TRANS',
                    // 'USER-COUNTRY',  
                    // 'RoomBooked',
                    // 'Total Guest',
                    // 'Room / Night Charge',
                    // 'b.status'
                    )
                    // ->select('h.name','h.classification','h.airport_distance','h.venue_distance','h.website','h.contact_person','h.address','h.contact_number','h.description','hr.name as hotel_type','hr.allocated_rooms', 'hr.mpt_reserve' ,'hr.count as available_rooms','hr.rate','hr.extra_bed_available','hr.extra_bed_rate',
                    // \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.room_id = hr.id ),0) as current_booking'),
                    // )
                   
                    ->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['status',])
                    ->make(true);
        }
        return view('report::payment');
    }
    public function booking(Request $request)
    {
        return view('report::booking');
    }
    public function cancellation(Request $request)
    {
        $hotels = Hotel::from('hotels as h')
        ->select('h.name', 'h.id')->get();

        $roomTypes = RoomType::from('room_types as rt')
        ->select('rt.name', 'rt.id')->get();

        $data =   Booking::from('bookings as b')
        ->select(
        'u.full_name',
        'b.order_id', 
        'b.confirmation_number', 
        'h.classification',
        'h.name',
        'hr.name as room_name',
        \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
        \DB::Raw('COALESCE((select sum(booking_rooms.adults) from booking_rooms where booking_rooms.booking_id = b.id ),0) as adult'),
        \DB::Raw('COALESCE((select sum(booking_rooms.childs) from booking_rooms where booking_rooms.booking_id = b.id ),0) as child'),
        \DB::Raw('COALESCE((select sum(booking_rooms.extra_bed) from booking_rooms where booking_rooms.booking_id = b.id ),0) as extra_bed'),
        'b.check_in_date',
        'b.check_out_date',
        'b.amount'
        )
        ->join('hotels as h','h.id','=','b.hotel_id')
        ->join('booking_rooms as r','r.id','=','b.id')
        ->join('hotel_rooms as hr','hr.id','=','r.room_id')
        ->join('users as u','u.id','=','b.user_id')
        ->where(function ($query) use ($request) {
            if (!empty($request->toArray())) {
                if ($request->get('hotel_name') != '') {
                    $query->where('h.name', $request->get('hotel_name'));
                }

                if ($request->get('room_type') != '') {
                    $query->where('hr.type_id', $request->get('room_type'));
                }

                if ($request->get('guest_count') != '') {
                    $query->where('guests', $request->get('guest_count'));
                }

                if ($request->get('check_in_date') != '') {
                    $query->where('b.check_in_date', $request->get('check_in_date'));
                }

                if ($request->get('check_out_date') != '') {
                    $query->where('b.check_out_date', $request->get('check_out_date'));
                }

                if ($request->get('adult') != '') {
                    $query->where('adult', $request->get('adult'));
                }
                if ($request->get('child') != '') {
                    $query->where('child', $request->get('child'));
                }
                if ($request->get('extra_bed') != '') {
                    $query->where('extra_bed', $request->get('extra_bed'));
                }
                

                if ($request->get('booking_status') != '') {
                    $query->where('b.booking_status', $request->get('booking_status'));
                } else {
                    $query->where('b.booking_status', 'Cancellation Approved')
                    ->orWhere('b.booking_status', 'Cancellation Requested')
                    ->orWhere('b.booking_status', 'Refund Requested')
                    ->orWhere('b.booking_status', 'Refund Approved')
                    ->orWhere('b.booking_status', 'Refund Issued');
                }



               
            } else {
                $query->where('b.booking_status', 'Cancellation Approved')
                ->orWhere('b.booking_status', 'Cancellation Requested')
                ->orWhere('b.booking_status', 'Refund Requested')
                ->orWhere('b.booking_status', 'Refund Approved')
                ->orWhere('b.booking_status', 'Refund Issued');
            }
            
        })
        ->get();

if ($request->ajax()) {
return Datatables::of($data)
        ->addIndexColumn()
        ->rawColumns(['status',])
        ->make(true);
}
        return view('report::cancellation', ['hotels' => $hotels, 'room_types' => $roomTypes, 'request' => $request]);
    }
    public function refund(Request $request)
    {
        return view('report::refund');
    }
    public function totalInventoryData(Request $request)
    {
        return view('report::total_inventory_data');
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
