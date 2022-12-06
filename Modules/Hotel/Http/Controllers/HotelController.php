<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
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
    public function index()
    {
        return view('hotel::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hotel::create');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function updateHotel()
    {
        return view('hotel::updateHotel');
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
                           $edit = url('/').'/hotel/rooms/edit'.$row->id;
                           $delete = url('/').'/user/delete/'.$row->id;
                           $confirm = '"Are you sure, you want to delete it?"';

                            $editBtn = "<li>
                                        <a href='".$edit."'>
                                            <em class='icon ni ni-edit'></em> <span>Edit</span>
                                        </a>
                                    </li>";
                           $editBtn = "";
                            
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
    
    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function roomStore(Request $request)
    {   
        echo "<pre>";
        print_r($request->all());
        die;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hotel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hotel::edit');
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
