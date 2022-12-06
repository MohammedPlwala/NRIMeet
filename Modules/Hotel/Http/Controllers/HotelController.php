<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;

// use Modules\user\Entities\User;
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

        $data = Hotel::from('hotels as h')
                ->select('h.*')
                ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                        if ($request->get('name') != '') {
                            $query->where('h.name', $request->get('name'));
                        }
                    }
                })
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

        return view('hotel::index')->with(compact('hotelsCount'));
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

        if(isset($request->hotel_id)){
            $hotel = Hotel::findorfail($request->hotel_id);
            $msg = "Hotel updated successfully";
        }else{
            $hotel = new Hotel();
            $msg = "Hotel added successfully";
        }

        $hotel->name = $request->hotelName;
        $hotel->classification = $request->classification;
        $hotel->location = $request->location;
        $hotel->airport_distance = $request->airport_distance;
        $hotel->website = $request->website;
        $hotel->venue_distance = $request->venue_distance;
        $hotel->contact_person = $request->contact_person;
        $hotel->contact_number = $request->contact_number;
        $hotel->description = $request->description;
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

        $data = HotelRoom::from('hotel_rooms as hr')
                ->select('hr.id', 'hr.hotel_id', 'hr.name', 'hr.type_id', 'hr.description', 'hr.allocated_rooms', 'hr.mpt_reserve', 'hr.count', 'hr.rate', 'hr.extra_bed_available', 'hr.extra_bed_rate', 'hr.status','rt.name as room_type_name','h.name as hotel_name')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->join('hotels as h','h.id','=','hr.hotel_id')
                ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                        if ($request->get('hotel_name') != '') {
                            $query->where('h.name', $request->get('hotel_name'));
                        }

                        if ($request->get('room_name') != '') {
                            $query->where('hr.name', $request->get('room_name'));
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
                        
                        return '₹'.$row->rate;
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
                    ->rawColumns(['action','status',])
                    ->make(true);
        }

        return view('hotel::rooms')->with(compact('roomsCount'));
    }
     /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function roomUpdate()
    {
        $hotels = Hotel::where('status','active')->get();
        $roomTypes = RoomType::where('status','active')->get();

        return view('hotel::roomUpdate',['hotels' => $hotels,'roomTypes' => $roomTypes]);
    }

    public function roomEdit(Request $request,$id)
    {
        $hotels = Hotel::where('status','active')->get();
        $roomTypes = RoomType::where('status','active')->get();
        
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
        }
        $room->status = $request->status;
        
        if($room->save()){
            return redirect('/admin/hotel/rooms')->with('message', $msg);
        }else{
            return redirect('/admin/hotel/rooms/add')->with('error', 'Something went wrong');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function booking()
    {
        $hotels = Hotel::where('status','active')->get();
        $roomTypes = RoomType::where('status','active')->get();
        // $guests = User::where('status','active')->get();
        return view('hotel::booking',['hotels' => $hotels,'roomTypes' => $roomTypes, 
        // 'guests' => $guests
    ]);
        
    }

}
