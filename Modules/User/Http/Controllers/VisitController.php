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
use Modules\User\Exports\VisitersExport;

class VisitController extends Controller
{

    public function __construct() {

        /* Execute authentication filter before processing any request */
        // $this->middleware('auth');

        // if (\Auth::check()) {
        //     return redirect('/');
        // }

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
                    ->addColumn('file', function ($row) {
                        $path = asset('uploads/mahakalLokDarshan/'.$row->file);
                        $file = '<a target="_blank" href="'.$path.'">'.$row->file.'</a>';
                        return $file;
                    })
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
                        $created_at = date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($row->created_at));
                        return $created_at;
                    })
                    ->rawColumns(['file','action','created_at'])
                    ->make(true);
        }


        return view('user::visit/index')->with(compact('visitersCount'));
    }

    public function show($id)
    {
        $visiter = Visit::where('id',$id)->first();
        return view('user::visit/detail')->with(compact('visiter'));
    }

    public function export(Request $request)
    {
        try{

            $data =   Visit::from('darshan_registration as dr')
                        ->select('dr.name','dr.email','dr.mobile','dr.country','dr.members','dr.file','dr.departure_indore','dr.departure_ujjain',\DB::raw('DATE_FORMAT(dr.created_at, "%d-%b-%Y")'))
                        ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('name') != '') {
                                    $query->where('dr.name', $request->get('name'));
                                }
                                if ($request->get('country') != '') {
                                    $query->where('dr.country', $request->country);
                                }

                                if ($request->get('contact_number') != '') {
                                    $query->where('dr.mobile', $request->get('contact_number'));
                                }

                                if ($request->get('members') != '') {
                                    if($request->get('members') == 1){
                                        $query->whereBetween('hr.rate', [5, 10]);
                                    }elseif($request->get('members') == 2){
                                        $query->whereBetween('hr.rate', [10, 15]);
                                    }elseif($request->get('members') == 3){
                                        $query->whereBetween('hr.rate', [15, 20]);
                                    }elseif($request->get('members') == 4){
                                        $query->where('hr.rate','>', 20);
                                    }
                                }

                            }
                        })
                        ->orderby('dr.name','asc')
                        ->get();

            foreach ($data as $key => $value) {
                if($value->file!=''){
                    $value->file = asset('uploads/mahakalLokDarshan/'.$value->file);
                }
            }

            if(!empty($data->toArray())){
                return (new VisitersExport($data->toArray()))->download('visiters' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/mahankal-lok-darshan')->with('error', 'No visiters');
            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

}
