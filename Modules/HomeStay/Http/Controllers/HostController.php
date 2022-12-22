<?php

namespace Modules\HomeStay\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\User\Entities\UserRole;
use Modules\User\Entities\Role;
use Modules\HomeStay\Entities\Host;
use DataTables;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try{

            $room_types = \Helpers::roomTypes();
            $data = Host::from('hosts as h')
                    ->select('h.*')
                    ->where(function ($query) use ($request) {
                        if (!empty($request->toArray())) {

                            if ($request->get('host_name') != '') {
                                $query->where('h.name', $request->get('host_name'));
                            }

                            if ($request->get('distance_from_airport') != '' && $request->get('distance_from_airport') > 25) {
                                $query->where('h.airport_distance','>', 25);
                            }elseif ($request->get('distance_from_airport') != '') {
                                $query->where('h.airport_distance','<=', $request->get('distance_from_airport'));
                            }

                            if ($request->get('distance_from_venue') != '' && $request->get('distance_from_venue') > 25) {
                                $query->where('h.venue_distance','>', 25);
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
                               $edit = url('/').'/admin/homestay/hosts/edit/'.$row->id;
                               $delete = url('/').'/admin/homestay/hosts/delete/'.$row->id;
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
            return view('homestay::hosts/index')->with(compact('hotelsCount'));
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
        return view('homestay::hosts/create');
    }

    public function edit($id)
    {   
        $host = Host::findorfail($id);
        return view('homestay::hosts/create',['host' => $host]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try{

            if(isset($request->host_id)){
                $host = Host::findorfail($request->host_id);
                $msg = "Host updated successfully";
            }else{
                $host = new Host();
                $msg = "Host added successfully";
            }

            $host->name = $request->hostName;
            $host->city = $request->city;
            $host->airport_distance = $request->airport_distance;
            $host->venue_distance = $request->venue_distance;
            $host->mobile = $request->mobile;
            $host->email = $request->email;
            $host->map_link = $request->map_link;
            $host->address = $request->address;
            $host->status = $request->status;
            $host->food_habit = $request->food_habit;
            $host->vehicle = $request->vehicle;
            $host->vehicle_number = $request->vehicle_number;

           if ($request->hasFile('image_one')) {
                $file = $request->file('image_one');
                $fileNameWithExt = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $fileName = preg_replace("/[^A-Za-z0-9 ]/", '', $fileName);
                $fileName = preg_replace("/\s+/", '-', $fileName);
                $extension = $file->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
                $destinationPath = public_path("uploads/hosts/");
                //Move Uploaded File
                $file->move($destinationPath,$fileName);
                $host->image_one = $fileName;
           }

           if ($request->hasFile('image_two')) {
                $fileTwo = $request->file('image_two');
                $fileTwoNameWithExt = $fileTwo->getClientOriginalName();
                $fileTwoName = pathinfo($fileTwoNameWithExt, PATHINFO_FILENAME);
                $fileTwoName = preg_replace("/[^A-Za-z0-9 ]/", '', $fileTwoName);
                $fileTwoName = preg_replace("/\s+/", '-', $fileTwoName);
                $extension = $fileTwo->getClientOriginalExtension();
                $fileTwoName = $fileTwoName.'_'.time().'.'.$extension;
                $destinationPath = public_path("uploads/hosts/");
                //Move Uploaded File
                $fileTwo->move($destinationPath,$fileTwoName);
                $host->image_two = $fileTwoName;
           }

           if ($request->hasFile('image_three')) {
                $fileThree = $request->file('image_three');
                $fileThreeNameWithExt = $fileThree->getClientOriginalName();
                $fileThreeName = pathinfo($fileThreeNameWithExt, PATHINFO_FILENAME);
                $fileThreeName = preg_replace("/[^A-Za-z0-9 ]/", '', $fileThreeName);
                $fileThreeName = preg_replace("/\s+/", '-', $fileThreeName);
                $extension = $fileThree->getClientOriginalExtension();
                $fileThreeName = $fileThreeName.'_'.time().'.'.$extension;
                $destinationPath = public_path("uploads/hosts/");
                //Move Uploaded File
                $fileThree->move($destinationPath,$fileThreeName);
                $host->image_three = $fileThreeName;
           }

           
            
            if($host->save()){
                return redirect('/admin/homestay/hosts')->with('message', $msg);
            }else{
                return redirect('/admin/homestay/hosts/add')->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function destroy(Request $request,$id){
        $host = Host::findorfail($id);
        if($host->forceDelete()){
            return redirect('admin/homestay/hosts')->with('message', 'Deleted Successfully');
        }
    }
}
