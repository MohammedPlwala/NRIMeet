<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;

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

    	$searchData = 	array(
							'date_from' => $request->date_from,
							'date_to' => $request->date_to,
							'room_one_adult' => $request->room_one_adult,
							'room_one_child' => $request->room_one_child,
							'room_two_adult' => $request->room_two_adult,
							'room_two_child' => $request->room_two_child,
    					);
    	return view('frontend::booking',['date_from' => $request->date_from]);
    }
}