<?php

namespace Modules\HomeStay\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeStayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('homestay::index');



        $hotels = Hotel::get();
        $room_types = \Helpers::roomTypes();

        $data = BulkBooking::select('bulk_bookings.*','h.name as hotel_name','rt.name as room_type')->leftJoin('hotels as h','h.id','bulk_bookings.hotel_id')->leftJoin('hotel_rooms as hr','hr.id','bulk_bookings.room_type_id')->leftJoin('room_types as rt','rt.id','hr.type_id')
        ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                        if ($request->get('hotel_id') != '') {
                            $query->where('bulk_bookings.hotel_id', $request->get('hotel_id'));
                        }

                        if ($request->get('room_type') != '') {
                            $query->where('hr.type_id', $request->get('room_type'));
                        }

                        if ($request->get('from') != '') {
                            $query->where('bulk_bookings.booking_person', $request->get('from'));
                        }

                        if ($request->get('fromDate') != '') {
                            $query->whereDate('bulk_bookings.created_at', date('Y-m-d', strtotime($request->get('fromDate'))));
                        }
                    }
                })
        ->orderby('id','desc')
        ->get();
        $bulkBookingCount = 0;
        if(!empty($data->toArray())){
            $bulkBookingCount = count($data);
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('order_id', function ($row) {
                        $order_id = 'PBD-BULK-'.$row->id;
                        return $order_id;
                    })
                    ->addColumn('action', function($row) {
                           $edit = url('/').'/admin/bulk-bookings/edit/'.$row->id;
                           $delete = url('/').'/admin/bulk-bookings/delete/'.$row->id;
                           $confirm = '"Are you sure, you want to delete it?"';

                            $editBtn = "<li>
                                        <a href='".$edit."'>
                                            <em class='icon ni ni-edit'></em> <span>Edit</span>
                                        </a>
                                    </li>";
                           // $editBtn = "";
                            
                            $deleteBtn = "<li>
                                        <a href='".$delete."' onclick='return confirm(".$confirm.")'  class='delete'>
                                            <em class='icon ni ni-trash'></em> <span>Delete</span>
                                        </a>
                                    </li>"; 

                            $logbtn = '<li><a href="#" data-resourceId="'.$row->id.'" class="audit_logs"><em class="icon ni ni-list"></em> <span>Audit Logs</span></a></li>';


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
                    ->addColumn('created_at', function ($row) {
                        $created_at = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->created_at));
                        return $created_at;
                    })
                    ->rawColumns(['action','created_at','name','updated_at','status',])
                    ->make(true);
        }


        return view('homestay::index')->with(compact('bulkBookingCount','hotels','room_types'));
        
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('homestay::create');
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
        return view('homestay::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('homestay::edit');
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
