<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
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

        $roomsCount = 1;

        if(Session::has('room_two_adult') && Session::get('room_two_adult') > 0){
            $roomsCount++;
        }


        $hotels =   HotelRoom::from('hotels as h')
                    ->select('id','name','image','classification','description','location','airport_distance','venue_distance','website','contact_person','contact_number')
                    ->where('is_verified',1)
                    ->where('status','active')
                    ->get();


        if(!empty($hotels->toArray())){
            foreach ($hotels as $key => $hotel) {
                $rooms =    HotelRoom::from('hotel_rooms as hr')
                            ->select('hr.id','type_id','hr.name','description','count','rate','extra_bed_available','extra_bed_rate','rt.name as room_type')
                            ->join('room_types as rt','rt.id','=','hr.type_id')
                            ->where('hotel_id',$hotel->id)
                            ->where('hr.status','active')
                            ->where('count','>=',$roomsCount)
                            ->get();

                if(!empty($rooms->toArray())){
                    $hotel->rooms = $rooms;
                }else{
                    $hotel = array();
                }
            }
        }else{
            $hotel = array();
        }

    	return view('frontend::booking');
    }
}
