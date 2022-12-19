<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

use DataTables;

class HotelController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function import()
    {
        $file = fopen('hotels.csv', 'r');
        $hotelsData = [];
        $firstLine = true;

        $room_types =    array(
                            'base' => 1,
                            'premium' => 2,
                            'suite' => 3,
                            'presidential_suite' => 4,
                            'business_center' => 5,
                        );

        while (($column = fgetcsv($file, 0, ',')) !== false) {
            if ($firstLine) {
                $firstLine = false;
                continue;
            }

            $verified = 0;
            if('yes' == strtolower($column[13])){
                $verified = 1;
            }

            if($column[4] != 0){
                $hotel = Hotel::where('name',$column[0])->first();
                if(!$hotel){
                    $hotel = new Hotel();
                    $hotel->name = $column[0];
                    $hotel->classification = $column[10];
                    $hotel->description = $column[10];
                    $hotel->location = '';
                    $hotel->airport_distance = '5';
                    $hotel->venue_distance = '8';
                    $hotel->website = '';
                    $hotel->contact_person = $column[11];
                    $hotel->contact_number = $column[12];
                    $hotel->is_verified = $verified;
                    $hotel->status = 'active';
                    $hotel->save();
                }

                $room_type = strtolower($column[2]);
                $room_type = str_replace(' ', '_', $room_type);

                if(!isset($room_types[$room_type])){
                    echo $column[2]; die;
                }

                $type_id = $room_types[$room_type];

                $hotelRooms = new HotelRoom();
                $hotelRooms->hotel_id = $hotel->id;
                $hotelRooms->name = $column[2];
                // $hotelRooms->name = $column[2];
                $hotelRooms->type_id = $type_id;
                $hotelRooms->description = '';
                $hotelRooms->count = $column[3];
                $hotelRooms->rate = $column[4];
                $hotelRooms->extra_bed_available = 0;
                $hotelRooms->extra_bed_rate = 0;
                $hotelRooms->save();
            }
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try{

            $classifications = \Helpers::hotelClassifications();
            $hotels = \Helpers::hotels();
            
            $room_types = \Helpers::roomTypes();
            $data = Hotel::from('hotels as h')
                    ->select('h.*')
                    // ->Join('hotel_rooms as hr','hr.hotel_id','=','h.id')
                    // ->join('room_types as rt','rt.id','=','hr.type_id')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {

                            if ($request->get('hotel_name') != '') {
                                $query->where('h.name', $request->get('hotel_name'));
                            }

                            if ($request->get('star_rating') != '') {
                                $query->where('h.classification', $request->star_rating);
                            }

                            if ($request->get('hotel_city') != '') {
                                $query->where('h.city', $request->get('hotel_city'));
                            }

                            // if ($request->get('charges') != '') {
                            //     if($request->get('charges') == 1){
                            //         $query->whereBetween('hr.rate', [5000, 10000]);
                            //     }elseif($request->get('charges') == 2){
                            //         $query->whereBetween('hr.rate', [10000, 15000]);
                            //     }elseif($request->get('charges') == 3){
                            //         $query->whereBetween('hr.rate', [15000, 20000]);
                            //     }elseif($request->get('charges') == 4){
                            //         $query->where('hr.rate','>', 20000);
                            //     }
                            // }

                            if ($request->get('distance_from_airport') != '' && $request->get('distance_from_airport') > 25) {
                                $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                                $query->where('h.airport_distance','>=', 25);
                            }elseif ($request->get('distance_from_airport') != '') {
                                $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                            }

                            if ($request->get('distance_from_venue') != '' && $request->get('distance_from_venue') > 25) {
                                $query->where('h.venue_distance','<=', $request->get('distance_from_venue'));
                                $query->where('h.venue_distance','>=', 25);
                            }elseif ($request->get('distance_from_venue') != '') {
                                $query->where('h.venue_distance','<=', $request->get('distance_from_venue'));
                            }

                            if ($request->get('status') != '') {
                                $query->where('h.status', $request->get('status'));
                            }
                        }
                    })
                    ->groupBy('h.id')
                    ->orderby('h.id','desc')
                    ->get();

            $hotelsCount = 0;
            if(!empty($data->toArray())){
                $hotelsCount = count($data);
            }

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
                        ->addColumn('action', function($row) {
                               $edit = url('/').'/admin/hotel/edit/'.$row->id;
                               $delete = url('/').'/admin/hotel/delete/'.$row->id;
                               $confirm = '"Are you sure, you want to delete it?"';

                                $editBtn = "<li>
                                            <a href='".$edit."'>
                                                <em class='icon ni ni-edit'></em> <span>Edit</span>
                                            </a>
                                        </li>";
                                
                                $deleteBtn = "<li>
                                            <a href='".$delete."' onclick='return confirm(".$confirm.")'  class='delete'>
                                                <em class='icon ni ni-trash'></em> <span>Delete</span>
                                            </a>
                                        </li>"; 

                                $btn = '';
                                $btn .= '<ul class="nk-tb-actio ns gx-1">
                                            <li>
                                                <div class="drodown mr-n1">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                            ';

                               $btn .=       $editBtn."
                                            ".$deleteBtn;

                                $btn .= "</ul>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>";
                            return $btn;
                        })
                        ->rawColumns(['action','status',])
                        ->make(true);
            }

            return view('hotel::index', ['classifications' => $classifications, 'room_types' => $room_types, 'hotels' => $hotels])->with(compact('hotelsCount'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hotel::updateHotel');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function edit($id)
    {
        $hotel = Hotel::findorfail($id);
        return view('hotel::updateHotel',['hotel' => $hotel]);
    }

    public function store(Request $request)
    {

        try{

            if(isset($request->hotel_id)){
                $hotel = Hotel::findorfail($request->hotel_id);
                $msg = "Hotel updated successfully";
            }else{
                $hotel = new Hotel();
                $msg = "Hotel added successfully";
            }

            $hotel->name = $request->hotelName;
            $hotel->city = $request->city;
            $hotel->classification = $request->classification;
            $hotel->location = $request->location;
            $hotel->airport_distance = $request->airport_distance;
            $hotel->website = $request->website;
            $hotel->venue_distance = $request->venue_distance;
            $hotel->contact_person = $request->contact_person;
            $hotel->contact_number = $request->contact_number;
            $hotel->email = $request->email;
            $hotel->description = $request->description;
            $hotel->address = $request->address;
            $hotel->status = $request->status;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileNameWithExt = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $fileName = preg_replace("/[^A-Za-z0-9 ]/", '', $fileName);
                $fileName = preg_replace("/\s+/", '-', $fileName);
                $extension = $file->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
                $destinationPath = public_path("uploads/hotels/");
                //Move Uploaded File
                $file->move($destinationPath,$fileName);
                $hotel->image = $fileName;
           }
            
            if($hotel->save()){
                return redirect('/admin/hotel')->with('message', $msg);
            }else{
                return redirect('/admin/hotel/add')->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }

    public function destroy(Request $request,$id){
        $hotel = Hotel::findorfail($id);
        if($hotel->forceDelete()){
            return redirect('/admin/hotel')->with('message', 'Deleted Successfully');
        }
    }

    public function destroyRoom(Request $request,$id){
        $room = HotelRoom::findorfail($id);
        if($room->forceDelete()){
            return redirect('/admin/hotel/rooms')->with('message', 'Deleted Successfully');
        }
    }

     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function rooms(Request $request)
    {
        $hotels = Hotel::from('hotels as h')
        ->select('h.name', 'h.id')->get();

        $room_types = \Helpers::roomTypes();
        $data = HotelRoom::from('hotel_rooms as hr')
                ->select('hr.id', 'hr.hotel_id', 'hr.name', 'hr.type_id', 'hr.description', 'hr.allocated_rooms', 'hr.mpt_reserve', 'hr.count', 'hr.rate', 'hr.extra_bed_available', 'hr.extra_bed_rate', 'hr.status','rt.name as room_type_name','h.name as hotel_name')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->join('hotels as h','h.id','=','hr.hotel_id')
                ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                        if ($request->get('hotel_name') != '') {
                            $query->where('h.name', $request->get('hotel_name'));
                        }

                        if ($request->get('room_type') != '') {
                            $query->where('hr.type_id', $request->get('room_type'));
                        }

                        if ($request->get('status') != '') {
                            $query->where('hr.status', $request->get('status'));
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


                    }
                })
                ->orderby('hr.id','desc')
                ->get();

        $roomsCount = 0;
        if(!empty($data->toArray())){
            $roomsCount = count($data);
        }

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
                    ->addColumn('rate', function ($row) { 
                        return '₹'.number_format($row->rate, 2);
                    })
                    ->addColumn('extra_bed_available', function ($row) { 
                        $extra_bed_available = 'No';
                        if($row->extra_bed_available){
                            $extra_bed_available = 'Yes';
                        }
                        return $extra_bed_available;
                    })
                    ->addColumn('extra_bed_rate', function ($row) { 
                        return '₹'.number_format($row->extra_bed_rate, 2);
                    })
                    ->addColumn('action', function($row) {
                           $edit = url('/').'/admin/hotel/rooms/edit/'.$row->id;
                           $delete = url('/').'/admin/hotel/rooms/delete/'.$row->id;
                           $confirm = '"Are you sure, you want to delete it?"';

                            $editBtn = "<li>
                                        <a href='".$edit."'>
                                            <em class='icon ni ni-edit'></em> <span>Edit</span>
                                        </a>
                                    </li>";
                            
                            $deleteBtn = "<li>
                                        <a href='".$delete."' onclick='return confirm(".$confirm.")'  class='delete'>
                                            <em class='icon ni ni-trash'></em> <span>Delete</span>
                                        </a>
                                    </li>"; 

                            $btn = '';
                            $btn .= '<ul class="nk-tb-actio ns gx-1">
                                        <li>
                                            <div class="drodown mr-n1">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                        ';

                           $btn .=       $editBtn."
                                        ".$deleteBtn;

                            $btn .= "</ul>
                                            </div>
                                        </div>
                                    </li>
                                    </ul>";
                        return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }

        return view('hotel::rooms',['room_types' => $room_types, 'hotels' => $hotels])->with(compact('roomsCount'));
    }
     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function roomUpdate()
    {
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();

        return view('hotel::roomUpdate',['hotels' => $hotels,'roomTypes' => $roomTypes]);
    }

    public function roomEdit(Request $request,$id)
    {
        $hotels = Hotel::all();
        $roomTypes = RoomType::all();
        
        $room = HotelRoom::findorfail($id);

        return view('hotel::roomUpdate',['hotels' => $hotels,'roomTypes' => $roomTypes,'room' => $room]);
    }
    
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function roomStore(Request $request)
    {

        try{

            if(isset($request->room_id)){
                $room = HotelRoom::findorfail($request->room_id);
                $currentCount = $room->count;
                $currentAllocated = $room->allocated_rooms;
                $currentMpt= $room->mpt_reserve;
                $currentBooked = (($currentAllocated-$currentMpt)-$currentCount);
                $newAvailable = (($request->allocated_rooms-$request->mpt_reserve)-$currentBooked);

                if($request->allocated_rooms < $currentBooked){
                    return redirect('admin/hotel/rooms/edit/'.$request->room_id)->with('error', 'Allocated rooms can not be less than booked rooms');
                }

                $room->allocated_rooms = $request->allocated_rooms;
                $room->mpt_reserve = $request->mpt_reserve;
                $room->count = $newAvailable;

                $msg = "Room updated successfully";

            }else{
                $room = new HotelRoom();
                $room->allocated_rooms = $request->allocated_rooms;
                $room->mpt_reserve = $request->mpt_reserve;
                $room->count = $request->allocated_rooms-$request->mpt_reserve;
                $msg = "Room added successfully";
            }

            $room->hotel_id = $request->hotel;
            $room->name = $request->room_name;
            $room->type_id = $request->room_type;

            $room->rate = $request->rate;
            $room->extra_bed_available = $request->extra_bed_available;

            if($request->extra_bed_available){
                $room->extra_bed_rate = $request->extra_bed_rate;
            }else{
                $room->extra_bed_rate = 0;
            }
            $room->status = $request->status;
            
            if($room->save()){
                return redirect('/admin/hotel/rooms')->with('message', $msg);
            }else{
                return redirect('/admin/hotel/rooms/add')->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function bookingList(Request $request){

        $hotels = \Helpers::hotels();

        $data = Booking::from('bookings as b')
                            ->select('h.name as hotel','b.*','u.full_name as guest',
                                \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                            )
                            ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                            ->leftJoin('users as u','u.id','=','b.user_id')
                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {
                                    if ($request->get('hotel_name') != '') {
                                        $query->where('h.name', $request->get('hotel_name'));
                                    }

                                    if ($request->get('check_in_date') != '') {
                                        $query->whereDate('b.check_in_date', date('Y-m-d', strtotime($request->get('check_in_date'))));
                                    }

                                    if ($request->get('check_out_date') != '') {
                                        $query->whereDate('b.check_out_date', date('Y-m-d', strtotime($request->get('check_out_date'))));
                                    }

                                    // if ($request->get('room_name') != '') {
                                    //     $query->where('hr.name', $request->get('room_name'));
                                    // }

                                    if ($request->get('booking_type') != '') {
                                        $query->where('b.booking_type', $request->get('booking_type'));
                                    }

                                    if ($request->get('booking_status') != '') {
                                        $query->where('b.booking_status', $request->get('booking_status'));
                                    }
                                }
                            })
                            ->orderby('b.created_at','desc')
                            ->get();

        $bookingsCount = 0;
        if(!empty($data->toArray())){
            $bookingsCount = count($data);
        }

        if ($request->ajax()) {
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('order_id', function ($row) {

                        if($row->booking_status == 'Void'){
                            $detailUrl = '#';
                        }else{
                            $detailUrl = \URL::to('admin/bookings/edit/'.$row->id);
                        }

                        $order_id = '<a href="'.$detailUrl.'" ><span>'. $row->order_id .'</span></a>';
                        return $order_id;
                    })
                    ->addColumn('confirmation_number', function ($row) {
                        if(is_null($row->confirmation_number)){
                            $confirmation_number = "-";
                        }else{
                            $confirmation_number = $row->confirmation_number;
                        }
                        return $confirmation_number;
                    })
                    ->addColumn('amount', function ($row) {
                        return '₹'.number_format($row->amount, 2);
                    })
                    
                    ->addColumn('booking_type', function ($row) {
                        $booking_type_class = 'success';
                        if($row->booking_type == 'Online'){
                            $booking_type_class = 'success';
                        }
                        if($row->booking_type == 'Offline'){
                            $booking_type_class = 'danger';
                        }
                        $booking_type = '<span class="badge badge-'.$booking_type_class.'" >'. $row->booking_type .'</span>';
                        return $booking_type;
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

                        if($row->booking_status == 'Void'){
                            $booking_status_class = 'light';
                        }

                        $booking_status = '<span class="badge badge-'.$booking_status_class.'" >'. $row->booking_status .'</span>';
                        return $booking_status;
                    })
                    ->addColumn('checkin_date', function ($row) {
                        $checkin_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_in_date));
                        return $checkin_date;
                    })
                    ->addColumn('checkout_date', function ($row) {
                        $checkout_date = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->check_out_date));
                        return $checkout_date;
                    })
                    ->addColumn('booked_on', function ($row) {
                        $booked_on = date(\Config::get('constants.DATE.DATE_FORMAT_FULL') , strtotime($row->created_at));
                        return $booked_on;
                    })
                    ->addColumn('action', function($row) {
                            if($row->booking_status == 'Void'){
                                return $btn = '';
                            }
                           $edit = url('/').'/admin/bookings/edit/'.$row->id;
                           $confirm = '"Are you sure, you want to delete it?"';

                            $editBtn = "<li>
                                        <a href='".$edit."'>
                                            <em class='icon ni ni-edit'></em> <span>Edit</span>
                                        </a>
                                    </li>";

                            $btn = '';
                            $btn .= '<ul class="nk-tb-actio ns gx-1">
                                        <li>
                                            <div class="drodown mr-n1">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                        ';

                            $btn .=       $editBtn;

                            $btn .= "</ul>
                                            </div>
                                        </div>
                                    </li>
                                    </ul>";
                        return $btn;
                    })
                    ->rawColumns(['action','status','order_id', 'booking_type','booking_status','confirmation_number'])
                    ->make(true);
        }

        return view('hotel::bookingList')->with(compact('bookingsCount','hotels'));
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

    public function storeBooking(Request $request){
        try {

            $bookingRoomsData = array();

            \DB::beginTransaction();

            $diff = strtotime($request->checkout_date) - strtotime($request->checkin_date);
            $nights = $diff/86400;
            $total = 0; $tax = 0;

            $rooms = $request->rooms;
            foreach ($rooms as $key => $room) {

                $tax_percentage = $amount = $extra_bed_cost = $room_tax = 0;

                if($key == 0){

                    $type_id = $request->room_one_type;

                    $data = json_decode($request->room_one_data,true);
                    $adults = $request->room_one_adult;
                    $childs = $request->room_one_child;

                    // $total += $nights*$data['rate'];
                    $extra_bed = $extra_bed_cost = 0;
                    if($request->room_one_extraBed == 1){
                        // $total += ($data['extra_bed_rate']*$nights);
                        $extra_bed = 1;
                        $extra_bed_cost = ($data['extra_bed_rate']*$nights);
                    }

                }else{
                    $data = json_decode($request->room_two_data,true);
                    $adults = $request->room_two_adult;
                    $childs = $request->room_two_child;

                    // $total += $nights*$data['rate'];
                    $extra_bed = $extra_bed_cost = 0;
                    if($request->room_two_extraBed == 1){
                        // $total += ($data['extra_bed_rate']*$nights);
                        $extra_bed = 1;
                        $extra_bed_cost = ($data['extra_bed_rate']*$nights);
                    }
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

                $guest_one_name = $guest_two_name = $guest_three_name = $child_name = Null;

                for ($i=0; $i < $adults ; $i++) {

                    if($i == 0){
                        $guest_one_name = $room['title'][$i].' '.$room['first_name'][$i].' '.$room['last_name'][$i];
                    }

                    if($i == 1){
                        $guest_two_name = $room['title'][$i].' '.$room['first_name'][$i].' '.$room['last_name'][$i];   
                    }

                    if($i == 2){
                        $guest_three_name = $room['title'][$i].' '.$room['first_name'][$i].' '.$room['last_name'][$i];   
                    }
                }

                if($childs > 0){
                    $child_name = $room['child_title'][0].' '.$room['child_first_name'][0].' '.$room['child_last_name'][0];   
                }

                $bookingRoomsData[] =  array(
                                'guests' => $adults+$childs,
                                'adults' => $adults,
                                'childs' => $childs,
                                'guest_one_name' => $guest_one_name,
                                'guest_two_name' => $guest_two_name,
                                'guest_three_name' => $guest_three_name,
                                'child_name' => $child_name,
                                'room_id' => $data['id'],
                                'tax_percentage' => $tax_percentage,
                                'tax' => $room_tax,
                                'amount' => $amount,
                                'extra_bed' => $extra_bed,
                                'extra_bed_cost' => $extra_bed_cost,
                            );
            }

            $booking = new Booking();
            $booking->order_id = $this->createOrderNumber();
            $booking->user_id = $request->guest;
            $booking->hotel_id = $request->hotel;
            $booking->check_in_date = date('Y-m-d',strtotime($request->checkin_date));
            $booking->check_out_date = date('Y-m-d',strtotime($request->checkout_date));
            $booking->nights = $nights;
            $booking->amount = $total;
            $booking->sub_total = $total-$tax;
            $booking->tax = $tax;
            $booking->special_request = "";
            $booking->customer_booking_status = 'Received';
            $booking->booking_status = 'Booking Received';
            $booking->booking_type = 'Offline';

            if($booking->save()){
                foreach ($bookingRoomsData as $key => $bookingRoom) {
                    $room = new BookingRoom();
                    $room->booking_id = $booking->id;
                    $room->room_id = $bookingRoom['room_id'];
                    $room->tax_percentage = $bookingRoom['tax_percentage'];
                    $room->tax = $bookingRoom['tax'];
                    $room->amount = $bookingRoom['amount'];
                    $room->guests = $bookingRoom['guests'];
                    $room->adults = $bookingRoom['adults'];
                    $room->childs = $bookingRoom['childs'];
                    $room->guest_one_name = $bookingRoom['guest_one_name'];
                    $room->guest_two_name = $bookingRoom['guest_two_name'];
                    $room->guest_three_name = $bookingRoom['guest_three_name'];
                    $room->child_name = $bookingRoom['child_name'];
                    $room->extra_bed = $bookingRoom['extra_bed'];
                    $room->extra_bed_cost = $bookingRoom['extra_bed_cost'];
                    
                    if(!$room->save()){
                        \DB::rollback();
                        return redirect('/admin/bookings/add')->with('error', 'Something went wrong');
                    }else{
                        $hotelRoom = HotelRoom::findorfail($bookingRoom['room_id']);
                        if($hotelRoom){
                            $hotelRoom->count = $hotelRoom->count-1;
                            $hotelRoom->save();
                        }
                    }

                    
                }

                $billingDetail = new BillingDetail();

                $guest = User::findorfail($request->guest);

                $billingDetail->booking_id = $booking->id;
                $billingDetail->first_name = $guest->full_name;
                $billingDetail->country = $guest->country;
                $billingDetail->zip_code = $guest->zip;
                $billingDetail->address_1 = $guest->address;
                $billingDetail->phone = $guest->mobile;
                $billingDetail->email = $guest->email;

                if($billingDetail->save()){
                    \DB::commit();
                    \Helpers::sendBookingReceiveMails($booking->id);
                    return redirect('/admin/bookings')->with('message', 'Booking added successfully');
                }else{
                    \DB::rollback();
                    return redirect('/admin/bookings/add')->with('error', 'Something went wrong');
                }
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    public function createBooking()
    {
        $users = User::select('id')->get();
        $hotels = Hotel::all();
        
        $roomTypes = RoomType::all();

        $guests =   User::from('users as u')
                    ->select('u.id','u.full_name')
                    ->leftJoin('user_role as ur','u.id','=','ur.user_id')
                    ->leftJoin('roles as r','ur.role_id','=','r.id')
                    ->where('r.name','Guest')
                    ->where('u.status','active')
                    ->get();
        return view('hotel::addBooking',['hotels' => $hotels,'roomTypes' => $roomTypes,'guests' => $guests]);
        
    }

    public function editBooking(Request $request,$booking_id)
    {
        try{

            $booking = Booking::findorfail($booking_id);

            $users = User::select('id')->get();
            $hotels = Hotel::all();
            
            $roomTypes = RoomType::all();

            $bookingRooms = BookingRoom::from('booking_rooms as br')
                    ->select('br.*','hr.rate')
                    ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                    ->where('br.booking_id',$booking_id)
                    ->get();

            $guests =   User::from('users as u')
                        ->select('u.id','u.full_name')
                        ->leftJoin('user_role as ur','u.id','=','ur.user_id')
                        ->leftJoin('roles as r','ur.role_id','=','r.id')
                        ->where('r.name','Guest')
                        ->where('u.status','active')
                        ->get();

            $transaction = Transaction::where('booking_id',$booking->id)->first();
            if($transaction){
                $booking->transaction_id = $transaction->transaction_id;
                $booking->payment_method = $transaction->payment_method;
            }


            return view('hotel::editBooking',['booking' => $booking,'hotels' => $hotels,'roomTypes' => $roomTypes,'guests' => $guests,'bookingRooms' => $bookingRooms->toArray()]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
        
    }

    public function updateBooking(Request $request,$booking_id){

        try{



            $bookingRoomsData = array();

            \DB::beginTransaction();

            $diff = strtotime($request->checkout_date) - strtotime($request->checkin_date);
            $nights = $diff/86400;
            $total = 0; $tax = 0;

            $rooms = $request->rooms;

            foreach ($rooms as $key => $room) {
                $tax_percentage = $amount = $extra_bed_cost = $room_tax = 0;

                if($key == 0){
                    $type_id = $request->room_one_type;
                    $data = json_decode($request->room_one_data,true);
                    $adults = $request->room_one_adult;
                    $childs = $request->room_one_child;

                    // $total += $nights*$data['rate'];
                    $extra_bed = $extra_bed_cost = 0;
                    if($request->room_one_extraBed == 1){
                        // $total += ($data['extra_bed_rate']*$nights);
                        $extra_bed = 1;
                        $extra_bed_cost = ($data['extra_bed_rate']*$nights);
                    }
                }else{
                    $data = json_decode($request->room_two_data,true);
                    $adults = $request->room_two_adult;
                    $childs = $request->room_two_child;

                    // $total += $nights*$data['rate'];
                    $extra_bed = $extra_bed_cost = 0;
                    if($request->room_two_extraBed == 1){
                        // $total += ($data['extra_bed_rate']*$nights);
                        $extra_bed = 1;
                        $extra_bed_cost = ($data['extra_bed_rate']*$nights);
                    }
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

                $guest_one_name = $guest_two_name = $guest_three_name = $child_name = Null;

                for ($i=0; $i < $adults ; $i++) {
                    if($i == 0){
                        $guest_one_name = $room['first_name'][$i];
                    }

                    if($i == 1){
                        $guest_two_name = $room['first_name'][$i];   
                    }

                    if($i == 2){
                        $guest_three_name = $room['first_name'][$i];   
                    }
                }

                if($childs > 0){
                    $child_name = $room['child_first_name'][0];   
                }

                $bookingRoomsData[] =  array(
                                    'guests' => $adults+$childs,
                                    'adults' => $adults,
                                    'childs' => $childs,
                                    'guest_one_name' => $guest_one_name,
                                    'guest_two_name' => $guest_two_name,
                                    'guest_three_name' => $guest_three_name,
                                    'child_name' => $child_name,
                                    'room_id' => $data['id'],
                                    'tax_percentage' => $tax_percentage,
                                    'tax' => $room_tax,
                                    'amount' => $amount,
                                    'extra_bed' => $extra_bed,
                                    'extra_bed_cost' => $extra_bed_cost,
                                );
            }


            $booking = Booking::findorfail($booking_id);

            $oldGuestId = $booking->user_id;

            $booking->user_id = $request->guest;
            $booking->hotel_id = $request->hotel;
            $booking->check_in_date = date('Y-m-d',strtotime($request->checkin_date));
            $booking->check_out_date = date('Y-m-d',strtotime($request->checkout_date));
            $booking->nights = $nights;
            $booking->amount = $total;
            $booking->sub_total = $total-$tax;
            $booking->tax = $tax;
            $booking->special_request = $request->special_request;

            
            if(isset($request->cancellation_date)){
                $booking->cancellation_date = date('Y-m-d',strtotime($request->cancellation_date));
            }
            if(isset($request->cancellation_charges)){
                $booking->cancellation_charges = $request->cancellation_charges;
            }


            if(isset($request->refund_date)){
                $booking->refund_date = date('Y-m-d',strtotime($request->refund_date));
            }

            if(isset($request->refundable_amount)){
                $booking->refundable_amount = $request->refundable_amount;
            }

            if(isset($request->refund_transaction_utr)){
                $booking->refund_transaction_utr = $request->refund_transaction_utr;
            }

            if(isset($request->settlement_id)){
                $booking->settlement_id = $request->settlement_id;
            }

            $booking->customer_booking_status = 'Received';
            
            if($request->status == 'Confirmation Recevied'){
                $booking->customer_booking_status = 'Confirmed';
            }

            if($request->status == 'Cancellation Requested'){
                $booking->cancellation_request_date = date('Y-m-d');
                $booking->customer_booking_status = 'Cancellation In Progress';
            }

            if($request->status == 'Cancellation Approved'){
                $booking->customer_booking_status = 'Cancellation Approved';
            }

            if($request->status == 'Refund Requested' || $request->status == 'Refund Approved'){
                $booking->customer_booking_status = 'Refund In Progress';
            }

            if($request->status == 'Refund Requested'){
                $booking->refund_request_date = date('Y-m-d');
            }

            if($request->status == 'Refund Issued'){
                $booking->customer_booking_status = 'Refunded';
            }
            $booking->booking_status = $request->status;



            // $booking->booking_type = 'Offline';
            $booking->confirmation_number = $request->confirmation_number;
            $booking->utr_number = $request->utr_number;
            $booking->settlement_date = date('Y-m-d',strtotime($request->settlement_date));
            if($booking->save()){

                $oldRooms = BookingRoom::select(\DB::Raw('GROUP_CONCAT(room_id) as room_ids'))->where('booking_id',$booking_id)->first();
                $oldRooms = explode(',',$oldRooms->room_ids);


                BookingRoom::where('booking_id',$booking_id)->forceDelete();

                $roomIds = array();

                foreach ($bookingRoomsData as $key => $bookingRoom) {

                    $refundable_amount = 0;

                    if(isset($request->cancellation_charges)){
                        $cancellation_charges = ($bookingRoom['amount']*($request->cancellation_charges/100));
                        $refundable_amount = $bookingRoom['amount']-$cancellation_charges;
                    }

                    $roomIds[] = $bookingRoom['room_id'];

                    $room = new BookingRoom();
                    $room->booking_id = $booking->id;
                    $room->room_id = $bookingRoom['room_id'];
                    $room->amount = $bookingRoom['amount'];
                    $room->refundable_amount = $refundable_amount;
                    $room->tax_percentage = $bookingRoom['tax_percentage'];
                    $room->tax = $bookingRoom['tax'];
                    $room->guests = $bookingRoom['guests'];
                    $room->adults = $bookingRoom['adults'];
                    $room->childs = $bookingRoom['childs'];
                    $room->guest_one_name = $bookingRoom['guest_one_name'];
                    $room->guest_two_name = $bookingRoom['guest_two_name'];
                    $room->guest_three_name = $bookingRoom['guest_three_name'];
                    $room->child_name = $bookingRoom['child_name'];
                    $room->extra_bed = $bookingRoom['extra_bed'];
                    $room->extra_bed_cost = $bookingRoom['extra_bed_cost'];
                    
                    if(!$room->save()){
                        \DB::rollback();
                        return redirect('/admin/bookings/edit/'.$booking_id)->with('error', 'Something went wrong');
                    }else{

                        $hotelRoom = HotelRoom::findorfail($bookingRoom['room_id']);
                        if($hotelRoom){
                            if(!in_array($bookingRoom['room_id'], $oldRooms)){
                                $hotelRoom->count = $hotelRoom->count-1;
                            }
                            $hotelRoom->save();
                        }
                    }
                }

                if($request->status != 'Cancellation Approved' && $request->status != 'Refund Requested' && $request->status != 'Refund Approved'){
                    $diffRooms = array_diff($roomIds, $oldRooms);
                    $this->updateCancelInventory($diffRooms);
                }

                if((isset($request->payment_mode) || isset($request->payment_method)) && isset($request->transaction_id)){
                    $transaction = Transaction::where('booking_id',$booking->id)->first();
                    
                    if(!$transaction){
                        $transaction = new Transaction();
                    }

                    $transaction->booking_id = $booking->id;
                    $transaction->transaction_id = $request->transaction_id;
                    $transaction->payment_method = $request->payment_method;
                    $transaction->payment_mode = $request->payment_mode;
                    $transaction->status = 'confirmed';
                    $transaction->save();
                }



                if($request->guest != $oldGuestId){
                    BillingDetail::where('booking_id',$booking_id)->forceDelete();

                    $guest = User::findorfail($request->guest);

                    $billingDetail->booking_id = $booking->id;
                    $billingDetail->first_name = $guest->full_name;
                    $billingDetail->country = $guest->country;
                    $billingDetail->zip_code = $guest->zip;
                    $billingDetail->address_1 = $guest->address;
                    $billingDetail->phone = $guest->mobile;
                    $billingDetail->email = $guest->email;

                    if($billingDetail->save()){
                        \DB::commit();
                        return redirect('/admin/bookings')->with('message', 'Booking updated successfully');
                    }else{
                        \DB::rollback();
                        return redirect('/admin/bookings/edit/'.$booking_id)->with('error', 'Something went wrong');
                    }
                }

                if($request->status == 'Confirmation Recevied' && $request->confirmation_number != ""){
                    \Helpers::sendBookingConfirmationMails($booking->id);
                }

                if($request->status == 'Cancellation Requested'){
                    \Helpers::sendCancellationReceivedMail($booking->id);
                }

                if($request->status == 'Cancellation Approved'){
                    $this->updateCancelInventory($roomIds);
                    \Helpers::sendCancellationApprovedMail($booking->id);
                }

                if($request->status == 'Void'){
                    $this->updateCancelInventory($roomIds);
                }


                if($request->status == 'Refund Requested'){
                    \Helpers::sendRefundProcessedMail($booking->id);   
                }

                if($request->status == 'Refund Approved'){
                    \Helpers::sendRefundApprovedMail($booking->id);
                }

                

                \DB::commit();
                return redirect('/admin/bookings')->with('message', 'Booking updated successfully');
            }

        } catch (Exception $e) {
            return redirect('/admin/bookings')->with('error', $e->getMessage());
        }
    }

    public function updateCancelInventory($roomIds = array()){

        if(!empty($roomIds)){
            foreach ($roomIds as $key => $room_id) {
                $hotelRoom = HotelRoom::findorfail($room_id);
                if($hotelRoom){
                    $hotelRoom->count = $hotelRoom->count+1;
                    $hotelRoom->save();
                }
            }
        }

        return true;
    }



    public function hotelRooms(Request $request,$hotel_id){
        $hotelRooms = HotelRoom::from('hotel_rooms as hr')
                ->select('hr.id', 'hr.hotel_id', 'hr.name', 'hr.type_id', 'hr.description', 'hr.allocated_rooms', 'hr.mpt_reserve', 'hr.count', 'hr.rate', 'hr.extra_bed_available', 'hr.extra_bed_rate', 'hr.status','rt.name as room_type_name')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->where('hr.hotel_id',$hotel_id)
                ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                        if (isset($request->requestFor) && $request->requestFor != '') {
                            $query->where('hr.count', ">" ,0);
                        }
                    }
                })
                // ->where('hr.status', 'active')
                ->orderby('rt.name','asc')
                ->get();
        if(!empty($hotelRooms->toArray())){
            return array('success' => true,'hotelRooms' => $hotelRooms);
        }else{
            return array('success' => false,'hotelRooms' => array());
        }
    }
    public function bulkBooking(){
       return view('hotel::bulkBooking');
    }

    

}
