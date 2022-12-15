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
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $bulk_bookings = BulkBooking::get();
        $mea_bookings = BulkBooking::where('booking_person','MEA')->get();
        $online_bookings = Booking::where('booking_type','Online')->get();
        $offline_bookings = Booking::where('booking_type','Offline')->get();

        // Cancellation Stats
        $cancellation_request = Booking::where('booking_status','Cancellation Requested')->get();
        $cancellation_approved = Booking::where('booking_status','Cancellation Approved')->get();

        // Refund Stats
        $refund_requested = Booking::where('booking_status','Refund Requested')->get();
        $refund_approved = Booking::where('booking_status','Refund Approved')->get();
        $refund_issued = Booking::where('booking_status','Refund Issued')->get();
        
        // Guest Stats
        $adult_guest = 0;
        $total_adult_guest = BookingRoom::select(DB::raw("SUM(adults) as total_adults"))->join('bookings as b','booking_rooms.booking_id','b.id')->whereNotIn('b.booking_status', ['Cancellation Requested','Cancellation Approved','Refund Requested','Refund Approved','Refund Issued'])->get();
        if($total_adult_guest){
            $adult_guest = $total_adult_guest[0]->total_adults;
        }

        $child_guest = 0;
        $total_child_guest = BookingRoom::select(DB::raw("SUM(childs) as total_child"))->join('bookings as b','booking_rooms.booking_id','b.id')->whereNotIn('b.booking_status', ['Cancellation Requested','Cancellation Approved','Refund Requested','Refund Approved','Refund Issued'])->get();
        if($total_child_guest){
            $child_guest = $total_child_guest[0]->total_child;
        }

        // Room Type Booking Stats
        $room_type_booking = BookingRoom::select('rt.name')->leftjoin('hotel_rooms as hr','hr.id','booking_rooms.room_id')->leftjoin('room_types as rt','rt.id','hr.type_id')->get()->toArray();
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
        $total_bookings = Booking::get();
        $booking_received = Booking::where('booking_status','Booking Received')->get();
        $shared_bookings = Booking::where('booking_status','Booking Shared')->get();
        $confirmation_recevied_bookings = Booking::where('booking_status','Confirmation Recevied')->get();
        $extra_bed_count = BookingRoom::where('extra_bed',1)->get();

        // Payment Stats
        $total_payment = Booking::select(DB::raw("SUM(amount) as total_amount"))->first();
        $payment_confirmed = Transaction::select(DB::raw("SUM(amount) as confirmed_amount"))->join('bookings as b','b.id','transactions.booking_id')->where('transactions.status','transactions')->first();
        $refund_approved = Booking::select(DB::raw("SUM(amount) as refund_approved_amount"))->where('booking_status','Refund Approved')->first();
        $refund_issued = Booking::select(DB::raw("SUM(amount) as refund_issued_amount"))->where('booking_status','Refund Issued')->first();
        // $room_type_wise_payment = Booking::leftjoin('hotel_rooms as hr','hr.')
             

        return view('dashboard::index',['bulk_bookings' => $bulk_bookings, 'mea_bookings' => $mea_bookings, 'online_bookings' => $online_bookings, 'offline_bookings' => $offline_bookings, 'cancellation_request' => $cancellation_request, 'cancellation_approved' => $cancellation_approved, 'refund_requested' => $refund_requested, 'refund_approved' => $refund_approved, 'refund_issued' => $refund_issued, 'adult_guest' => $adult_guest, 'child_guest' => $child_guest, 'room_type_booking' => $room_type_booking_array, 'total_bookings' => $total_bookings, 'booking_received' => $booking_received, 'shared_bookings' => $shared_bookings, 'confirmation_recevied_bookings' => $confirmation_recevied_bookings, 'extra_bed_count' => $extra_bed_count, 'total_payment' => $total_payment, 'payment_confirmed' => $payment_confirmed, 'refund_approved' => $refund_approved, 'refund_issued' => $refund_issued]);
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
