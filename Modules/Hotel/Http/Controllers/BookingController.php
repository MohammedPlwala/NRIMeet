<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\BulkBooking;
use DataTables;
use Yajra\Datatables\DatatablesServiceProvider;
use App\Models\Audit;
use Helpers;

class BookingController extends Controller
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

        $data = BulkBooking::orderby('id','desc')
                ->get();
        $bookingCount = 0;
        if(!empty($data->toArray())){
            $bookingCount = count($data);
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function($row) use ($userPermission){
                            $detailLink = '#';

                            $username = $row->name.' '.$row->last_name;

                            if(!is_null($row->file)){
                                $file = public_path('uploads/users/') . $row->file;
                            }

                            if(!is_null($row->file) && file_exists($file))
                                $avatar = "<img src=".url('uploads/users/'.$row->file).">";
                            else
                                $avatar = "<span>".\Helpers::getAcronym($username)."</span>";
                            

                            $name = '
                                        <a href="'.$detailLink.'">
                                            <div class="user-card">
                                                <div class="user-avatar bg-primary">
                                                    '.$avatar.'
                                                </div>
                                                <div class="user-info">
                                                    <span class="tb-lead">'.$row->shop_name.' <span class="dot dot-success d-md-none ml-1"></span></span>
                                                    <span>'.$username.' </span>
                                                </div>
                                            </div>
                                        </a>
                                    ';
                            return $name;
                    })
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
                    ->addColumn('action', function($row) use ($userPermission){
                           $edit = url('/').'/admin/booking/edit/'.$row->id;
                           $delete = url('/').'/admin/booking/delete/'.$row->id;
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
                        return date('d-m-Y H:i:s' , strtotime($row->created_at));
                    })
                    ->rawColumns(['action','created_at','name','updated_at','status',])
                    ->make(true);
        }


        return view('hotel::bulkBooking/index')->with(compact('bookingCount'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        /*$user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->state = $request->state;
        $user->district = $request->district;
        $user->city = $request->city;
        $user->pincode = $request->pincode;*/

        if ($request->hasFile('file')) {

            $image1 = $request->file('file');
            $image1NameWithExt = $image1->getClientOriginalName();
            list($image1_width,$image1_height)=getimagesize($image1);
            // Get file path
            $originalName = pathinfo($image1NameWithExt, PATHINFO_FILENAME);
            $image1Name = pathinfo($image1NameWithExt, PATHINFO_FILENAME);
            // Remove unwanted characters
            $image1Name = preg_replace("/[^A-Za-z0-9 ]/", '', $image1Name);
            $image1Name = preg_replace("/\s+/", '-', $image1Name);

            // Get the original image extension
            $extension  = $image1->getClientOriginalExtension();

            if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png'){
                return redirect('profile')->with('error', trans('messages.INVALID_IMAGE'));
            }

            $image1Name = $image1Name.'_'.time().'.'.$extension;
            
            $destinationPath = public_path('uploads/users');
            if($image1_width > 800){
                $image1_canvas = Image::canvas(800, 800);
                $image1_image = Image::make($image1->getRealPath())->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image1_canvas->insert($image1_image, 'center');
                $image1_canvas->save($destinationPath.'/'.$image1Name,80);
            }else{
                $image1->move($destinationPath, $image1Name);
            }
            $image1_file = public_path('uploads/users/'. $image1Name);

            $user->file = $image1Name;
            $user->original_name = $image1NameWithExt;
        }

        if($user->save()){
            return redirect('profile')->with('message', trans('messages.PROFILE_UPDATED_SUCCESS'));
        }else{
            return redirect('profile')->with('error', trans('messages.SOMETHING_WENT_WRONG'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hotel::bulkBooking/create', compact('roleId'));
    }

    public function store(Request $request)
    {
        if(isset($request->userId)){
            $user = BulkBooking::findorfail($request->userId);
            $msg = "Booking updated successfully";
        }else{
            $user = new BulkBooking();
            $msg = "User added successfully";
        }

        $user->full_name = $request->fullname;
        $user->email  = $request->email;
        $user->mobile = $request->mobile;
        $user->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
        $user->password = \Hash::make('NriMeet@123');
        $user->address = $request->address;
        $user->nationality = $request->nationality;
        $user->country = $request->country;
        $user->zip = $request->zip;
        $user->identity_type = $request->identity_type;
        $user->identity_number  = $request->identity_number;
        if(isset($request->status)){
            $user->status = $request->status;
        }else{
            $user->status = 'inactive';
        }
        
        if($user->save()){
            if(!isset($request->userId)){
                $userRole = array('role_id' => $request->role_id, 'user_id' =>  $user->id);
                UserRole::insert($userRole);
            }
            return redirect('/admin/booking')->with('message', $msg);
        }else{
            return redirect('/admin/booking/create')->with('error', 'Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $authUser = \Auth::user();
            $user = User::where('id',$id)
                    ->first();
            $user->date_of_birth = date('m/d/Y', strtotime($user->date_of_birth));

            $roleId = Role::where('name','Guest')
                    ->first('id');

            return view('user::create',compact('roleId','user'));

        } catch (Exception $e) {
            return redirect('admin/user')->with('error', $exception->getMessage());           
        }


        return view('user::create');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {

        $user = BulkBooking::findorfail($id);
        if($user->forceDelete()){
            return redirect('admin/booking')->with('message', 'Booking deleted successfully');
        }else{
            return redirect('admin/booking')->with('error', 'Somthing went wrong');
        }
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $authUser = \Auth::user();

        $user =     User::from('users as u')
                    ->select('u.*','r.name as role','r.label as roleName','ob.buyer_category','ob.credit_limit','ob.status','rc.retailer_catagory as retailer_category','s.name as state','c.name as city','d.name as district',
                        DB::Raw('CONCAT(u.name," ", u.last_name) AS FullName')
                    )
                    ->leftJoin('model_has_roles as mr','mr.model_id','=','u.id')
                    ->leftJoin('roles as r','mr.role_id','=','r.id')
                    ->leftJoin('organization_buyer as ob','ob.buyer_id','=','u.id')
                    ->leftJoin('retailer_catagory as rc','rc.id','=','ob.buyer_category')
                    ->leftJoin('states as s','s.id','=','u.state')
                    ->leftJoin('cities as c','c.id','=','u.city')
                    ->leftJoin('districts as d','d.id','=','u.district')
                    ->where('u.id',$id)
                    // ->where('ob.organization_id',$authUser->organization_id)
                    ->first();

        if($user){
            return view('user::detail',['user' => $user]);
        }else{
            return redirect('user/staff')->with('error', trans('messages.SOMETHING_WENT_WRONG'));
        }

    }

}
