<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;
use Session;
use Razorpay\Api\Api;

class HotelController extends Controller
{
	/**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        return view('frontend::index');
    }

    public function search(Request $request)
    {

        Session::put('cartData', '');
        if(isset($request->date_from)){
            \Session::put('date_from', $request->date_from);
        }
        if(isset($request->date_to)){
            \Session::put('date_to', $request->date_to);
        }
        if(isset($request->room_one_adult)){
            \Session::put('room_one_adult', $request->room_one_adult);
        }
        if(isset($request->room_one_child)){
            \Session::put('room_one_child', $request->room_one_child);
        }
        if(isset($request->room_two_adult)){
            \Session::put('room_two_adult', $request->room_two_adult);
        }
        if(isset($request->room_two_child)){
            \Session::put('room_two_child', $request->room_two_child);
        }

        $roomsCount = $nights =  1;
        $guests = $childs = 0;

        if(Session::get('room_one_adult') > 0)
            $guests += Session::get('room_one_adult');

        if(Session::get('room_one_child') > 0)
            $childs += Session::get('room_one_child');

        if(Session::get('room_two_adult') > 0)
            $guests += Session::get('room_two_adult');

        if(Session::get('room_two_adult') > 0)
            $childs += Session::get('room_two_child');


        \Session::put('guests', $guests);
        \Session::put('childs', $childs);

        if(Session::has('date_from') && Session::has('date_to')){
            $date_from = Session::get('date_from');
            $date_to = Session::get('date_to');
            $diff = strtotime($date_to) - strtotime( $date_from);
            $nights = $diff/86400;
        }

        if(Session::has('room_two_adult') && Session::get('room_two_adult') > 0){
            $roomsCount++;
        }

        \Session::put('nights', $nights);
        \Session::put('roomsCount', $roomsCount);

        $hotels =   HotelRoom::from('hotels as h')
                    ->select('id','name','image','classification','description','location','airport_distance','venue_distance','website','contact_person','contact_number')
                    ->where('is_verified',1)
                    ->where('status','active')
                    ->get();


        if(!empty($hotels->toArray())){
            foreach ($hotels as $key => $hotel) {
                $rooms =    HotelRoom::from('hotel_rooms as hr')
                            ->select('hr.id','hr.hotel_id','type_id','hr.name','description','count','rate','extra_bed_available','extra_bed_rate','rt.name as room_type')
                            ->join('room_types as rt','rt.id','=','hr.type_id')
                            ->where('hotel_id',$hotel->id)
                            ->where('hr.status','active')
                            ->where('count','>=',$roomsCount)
                            ->get();

                if(!empty($rooms->toArray())){
                    $hotel->rooms = $rooms;
                }else{
                    unset($hotels[$key]);
                }
            }
        }else{
            $hotels = array();
        }

    	return view('frontend::booking',['hotels' => $hotels]);
    }

    public function addRoom(Request $request){
        $room = json_decode($request->room);
        $hotelId= $room->hotel_id;
        $nights = Session::get('nights');

        if(Session::has('cartData')){
            $cartData = Session::get('cartData');
            if(isset($cartData['rooms'])){
                array_push($cartData['rooms'],$room);
            }else{
                $cartData = array(
                            'hotel_id' => $room->hotel_id,
                            'nights' => Session::get('nights'),
                            'date_from' => Session::get('date_from'),
                            'date_to' => Session::get('date_to'),
                            'guests' => Session::get('guests'),
                            'childs' => Session::get('childs'),
                            'room_one_adult' => Session::get('room_one_adult'),
                            'room_one_child' => Session::get('room_one_child'),
                            'room_two_adult' => Session::get('room_two_adult'),
                            'room_two_child' => Session::get('room_two_child'),
                            'rooms' =>  array(
                                            $room
                                        )
                        );
            }
        }else{
            $cartData = array(
                            'hotel_id' => $room->hotel_id,
                            'nights' => Session::get('nights'),
                            'date_from' => Session::get('date_from'),
                            'date_to' => Session::get('date_to'),
                            'guests' => Session::get('guests'),
                            'childs' => Session::get('childs'),
                            'rooms' =>  array(
                                            $room
                                        )
                        );
        }
        Session::put('cartData', $cartData);


        $roomsCount = Session::get('roomsCount');
        $cartRooms = $cartData['rooms'];
        $addRooms = false;
        
        if(count($cartRooms) < $roomsCount){
            $addRooms = true;
        }

        return array('success' => true,'addRooms' => $addRooms);
    }

    public function bookingSummary(Request $request)
    {
        $user = \Auth::user();
        $cartData = Session::get('cartData');
        $rooms = $cartData['rooms'];

        $hotel = Hotel::findorfail($cartData['hotel_id']);
        if($hotel){
            foreach ($rooms as $key => $room) {
                if(!isset($room->extra_bed_required)){
                    $room->extra_bed_required = 0;
                }

                if($key == 0){
                    $room->room_one_adult = $cartData['room_one_adult'];
                    $room->room_one_child = $cartData['room_one_child'];
                }else{
                    $room->room_two_adult = $cartData['room_two_adult'];
                    $room->room_two_child = $cartData['room_two_child'];
                }
                $room->hotel = $hotel;
            }
        }

        // print_r($request->all());
        // print_r($cartData);

        if(isset($request->type)){
            $room = $cartData['rooms'][$request->key];
            if($request->type == 'add'){
                $room->extra_bed_required = 1;
            }else{
                $room->extra_bed_required = 0;
            }
        }


        Session::put('cartData', $cartData);
        $cartData = Session::get('cartData');
        $rooms = $cartData['rooms'];

        return view('frontend::bookingSummary',['rooms' => $rooms, 'cartData' => $cartData]);
    }

    public function saveGuest(Request $request){

        $user = \Auth::user();

        $cartData = Session::get('cartData');

        $cartRooms = $cartData['rooms'];

        $room_one_adult = $cartData['room_one_adult'];
        $room_one_child = $cartData['room_one_child'];

        $room_two_adult = $cartData['room_two_adult'];
        $room_two_child = $cartData['room_two_child'];
        $rooms = $request->rooms;

        $bookingData = $roomsData = array();
        $total = 0;

        foreach ($rooms as $key => $room) {
            $data = json_decode($room['data'],true);
            $title = $room['title'];
            $first_name = $room['first_name'];
            $last_name = $room['last_name'];
            if(isset($room['child_title'])){
                $child_title = $room['child_title'];
            }
            if(isset($room['child_first_name'])){
                $child_first_name = $room['child_first_name'];
            }
            if(isset($room['child_last_name'])){
                $child_last_name = $room['child_last_name'];
            }

            $guest_one_name = $guest_two_name = $guest_three_name = $child_name = "";
            
            for ($i=0; $i < $room_one_adult ; $i++) { 
                if($i == 0){
                    if(isset($title[$i])){
                        $guest_one_name = $title[$i].' '.$first_name[$i].' '.$last_name[$i];
                    }
                }

                if($i == 1){
                    if(isset($title[$i])){
                        $guest_two_name = $title[$i].' '.$first_name[$i].' '.$last_name[$i];
                    }
                }

                if($i == 2){
                    if(isset($title[$i])){
                        $guest_three_name = $title[$i].' '.$first_name[$i].' '.$last_name[$i];
                    }
                }
            }

            for ($i=0; $i < $room_one_child ; $i++) {
                if($i == 0){
                    if(isset($child_title[$i])){
                        $child_name = $child_title[$i].' '.$child_first_name[$i].' '.$child_last_name[$i];
                    }
                }
            }

            $total += $cartData['nights']*$data['rate'];
            $extra_bed = $extra_bed_cost = 0;
            if($data['extra_bed_required'] == 1){
                $total += $data['extra_bed_rate'];
                $extra_bed = 1;
                $extra_bed_cost = $data['extra_bed_rate'];
            }

            $roomsData[] =  array(
                                'guests' => $room_one_adult+$room_one_child,
                                'adults' => $room_one_adult,
                                'childs' => $room_one_child,
                                'guest_one_name' => $guest_one_name,
                                'guest_two_name' => $guest_two_name,
                                'guest_three_name' => $guest_three_name,
                                'child_name' => $child_name,
                                'room_id' => $data['id'],
                                'amount' => (($cartData['nights']*$data['rate'])+$extra_bed_cost),
                                'extra_bed' => $extra_bed,
                                'extra_bed_cost' => $extra_bed_cost,
                            );
        }
        $tax = ($total*(18/100));
        $bookingData =  array(
                            'user_id' => $user->id,
                            'hotel_id' => $cartData['hotel_id'],
                            'check_in_date' => date('Y-m-d',strtotime($cartData['date_from'])),
                            'check_out_date' => date('Y-m-d',strtotime($cartData['date_to'])),
                            'nights' => $cartData['nights'],
                            'amount' => $total,
                            'sub_total' => $total-$tax,
                            'tax' => $tax,
                            'tax_percentage' => 18,
                            'special_request' => $request->special_request,
                            'rooms' => $roomsData,

                        );

        return view('frontend::payment',['bookingData' => $bookingData]);
    }

    public function payment()
    {
        return view('frontend::payment');
    }

    public function saveRazorPayPayment(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

                if($response->status == 'captured' && $response->captured == 1){
                    \DB::beginTransaction();
                    $bookingData = json_decode($request->bookingData);

                    $booking = new Booking();

                    $booking->order_id = $this->createOrderNumber();
                    $booking->user_id = $bookingData->user_id;
                    $booking->hotel_id = $bookingData->hotel_id;
                    $booking->booking_type = 'Online';
                    $booking->check_in_date = date('Y-m-d',strtotime($bookingData->check_in_date));
                    $booking->check_out_date = date('Y-m-d',strtotime($bookingData->check_out_date));
                    $booking->nights = $bookingData->nights;
                    $booking->sub_total = $bookingData->sub_total;
                    $booking->tax = $bookingData->tax;
                    $booking->tax_percentage = $bookingData->tax_percentage;
                    $booking->amount = $bookingData->amount;
                    $booking->special_request = $bookingData->special_request;
                    $booking->customer_booking_status = 'Received';
                    $booking->booking_status = 'Payment Completed';
                    if($booking->save()){
                        $bookingRooms = $bookingData->rooms;
                        foreach ($bookingRooms as $key => $bookingRoom) {
                            $room = new BookingRoom();
                            $room->booking_id = $booking->id;
                            $room->room_id = $bookingRoom->room_id;
                            $room->amount = $bookingRoom->amount;
                            $room->guests = $bookingRoom->guests;
                            $room->adults = $bookingRoom->adults;
                            $room->childs = $bookingRoom->childs;
                            $room->guest_one_name = $bookingRoom->guest_one_name;
                            $room->guest_two_name = $bookingRoom->guest_two_name;
                            $room->guest_three_name = $bookingRoom->guest_three_name;
                            $room->child_name = $bookingRoom->child_name;
                            $room->extra_bed = $bookingRoom->extra_bed;
                            $room->extra_bed_cost = $bookingRoom->extra_bed_cost;
                            
                            if(!$room->save()){
                                \DB::rollback();
                                return redirect('booking-summary')->with('error', 'Something went wrong with booking');
                            }
                        }

                        $billingDetail = new BillingDetail();

                        $billingDetail->booking_id = $booking->id;
                        $billingDetail->first_name = $request->billing_first_name;
                        $billingDetail->last_name = $request->billing_last_name;
                        $billingDetail->company_name = $request->billing_company;
                        $billingDetail->country = $request->billing_country;
                        $billingDetail->state_province = $request->billing_state;
                        $billingDetail->city = $request->billing_city;
                        $billingDetail->zip_code = $request->billing_postcode;
                        $billingDetail->address_1 = $request->billing_address_1;
                        $billingDetail->address_2 = $request->billing_address_2;
                        $billingDetail->pbd_registration_number = $request->pbd_registration_no;
                        $billingDetail->phone = $request->billing_phone;
                        $billingDetail->email = $request->billing_email;
                        $billingDetail->alternate_phone = $request->billing_phone2;
                        $billingDetail->alternate_email = $request->billing_email2;
                        if(!$billingDetail->save()){
                            \DB::rollback();
                            return redirect('booking-summary')->with('error', 'Something went wrong with booking');
                        }

                        $transaction = new Transaction();
                        $transaction->booking_id = $booking->id;
                        $transaction->transaction_id = $response->id;
                        $transaction->payment_method = 'Razorpay';
                        $transaction->payment_mode = 'Online';
                        $transaction->payment_meta = json_encode($response);
                        $transaction->status = 'confirmed';
                        if($transaction->save()){
                            \DB::commit();
                            return redirect('thankyou')->with('message', 'Booking Successful.');
                        }else{
                            \DB::rollback();
                            return redirect('booking-summary')->with('error', 'Something went wrong with booking');
                        }
                    }else{
                        \DB::rollback();
                        return redirect('booking-summary')->with('error', 'Something went wrong with booking');
                    }
                }
  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }

    public function bookingConfirmed(Request $request)
    {
        return view('frontend::thankyou');
    }

    public function createOrderNumber()
    {
        // Get the last created order
        $lastOrder = Booking::orderBy('id', 'desc')->first();
        $number = 0;

        if ($lastOrder) {
            $number = substr($lastOrder->order_id, 4);
        }

        return 'PBD-' . sprintf('%06d', intval($number) + 1);
    }
}
