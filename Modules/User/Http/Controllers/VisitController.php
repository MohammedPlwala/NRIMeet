<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Visit;
use Auth;
use DataTables;
use Yajra\Datatables\DatatablesServiceProvider;
use App\Models\Audit;

class VisitController extends Controller
{

    public function __construct() {

        /* Execute authentication filter before processing any request */
        $this->middleware('auth');

        if (\Auth::check()) {
            return redirect('/');
        }

    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $data = Visit::get();
        $visitersCount = 0;
        if(!empty($data->toArray())){
            $visitersCount = count($data);
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $view = url('/').'/admin/mahankal-lok-darshan/view/'.$row->id;

                        $btn = '<ul class="nk-tb-actio ns gx-1">
                                    <li>
                                        <div class="drodown mr-n1">
                                            <a href="'.$view.'" class="btn btn-icon btn-trigger" ><em class="icon ni ni-eye"></em></a>
                                        </div>
                                    </li>
                                </ul>';
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        return date('d-m-Y H:i:s' , strtotime($row->created_at));
                    })
                    ->rawColumns(['action','created_at'])
                    ->make(true);
        }


        return view('user::visit/index')->with(compact('visitersCount'));
    }

    public function show($id)
    {
        $visiter = Visit::where('id',$id)->first();
        return view('user::visit/detail')->with(compact('visiter'));
    }

}
