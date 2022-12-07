<?php

namespace Modules\Report\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use App\Models\User;
use Modules\User\Entities\UserRole;
use Modules\User\Entities\Role;
use Modules\Hotel\Entities\Booking;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;

use DataTables;


class ReportController extends Controller
{

    public function guest(Request $request)
    {

        // $data = User::from('users as u')
        //         ->select('h.*')
        //         ->get();

        // $guests =   User::from('users as u')
        //             ->select('u.id','u.full_name')
        //             ->leftJoin('user_role as ur','u.id','=','ur.user_id')
        //             ->leftJoin('roles as r','ur.role_id','=','r.id')
        //             ->where('r.name','Guest')
        //             ->where(function ($query) use ($request) {
        //                 if (!empty($request->toArray())) {
        //                     if ($request->get('name') != '') {
        //                         $query->where('h.name', $request->get('name'));
        //                     }
        //                 }
        //             })
        //             ->orderby('h.name','asc')
        //             ->get();

        // if ($request->ajax()) {
        //     return Datatables::of($data)
        //             ->addIndexColumn()
                    
        //             ->addColumn('status', function ($row) {
        //                 if($row->status == 'active'){
        //                     $statusValue = 'Active';
        //                 }else{
        //                     $statusValue = 'Inactive';
        //                 }

        //                 $value = ($row->status == 'active') ? 'badge badge-success' : 'badge badge-danger';
        //                 $status = '
        //                     <span class="tb-sub">
        //                         <span class="'.$value.'">
        //                             '.$statusValue.'
        //                         </span>
        //                     </span>
        //                 ';
        //                 return $status;
        //             })
        //             ->addColumn('action', function($row) {
        //                    $edit = url('/').'/admin/hotel/edit/'.$row->id;
        //                    $delete = url('/').'/admin/hotel/delete/'.$row->id;
        //                    $confirm = '"Are you sure, you want to delete it?"';

        //                     $editBtn = "<li>
        //                                 <a href='".$edit."'>
        //                                     <em class='icon ni ni-edit'></em> <span>Edit</span>
        //                                 </a>
        //                             </li>";
                            
        //                     $deleteBtn = "<li>
        //                                 <a href='".$delete."' onclick='return confirm(".$confirm.")'  class='delete'>
        //                                     <em class='icon ni ni-trash'></em> <span>Delete</span>
        //                                 </a>
        //                             </li>"; 

        //                     $btn = '';
        //                     $btn .= '<ul class="nk-tb-actio ns gx-1">
        //                                 <li>
        //                                     <div class="drodown mr-n1">
        //                                         <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
        //                                         <div class="dropdown-menu dropdown-menu-right">
        //                                             <ul class="link-list-opt no-bdr">
        //                                 ';

        //                    $btn .=       $editBtn."
        //                                 ".$deleteBtn;

        //                     $btn .= "</ul>
        //                                     </div>
        //                                 </div>
        //                             </li>
        //                             </ul>";
        //                 return $btn;
        //             })
        //             ->rawColumns(['action','status',])
        //             ->make(true);
        // }

        return view('report::guest');
    }

    public function hotelMaster(Request $request)
    {
        return view('report::hotel_master');
    }
    public function inventory(Request $request)
    {
        return view('report::inventory');
    }
    public function payment(Request $request)
    {
        return view('report::payment');
    }
    public function booking(Request $request)
    {
        return view('report::booking');
    }
    public function cancellation(Request $request)
    {
        return view('report::cancellation');
    }
    public function refund(Request $request)
    {
        return view('report::refund');
    }
    public function totalInventoryData(Request $request)
    {
        return view('report::total_inventory_data');
    }
    public function bookingSummary(Request $request)
    {
        return view('report::booking_summary');
    }
    public function groupBookings(Request $request)
    {
        return view('report::group_bookings');
    }
    public function callCenter(Request $request)
    {
        return view('report::call_center');
    }
    public function financial(Request $request)
    {
        return view('report::financial');
    }
    public function financial2(Request $request)
    {
        return view('report::financial_2');
    }
}
