<?php

namespace Modules\HomeStay\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HomeStay\Entities\HomeStay;
use Modules\HomeStay\Entities\Host;
use Modules\HomeStay\Exports\DelegateRequestExport;
use DataTables;


class HomeStayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $data = HomeStay::from('home_stay as hs')->select('hs.id','hs.name','hs.email','hs.mobile','hs.address','hs.country','hs.check_in_date','hs.check_out_date','hs.status','h.name as hostName')->leftjoin('hosts as h','h.id','hs.host_id')
        ->where(function ($query) use ($request) {
                    if (!empty($request->toArray())) {
                         if ($request->get('delegate_name') != '') {
                                $query->where('hs.name', $request->get('delegate_name'));
                            }

                            if ($request->get('status') != '') {
                                $query->where('hs.status', $request->get('status'));
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

    public function delegateRequestExport(Request $request)
    {

        try {
            $guests =   HomeStay::from('home_stay as hs')->select('hs.name','hs.email','hs.mobile','hs.address','hs.country',\DB::raw('DATE_FORMAT(hs.check_in_date, "%d-%b-%Y") as check_in_date'),\DB::raw('DATE_FORMAT(hs.check_out_date, "%d-%b-%Y") as check_out_date'),'h.name as hostName','hs.status')->leftjoin('hosts as h','h.id','hs.host_id')
                ->where(function ($query) use ($request) {
                            if (!empty($request->toArray())) {
                                if ($request->get('delegate_name') != '') {
                                    $query->where('hs.name', $request->get('delegate_name'));
                                }

                                if ($request->get('status') != '') {
                                    $query->where('hs.status', $request->get('status'));
                                }
                            }
                        })
                ->orderby('hs.id','desc')
                ->get();

            if(!empty($guests->toArray())){
                return (new DelegateRequestExport($guests->toArray()))->download('delegate-requests' . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            }else{
                return redirect('admin/homestay/requests')->with('error', 'No request');
            }
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
    public function edit(Request $request, $id)
    {
        $request = HomeStay::from('home_stay as hs')->where('id',$id)->first();
        $hosts = Host::where('is_alloted',0)->orwhere('id',$request->host_id)->get();
        return view('homestay::edit', compact('request','hosts'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input['host_id']);
        $stayRequest = HomeStay::findorfail($id);

        $oldHost = $stayRequest->host_id;

        if($input['host_id']==''){

            if($oldHost != 0){
                $host = Host::findorfail($oldHost);
                if($host){
                    $host->is_alloted = 0;
                    $host->save();
                }
            }
            $stayRequest->status = 'Request Received';
            $stayRequest->host_id = 0;
            $stayRequest->allotment_date = Null;
            $stayRequest->save();
        }else{
            $stayRequest->status = 'Alloted';
            $stayRequest->host_id = $input['host_id'];
            $stayRequest->allotment_date = date('Y-m-d');
            $stayRequest->save();
            Host::where('id',$input['host_id'])->update(['is_alloted'=>1]);
            \Helpers::sendAllotmentMailToDelegate($id);
            \Helpers::sendAllotmentMailToOverseas($id);
            \Helpers::sendAllotmentMailToHost($id);
        }


         return redirect('/admin/homestay/requests')->with('message', 'Updated Successfully');
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
