<?php
namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\CustomerCare;
use Auth;
use DataTables;
use Yajra\Datatables\DatatablesServiceProvider;
use App\Models\Audit;

class CustomerCareController extends Controller
{

//     public function __construct() {

//         /* Execute authentication filter before processing any request */
//         $this->middleware('auth');

//         if (\Auth::check()) {
//             return redirect('/');
//         }
//     }

    public function index(Request $request){

        $data = CustomerCare::from('customer_care as cc')
                         ->select('cc.id', 'cc.date', 'cc.case_id', 'cc.staff_name', 'cc.guest_name', 'cc.country', 'cc.contact', 'cc.whatsapp'
                            ,'cc.email', 'cc.method', 'cc.issue', 'cc.sub_issue', 'cc.detailed_issue', 'cc.status', 'cc.pending', 'cc.remark','cc.created_at')
                            ->where(function ($query) use ($request) {
                                if (!empty($request->toArray())) {
                                    if ($request->get('guest_name') != '') {
                                        $query->where('cc.guest_name', $request->get('guest_name'));
                                    }
                                    if ($request->get('case_id') != '') {
                                        $query->where('cc.case_id', $request->get('case_id'));
                                    }
                                    if ($request->get('contact') != '') {
                                        $query->where('cc.contact', $request->get('contact'));
                                    }
                                    if((isset($request->fromDate) && isset($request->toDate))) {
                                        $dateFrom =  date('Y-m-d',strtotime($request->fromDate));
                                        $dateTo =  date('Y-m-d',strtotime($request->toDate. ' +1 day'));
                                        $query->whereBetween('cc.created_at', array($dateFrom, $dateTo));
                                    } elseif (isset($request->fromDate)) {
            
                                        $dateFrom =  date('Y-m-d',strtotime($request->fromDate));
                                        $query->where('cc.created_at', '>=', $dateFrom);
                                    } elseif (isset($request->toDate)) {
                                        $dateTo =  date('Y-m-d',strtotime($request->toDate));
                                        $query->where('cc.created_at', '<=', $dateTo);
                                    }
                                }
                            })
                         ->orderby('cc.id','desc')
                         ->get();

                         $customerCaresCount = 0;
                         if(!empty($data->toArray())){
                             $customerCaresCount = count($data);
                         }

                         if ($request->ajax()) {
                            return DataTables::of($data)
                                    ->addIndexColumn()
                                
                                    ->addColumn('action', function($row){
                                           $edit = url('/').'/admin/call-center/edit/'.$row->id;
                                           $delete = url('/').'/admin/call-center/delete/'.$row->id;
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
                
                                            // $changePassword = '<li><a href="#" data-resourceId="'.$row->id.'" class="changePassword"><em class="icon ni ni-lock-alt"></em> <span>Update Password</span></a></li>';
                                            $changePassword = '';
                
                                            $btn = '';
                                            $btn .= '<ul class="nk-tb-actio ns gx-1">
                                                        <li>
                                                            <div class="drodown mr-n1">
                                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="link-list-opt no-bdr">
                                                        ';
                
                                           $btn .=       $editBtn."
                                                        ".$deleteBtn."
                                                        ".$changePassword;
                
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

        return view('user::customerCare/index')->with(compact('customerCaresCount'));
    }

    public function createIssue()
    {
        return view('user::customerCare/callCenter');
    }

    public function createCaseNumber()
    {
       // Get the last created order
        $lastOrder = CustomerCare::orderBy('id', 'desc')->first();
        $number = 0;

       if ($lastOrder) {
            $number = substr($lastOrder->order_id, 5);
        }
       return 'CASE-' . sprintf('%06d', intval($number) + 1);
    }

    public function storeIssue(Request $request){

        $user = \Auth::user();

        if(isset($request->customerCareId)){

            $customerCare =CustomerCare::where('customer_care.id',$request->customerCareId)->first();

        }else{

            $customerCare = new CustomerCare();
            $customerCare->case_id        = $this->createCaseNumber();
        }
            $customerCare->date           = date('Y-m-d',strtotime($request->date));
            $customerCare->staff_name     = $user->full_name;
            $customerCare->guest_name     = $request->guest_name;
            $customerCare->country        = $request->country;
            $customerCare->contact        = $request->contact;
            $customerCare->whatsapp       = $request->whatsapp;
            $customerCare->email          = $request->email;
            $customerCare->method         = $request->method;
            $customerCare->issue          = $request->issue;
            $customerCare->sub_issue      = $request->sub_issue;
            $customerCare->detailed_issue = $request->detailed_issue;
            $customerCare->status         = $request->status;
            $customerCare->pending        = $request->pending;
            $customerCare->remark         = $request->remark;

            if($customerCare->save()){

                return redirect('/admin/call-center')
                ->with('success', 'Issue created successfully.');
               
            }else{
                return redirect('/admin/call-center/store')
                ->with('error','Something went wrong');
            }
    }

    public function editIssue($issue_id)
    {         
        try {
           
            $customerCare = CustomerCare::where('customer_care.id',$issue_id)->first();

            return view('user::customerCare/callCenter', compact('customerCare'));

        } catch (Exception $e) {
            return redirect('admin/user/staff')->with('error', $e->getMessage());           
        }
    }

    public function destroyIssue($issue_id)
    {
        $customerCare = CustomerCare::where('customer_care.id',$issue_id)->first();

        if($customerCare->forceDelete()){
            return redirect('/admin/call-center')->with('message', 'Customer Care deleted successfully');
        }else{
            return redirect('/admin/call-center')->with('error', 'Somthing went wrong');
        }
    }
}
