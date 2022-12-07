<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\Contact;
use Auth;
use DataTables;
use Yajra\Datatables\DatatablesServiceProvider;
use App\Models\Audit;

class ContactController extends Controller
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

        $data = Contact::get();
        $visitersCount = 0;
        if(!empty($data->toArray())){
            $contactsCount = count($data);
        }

        if ($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $view = url('/').'/admin/contacts/view/'.$row->id;

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
                    ->rawColumns(['created_at','action'])
                    ->make(true);
        }


        return view('user::contacts/index')->with(compact('contactsCount'));
    }

    public function show($id)
    {
        $contacts = Contact::where('id',$id)->first();
        return view('user::contacts/detail')->with(compact('contacts'));
    }

}
