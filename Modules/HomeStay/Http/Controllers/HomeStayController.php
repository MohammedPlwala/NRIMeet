<?php

namespace Modules\HomeStay\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HomeStay\Entities\HomeStay;
use DataTables;


class HomeStayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $data = HomeStay::from('home_stay as hs')->select('hs.id','hs.name','hs.email','hs.mobile','hs.address','hs.country','hs.check_in_date','hs.check_out_date','hs.status')
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
        $homeStayCount = 0;
        if(!empty($data->toArray())){
            $homeStayCount = count($data);
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                           $edit = url('/').'/admin/homestay/edit/'.$row->id;

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
                    ->addColumn('created_at', function ($row) {
                        $created_at = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->created_at));
                        return $created_at;
                    })
                    ->rawColumns(['action','created_at'])
                    ->make(true);
        }


        return view('homestay::index')->with(compact('homeStayCount'));
        
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
        $request = HomeStay::from('home_stay as hs')->where('id',$id)->first();
        return view('homestay::edit', compact('request'));
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
