<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\BulkBooking;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BulkBookingRoom;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\Transaction;
use Modules\User\Entities\CustomerCare;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        if (!empty($request->toArray())) {
            if ($request->get('date') != '') {
                $date = date('Y-m-d', strtotime($request->date . '+1 day'));
            }else{
                $date = date('Y-m-d', strtotime('+1 day'));
            }
        }else{
            $date = date('Y-m-d', strtotime('+1 day'));
        }

        $bulk_bookings = BulkBooking::whereDate('created_at','<',$date)->get();
        $mea_bookings = BulkBooking::where('booking_person','MEA')->whereDate('created_at','<',$date)->get();
        $online_bookings = Booking::where('booking_type','Online')->whereDate('created_at','<',$date)->get();
        $offline_bookings = Booking::where('booking_type','Offline')->whereDate('created_at','<',$date)->get();

        // Cancellation Stats
        $cancellation_request = Booking::where('booking_status','Cancellation Requested')->whereDate('created_at','<',$date)->get();
        $cancellation_approved = Booking::where('booking_status','Cancellation Approved')->whereDate('created_at','<',$date)->get();

        // Refund Stats
        $refund_requested = Booking::where('booking_status','Refund Requested')->whereDate('created_at','<',$date)->get();
        $refund_approved = Booking::where('booking_status','Refund Approved')->whereDate('created_at','<',$date)->get();
        $refund_issued = Booking::where('booking_status','Refund Issued')->whereDate('created_at','<',$date)->get();
        
        // Guest Stats
        $adult_guest = 0;
        $total_adult_guest = BookingRoom::select(DB::raw("SUM(adults) as total_adults"))->leftjoin('bookings as b','booking_rooms.booking_id','b.id')->whereNotIn('b.booking_status', ['Cancellation Requested','Cancellation Approved','Refund Requested','Refund Approved','Refund Issued'])->whereDate('booking_rooms.created_at','<',$date)->get();
        if($total_adult_guest){
            $adult_guest = $total_adult_guest[0]->total_adults;
        }

        $child_guest = 0;
        $total_child_guest = BookingRoom::select(DB::raw("SUM(childs) as total_child"))->leftjoin('bookings as b','booking_rooms.booking_id','b.id')->whereNotIn('b.booking_status', ['Cancellation Requested','Cancellation Approved','Refund Requested','Refund Approved','Refund Issued'])->whereDate('booking_rooms.created_at','<',$date)->get();
        if($total_child_guest){
            $child_guest = $total_child_guest[0]->total_child;
        }

        // Room Type Booking Stats
        $room_type_booking = BookingRoom::select('rt.name')->leftjoin('hotel_rooms as hr','hr.id','booking_rooms.room_id')->leftjoin('room_types as rt','rt.id','hr.type_id')->whereDate('booking_rooms.created_at','<',$date)->get()->toArray();
        $room_type_booking_array = array();
        if($room_type_booking){
            foreach ($room_type_booking as $key => $value) {
                $room_type = $value['name'];
                if(isset($room_type_booking_array[$room_type])){
                  $room_type_booking_array[$room_type] = $room_type_booking_array[$room_type] + 1;  
                }else{
                    $room_type_booking_array[$room_type] = 1;
                }
            }
        }

        //Booking Stats
        $total_bookings = Booking::whereDate('created_at','<',$date)->get();
        $booking_received = Booking::where('booking_status','Booking Received')->whereDate('created_at','<',$date)->get();
        $shared_bookings = Booking::where('booking_status','Booking Shared')->whereDate('created_at','<',$date)->get();
        $confirmation_recevied_bookings = Booking::where('booking_status','Confirmation Recevied')->whereDate('created_at','<',$date)->get();
        $extra_bed_count = BookingRoom::where('extra_bed',1)->whereDate('booking_rooms.created_at','<',$date)->get();

        // Payment Stats
        $total_payment = Booking::select(DB::raw("SUM(amount) as total_amount"))->whereDate('created_at','<',$date)->first();
        $payment_confirmed = Transaction::select(DB::raw("SUM(amount) as confirmed_amount"))->join('bookings as b','b.id','transactions.booking_id')->where('transactions.status','transactions')->whereDate('transactions.created_at','<',$date)->first();
        $payment_refund_approved = Booking::select(DB::raw("SUM(amount) as refund_approved_amount"))->where('booking_status','Refund Approved')->whereDate('created_at','<',$date)->first();
        $payment_refund_issued = Booking::select(DB::raw("SUM(amount) as refund_issued_amount"))->where('booking_status','Refund Issued')->whereDate('created_at','<',$date)->first();
        $room_type_wise_payment = BookingRoom::from('booking_rooms as br')->select('rt.name as type','br.amount')->leftjoin('hotel_rooms as hr','br.room_id','hr.id')->leftjoin('room_types as rt','hr.type_id','rt.id')->whereDate('br.created_at','<',$date)->get();
        $payment = array();
        foreach ($room_type_wise_payment as $key => $value) {
            $type = $value['type'];
            $amount = $value['amount'];
            if(isset($payment[$type])){
                $payment[$type] = $payment[$type] + $amount;
            }else{
                $payment[$type] = $amount;
            }
        }

        // Inventory Stats
        $total_inventory = HotelRoom::select(DB::raw("SUM(allocated_rooms) as total_inventory_rooms"))->whereDate('created_at','<',$date)->first();
        $total_allocated_rooms = HotelRoom::whereDate('created_at','<',$date)->get();
        $allocated_rooms = array();
        foreach ($total_allocated_rooms as $key => $value) {
            $type = $value['name'];
            $rooms = $value['allocated_rooms'];
            if(isset($allocated_rooms[$type])){
                $allocated_rooms[$type] = $allocated_rooms[$type] + $rooms;
            }else{
                $allocated_rooms[$type] = $rooms;
            }
        }

        $total_booked_rooms = BookingRoom::from('booking_rooms as br')->select('rt.name as type')->leftjoin('hotel_rooms as hr','br.room_id','hr.id')->leftjoin('room_types as rt','hr.type_id','rt.id')->whereDate('br.created_at','<',$date)->get();
        $booked_rooms = array();
        foreach ($total_booked_rooms as $key => $value) {
            $type = $value['type'];
            if(isset($booked_rooms[$type])){
                $booked_rooms[$type] = $booked_rooms[$type] + 1;
            }else{
                $booked_rooms[$type] = 1;
            }
        }

        $total_available_rooms = HotelRoom::from('hotel_rooms as hr')->select('rt.name as type','hr.count')->leftjoin('room_types as rt','hr.type_id','rt.id')->whereDate('hr.created_at','<',$date)->get();
        $available_rooms = array();
        foreach ($total_available_rooms as $key => $value) {
            $type = $value['type'];
            if(isset($available_rooms[$type])){
                $available_rooms[$type] = $available_rooms[$type] + $value['count'];
            }else{
                $available_rooms[$type] = $value['count'];
            }
        }

        $total_mpt_rooms = HotelRoom::from('hotel_rooms as hr')->select('rt.name as type','hr.mpt_reserve')->leftjoin('room_types as rt','hr.type_id','rt.id')->whereDate('hr.created_at','<',$date)->get();
        $mpt_reserve_rooms = array();
        foreach ($total_mpt_rooms as $key => $value) {
            $type = $value['type'];
            if(isset($mpt_reserve_rooms[$type])){
                $mpt_reserve_rooms[$type] = $mpt_reserve_rooms[$type] + $value['mpt_reserve'];
            }else{
                $mpt_reserve_rooms[$type] = $value['mpt_reserve'];
            }
        }

        $under_cancellation = BookingRoom::from('booking_rooms as br')->leftjoin('bookings as b','b.id','br.booking_id')->where('b.booking_status','Cancellation Requested')->whereDate('br.created_at','<',$date)->get();

        // Customer Care
        $total_calls = CustomerCare::where('method','Call')->whereDate('created_at','<', $date)->get();
        $todays_calls = CustomerCare::where('method','Call')->whereDate('created_at', $date)->get();
        $total_whatsapp = CustomerCare::where('method','Whatsapp')->whereDate('created_at','<', $date)->get();
        $todays_whatsapp = CustomerCare::where('method','Whatsapp')->whereDate('created_at', $date)->get();
        $total_concern = CustomerCare::whereDate('created_at','<',$date)->get();
        $open_concern = CustomerCare::where('status','Open')->whereDate('created_at','<',$date)->get();
        $closed_concern = CustomerCare::where('status','Resolved')->whereDate('created_at','<',$date)->get();
        $mea_pending = CustomerCare::where('pending','MEA')->whereDate('created_at','<',$date)->get();
        $mptdc_pending = CustomerCare::where('pending','MPTDC')->whereDate('created_at','<',$date)->get();


        return view('dashboard::index',['bulk_bookings' => $bulk_bookings, 'mea_bookings' => $mea_bookings, 'online_bookings' => $online_bookings, 'offline_bookings' => $offline_bookings, 'cancellation_request' => $cancellation_request, 'cancellation_approved' => $cancellation_approved, 'refund_requested' => $refund_requested, 'refund_approved' => $refund_approved, 'refund_issued' => $refund_issued, 'adult_guest' => $adult_guest, 'child_guest' => $child_guest, 'room_type_booking' => $room_type_booking_array, 'total_bookings' => $total_bookings, 'booking_received' => $booking_received, 'shared_bookings' => $shared_bookings, 'confirmation_recevied_bookings' => $confirmation_recevied_bookings, 'extra_bed_count' => $extra_bed_count, 'total_payment' => $total_payment, 'payment_confirmed' => $payment_confirmed, 'payment_refund_approved' => $payment_refund_approved, 'payment_refund_issued' => $payment_refund_issued, 'payment' => $payment, 'total_inventory' => $total_inventory, 'allocated_rooms' => $allocated_rooms, 'booked_rooms' => $booked_rooms, 'available_rooms' => $available_rooms, 'mpt_reserve_rooms' => $mpt_reserve_rooms, 'under_cancellation' => $under_cancellation, 'total_calls' => $total_calls, 'todays_calls' => $todays_calls, 'total_whatsapp' => $total_whatsapp, 'todays_whatsapp' => $todays_whatsapp, 'total_concern' => $total_concern, 'open_concern' => $open_concern, 'closed_concern' => $closed_concern, 'mea_pending' => $mea_pending, 'mptdc_pending' => $mptdc_pending, 'date' => $date]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
