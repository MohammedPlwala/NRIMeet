<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;
use Session;
use Auth;
use DB;
use Razorpay\Api\Api;

class HotelController extends Controller
{

    const TEST_URL = 'https://sandboxsecure.payu.in';
    const PRODUCTION_URL = 'https://secure.payu.in';

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
        $classifications = Hotel::from('hotels as h')
                        ->select('h.classification')
                        ->groupby('h.classification')
                        ->get();

        $user = \Auth::user();
        $checkBookedRooms = Booking::from('bookings as b')
                ->select(\DB::Raw('COALESCE(SUM((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id )),0) as rooms'))
                ->where('user_id', $user->id)
                ->first();

        if($checkBookedRooms->rooms >= 2){
            return redirect('/')->with('error', 'You have already booked two rooms');
        }

        Session::put('cartData', '');
        Session::put('billingDetails', '');
        Session::put('bookingData', '');
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
                    // ->where('is_verified',1)
                    ->where('status','active')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {
                            if ($request->get('name') != '') {
                                $query->where('h.name', 'like', '%' . $request->name . '%');
                            }
                            if ($request->get('classification') != '') {
                                $query->where('h.classification', 'like', '%' . $request->classification . '%');
                            }
                        }
                    })
                    ->orderby('h.classification',$request->rating_orderby === 'asc'? 'asc' : 'desc')
                    ->get();


        if(!empty($hotels->toArray())){
            foreach ($hotels as $key => $hotel) {
                $rooms =    HotelRoom::from('hotel_rooms as hr')
                            ->select('hr.id','hr.hotel_id','type_id','hr.name','description','count','rate','extra_bed_available','extra_bed_rate','rt.name as room_type')
                            ->join('room_types as rt','rt.id','=','hr.type_id')
                            ->where('hotel_id',$hotel->id)
                            ->where('hr.status','active')
                            ->where('count','>=',$roomsCount)
                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {
                                    if ($request->get('room_price_min') != '') {
                                        $query->where('rate', '>=', $request->room_price_min);
                                    }
                                    if ($request->get('room_price_max') != '') {
                                        $query->where('rate', '<=', $request->room_price_max );
                                    }
                                }
                            })
                            ->orderBy('rate', 'asc') // desc / asc 
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

    	return view('frontend::booking',['hotels' => $hotels, 'request' => $request, 'classifications' => $classifications]);
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
        $nights = Session::get('nights');

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

        // echo "<pre>";
        // print_r($cartData);
        

        if(isset($request->type)){
            $room = $cartData['rooms'][$request->key];
            if($request->type == 'removeRoom'){
                unset($cartData['rooms'][$request->key]);
            }
            elseif($request->type == 'add'){
                $room->extra_bed_required = 1;
            }else{
                $room->extra_bed_required = 0;
            }
        }

        if(count($cartData['rooms']) <= 0){
            return redirect('/search');
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
        $total = 0; $tax = 0;

        $nights = Session::get('nights');

        foreach ($rooms as $key => $room) {

            $tax_percentage = $amount = $extra_bed_cost = $room_tax = 0;

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

            $extra_bed = 0;
            if($data['extra_bed_required'] == 1){
                // $total += $data['extra_bed_rate']*$nights;
                $extra_bed = 1;
                $extra_bed_cost = $data['extra_bed_rate']*$nights;
            }

            $amount = (($nights*$data['rate'])+$extra_bed_cost);

            if($data['rate'] <= 7500 ){
                $tax_percentage = 12;
                $room_tax = ($amount*($tax_percentage/100));
            }else{
                $tax_percentage = 18;
                $room_tax = ($amount*($tax_percentage/100));
            }
            $tax += $room_tax;
            $total += $amount;

            $roomsData[] =  array(
                                'guests' => $room_one_adult+$room_one_child,
                                'adults' => $room_one_adult,
                                'childs' => $room_one_child,
                                'guest_one_name' => $guest_one_name,
                                'guest_two_name' => $guest_two_name,
                                'guest_three_name' => $guest_three_name,
                                'child_name' => $child_name,
                                'room_id' => $data['id'],
                                'tax' => $room_tax,
                                'tax_percentage' => $tax_percentage,
                                'amount' => $amount,
                                'extra_bed' => $extra_bed,
                                'extra_bed_cost' => $extra_bed_cost,
                            );
        }
        $bookingData =  array(
                            'user_id' => $user->id,
                            'hotel_id' => $cartData['hotel_id'],
                            'check_in_date' => date('Y-m-d',strtotime($cartData['date_from'])),
                            'check_out_date' => date('Y-m-d',strtotime($cartData['date_to'])),
                            'nights' => $cartData['nights'],
                            'amount' => $total,
                            'sub_total' => $total-$tax,
                            'tax' => $tax,
                            'special_request' => $request->special_request,
                            'rooms' => $roomsData,

                        );

        return view('frontend::payment',['bookingData' => $bookingData]);
    }

    public function payment()
    {
        return view('frontend::payment');
    }

    public function myBookings()
    {
        $user = Auth::user();

        $bookings = Booking::from('bookings as b')
                            ->select('h.name as hotel_name','b.*')
                            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                            ->where('user_id',$user->id)
                            ->get();

        if(!empty($bookings->toArray())){
            foreach ($bookings as $key => $booking) {

                $booking->guests = $booking->childs = $booking->adults = 0;

                $bookingRooms = BookingRoom::from('booking_rooms as br')
                                ->select('hr.id','hr.hotel_id','type_id','hr.name','description','count','rate','rt.name as room_type','br.booking_id', 'br.room_id', 'br.amount', 'br.guests', 'br.adults', 'br.childs', 'br.guest_one_name', 'br.guest_two_name', 'br.guest_three_name', 'br.child_name', 'br.extra_bed', 'br.extra_bed_cost')

                                ->join('hotel_rooms as hr','hr.id','=','br.room_id')
                                ->join('room_types as rt','rt.id','=','hr.type_id')
                                ->where('br.booking_id',$booking->id)
                                ->get();

                if(!empty($bookingRooms->toArray())){
                    foreach ($bookingRooms as $key => $room) {
                        $booking->guests += $room->guests;
                        $booking->childs += $room->childs;
                        $booking->adults += $room->adults;
                    }
                    $booking->rooms = $bookingRooms;
                }
            }
        }

        // echo "<pre>";
        // print_r($bookings->toArray());
        // die;

        return view('frontend::myBookings',['bookings' => $bookings]);
    }

    public function bookingPdf(Request $request, $booking_id){
        $booking =  Booking::from('bookings as b')
                    ->select('h.name as hotel','h.address as hotel_address','b.*','u.full_name as guest','u.email as guest_email','h.contact_number','h.contact_person',
                        \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.adults) from booking_rooms where booking_rooms.booking_id = b.id ),0) as adults'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.childs) from booking_rooms where booking_rooms.booking_id = b.id ),0) as childs'),
                    )
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                    ->where('b.id',$booking_id)
                    ->first();

        $booking->adults = $booking->guests-$booking->childs;
        $booking->childs = $booking->guests-$booking->adults;

        $bookingRooms = BookingRoom::from('booking_rooms as br')
                ->select('br.*','hr.rate','rt.name as room_type_name')
                ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->where('br.booking_id',$booking_id)
                ->get();

        $booking->bookingRooms = $bookingRooms;

        $pdf = \PDF::loadView('emails.invoice-format',['booking'=>$booking]);

        if(isset($request->show) && $request->show == 'print_view'){
            return view('emails.invoice-format',['booking'=>$booking]);
        }

        if(isset($request->html) && $request->html == 'true'){
            $pdf = view('emails.invoice-format',['booking'=>$booking])->render();
            return $pdf;
        }else{
            if(isset($request->type) && $request->type == 'print'){
                return $pdf->stream('Booking-'.$booking->order_id.'.pdf');
                exit(0);
            }else{
                return $pdf->download('Booking-'.$booking->order_id.'.pdf');
            }
        }
    }

    public function saveRazorPayPayment(Request $request)
    {
        $input = $request->all();
  
        $api = new Api(config('constants.RAZORPAY_KEY'),config('constants.RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

                if($response->status == 'captured' && $response->captured == 1){
                    \DB::beginTransaction();
                    $bookingData = json_decode($request->bookingData);
                    $billingDetails = json_decode($request->billingData);
                    $booking = $this->bookingSave($bookingData,$billingDetails,$response,'Razorpay',$response->id);
                    return redirect('thankyou?booking_id='.$booking);
                    // $booking_rooms = BookingRoom::where('booking_id',$booking)->get();
                    // if(!empty($booking_rooms->toArray())){
                    //     foreach ($booking_rooms as $key => $booking_room) {
                    //         $hotelRoom = HotelRoom::findorfail($booking_room->room_id);
                    //         if($hotelRoom){
                    //             $hotelRoom->count = $hotelRoom->count-1;
                    //             $hotelRoom->save();
                    //         }
                    //     }
                    // }

                    // \Session::put('date_to', $request->date_to);

                    // Session::forget('billingDetails');
                    // Session::forget('bookingData');
                    // Session::forget('cartData');
                    // Session::forget('date_from');
                    // Session::forget('date_to');
                    // Session::forget('room_one_adult');
                    // Session::forget('room_one_child');
                    // Session::forget('room_two_adult');
                    // Session::forget('room_two_child'); 

                    return view('frontend::thankyou');
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

     public function billDeskForm(Request $request){
        $data = $request->all();
        return view('frontend::bill_desk');
    }

    public function billDeskResponse(Request $request){
        $data = $request->all();
        print_r($data);
        die;
    }

    public function billDeskChecksum(Request $request)
    {

        $url = url('billdesk-payment-response');
        $str = 'MPSTDWCV2|789654|NA|100.00|NA|NA|NA|INR|DIRECT|R|@Mpstdc1978|NA|NA|F|john@doe1.com|8989067984|NA|NA|NA|NA|NA|NA';

        $checksum = hash_hmac('sha256', $str, '6rVIafDL8nyzydKEAEGmXl0srhAENnjx', false);
        $checksum = strtoupper($checksum);
        return $checksum;
    }

    public function razorPayForm(Request $request){
        $data = $request->all();
        if(isset($request->bookingData)){
            $bookingData = json_decode($request->bookingData,true);
            Session::put('bookingData', $bookingData);
        }else{
            $bookingData = Session::get('bookingData');
        }
        unset($data['bookingData']);
        return view('frontend::razorpay_form',['data' => $data,'bookingData' => $bookingData]);
    }

    public function payuPaymentCancel(Request $request){
        return redirect('booking-summary')->with('error', 'Payment failed');
    }


    public function redirectToPayU(Request $request)
    {
        $data = $request->all();

        $billingDetails =   array(
                                'billing_first_name' => $request->billing_first_name,
                                'billing_last_name' => $request->billing_last_name,
                                'billing_company' => $request->billing_company,
                                'billing_country' => $request->billing_country,
                                'billing_state' => $request->billing_state,
                                'billing_city' => $request->billing_city,
                                'billing_address_1' => $request->billing_address_1,
                                'billing_address_2' => $request->billing_address_2,
                                'billing_postcode' => $request->billing_postcode,
                                'pbd_registration_no' => $request->pbd_registration_no,
                                'billing_phone' => $request->billing_phone,
                                'billing_email' => $request->billing_email,
                                'billing_phone2' => $request->billing_phone2,
                                'billing_email2' => $request->billing_email2,
                            );


        if(isset($request->billingData)){
            $billingData = json_decode($request->billingData);
            $billingDetails =   array(
                                'billing_first_name' => $billingData->billing_first_name,
                                'billing_last_name' => $billingData->billing_last_name,
                                'billing_company' => $billingData->billing_company,
                                'billing_country' => $billingData->billing_country,
                                'billing_state' => $billingData->billing_state,
                                'billing_city' => $billingData->billing_city,
                                'billing_address_1' => $billingData->billing_address_1,
                                'billing_address_2' => $billingData->billing_address_2,
                                'billing_postcode' => $billingData->billing_postcode,
                                'pbd_registration_no' => $billingData->pbd_registration_no,
                                'billing_phone' => $billingData->billing_phone,
                                'billing_email' => $billingData->billing_email,
                                'billing_phone2' => $billingData->billing_phone2,
                                'billing_email2' => $billingData->billing_email2,
                            );            
        }

        $bookingData = json_decode($request->bookingData,true);


        // echo "<pre>";
        // print_r($billingDetails);
        // print_r($bookingData);
        // print_r($data);
        // die;

        unset($data['bookingData']);
        unset($data['billing_first_name']);
        unset($data['billing_last_name']);
        unset($data['billing_company']);
        unset($data['billing_country']);
        unset($data['billing_state']);
        unset($data['billing_city']);
        unset($data['billing_address_1']);
        unset($data['billing_address_2']);
        unset($data['billing_postcode']);
        unset($data['pbd_registration_no']);
        unset($data['billing_phone']);
        unset($data['billing_email']);
        unset($data['billing_phone2']);
        unset($data['billing_email2']);
        unset($data['gateway']);
        unset($data['_token']);

        

        $MERCHANT_KEY = config('payu.merchant_key');
        $SALT = config('payu.salt_key');

        $PAYU_BASE_URL = config('payu.test_mode') ? self::TEST_URL : self::PRODUCTION_URL;
        $action = '';

        $posted = array();
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $posted[$key] = $value;
            }
        }

        $formError = 0;

        if (empty($posted['txnid'])) {
            // Generate random transaction id
            $txnid = substr(hash('sha256', mt_rand().microtime()), 0, 20);
        } else {
            $txnid = $posted['txnid'];
        }
        $hash = '';
        // Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if (empty($posted['hash']) && sizeof($posted) > 0) {
            if (
                empty($posted['key'])
                || empty($posted['txnid'])
                || empty($posted['amount'])
                || empty($posted['firstname'])
                || empty($posted['email'])
                || empty($posted['phone'])
                || empty($posted['productinfo'])
                || empty($posted['surl'])
                || empty($posted['furl'])
                || empty($posted['service_provider'])
            ) {
                $formError = 1;
            } else {
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }

                $hash_string .= $SALT;


                $hash = strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL.'/_payment';

            }
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL.'/_payment';

        }

        Session::put('billingDetails', $billingDetails);
        Session::put('bookingData', $bookingData);

        return view('frontend::payu_form',
            compact('hash', 'action', 'MERCHANT_KEY', 'formError', 'txnid', 'posted', 'SALT','billingDetails','bookingData'));
    }

    public function payuSuccess(Request $request)
    {

        $billingDetails = Session::get('billingDetails');
        $bookingData = Session::get('bookingData');

        $data = $request->all();
        
        if(isset($data['status']) && $data['status'] == 'success'){
            $bookingData = json_decode (json_encode ($bookingData), FALSE);
            $billingDetails = json_decode (json_encode ($billingDetails), FALSE);
            $booking = $this->bookingSave($bookingData,$billingDetails,$data,'Payu',$data['txnid']);
            return redirect('thankyou?booking_id='.$booking);

        } else {
            echo "Payment failed";
        }
    }
    
    public function bookingSave($bookingData,$billingDetails,$response = array(),$gateWay,$transaction_id){


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
                $room->tax_percentage = $bookingRoom->tax_percentage;
                $room->tax = $bookingRoom->tax;
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
            $billingDetail->first_name = $billingDetails->billing_first_name;
            $billingDetail->last_name = $billingDetails->billing_last_name;
            $billingDetail->company_name = $billingDetails->billing_company;
            $billingDetail->country = $billingDetails->billing_country;
            $billingDetail->state_province = $billingDetails->billing_state;
            $billingDetail->city = $billingDetails->billing_city;
            $billingDetail->zip_code = $billingDetails->billing_postcode;
            $billingDetail->address_1 = $billingDetails->billing_address_1;
            $billingDetail->address_2 = $billingDetails->billing_address_2;
            $billingDetail->pbd_registration_number = $billingDetails->pbd_registration_no;
            $billingDetail->phone = $billingDetails->billing_phone;
            $billingDetail->email = $billingDetails->billing_email;
            $billingDetail->alternate_phone = $billingDetails->billing_phone2;
            $billingDetail->alternate_email = $billingDetails->billing_email2;
            if(!$billingDetail->save()){

                $user = User::findorfail($bookingData->user_id);
                $user->country = $billingDetails->billing_country;
                $user->city = $billingDetails->billing_city;
                $user->state = $billingDetails->billing_state;
                $user->save();

                \DB::rollback();
                
                return redirect('booking-summary')->with('error', 'Something went wrong with booking');
            }

            $transaction = new Transaction();
            $transaction->booking_id = $booking->id;
            $transaction->transaction_id = $transaction_id;
            $transaction->payment_method = $gateWay;
            $transaction->payment_mode = 'Online';
            $transaction->payment_meta = json_encode($response);
            $transaction->status = 'confirmed';
            if($transaction->save()){
                \DB::commit();
                \Helpers::sendBookingReceiveMails($booking->id);

                return $booking->id;
                return redirect('thankyou?booking_id='.$booking->id)->with('message', 'Booking Successful.');
            }else{
                
                \DB::rollback();
                return redirect('booking-summary')->with('error', 'Something went wrong with booking');
            }
        }else{
            
            \DB::rollback();
            return redirect('booking-summary')->with('error', 'Something went wrong with booking');
        }
    }

    public function bookingConfirmed(Request $request)
    {

        $order_id = "";
        if(isset($request->booking_id)){
            $booking = Booking::findorfail($request->booking_id);

            $order_id = $booking->order_id;

            $booking_rooms = BookingRoom::where('booking_id',$request->booking_id)->get();
            if(!empty($booking_rooms->toArray())){
                foreach ($booking_rooms as $key => $booking_room) {
                    $hotelRoom = HotelRoom::findorfail($booking_room->room_id);
                    if($hotelRoom){
                        $hotelRoom->count = $hotelRoom->count-1;
                        $hotelRoom->save();
                    }
                }
            }
        }

        return view('frontend::thankyou',['order_id'=>$order_id]);
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