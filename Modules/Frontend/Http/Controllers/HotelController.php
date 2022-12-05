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
use Session;

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

        // echo "<pre>"; 
        // print_r($rooms); 
        // print_r($cartData); 
        // die;

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
            $child_title = $room['child_title'];
            $child_first_name = $room['child_first_name'];
            $child_last_name = $room['child_last_name'];

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

            $roomsData[] =  array(
                                'guests' => $room_one_adult+$room_one_child,
                                'adults' => $room_one_adult,
                                'childs' => $room_one_child,
                                'guest_one_name' => $guest_one_name,
                                'guest_two_name' => $guest_two_name,
                                'guest_three_name' => $guest_three_name,
                                'child_name' => $child_name,
                                'room_id' => $data['id'],
                                'amount' => ($cartData['nights']*$data['rate']),
                                'extra_bed' => 0,
                                'extra_bed_cost' => 0,
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
                            'rooms' => $roomsData,

                        );


        return view('frontend::payment',['bookingData' => $bookingData]);
    }

    public function payment()
    {
        return view('frontend::payment');
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
