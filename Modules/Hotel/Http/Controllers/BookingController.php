<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Hotel\Entities\BulkBooking;
use Modules\Hotel\Entities\Hotel;
use Modules\Hotel\Entities\HotelRoom;
use Modules\Hotel\Entities\BulkBookingRoom;
use DataTables;
use Yajra\Datatables\DatatablesServiceProvider;
use App\Models\Audit;
use Helpers;

use Maatwebsite\Excel\HeadingRowImport;
use Modules\Hotel\Imports\BookingsImport;

class BookingController extends Controller
{

    public function __construct() {

        /* Execute authentication filter before processing any request */
        // $this->middleware('auth');

        // if (\Auth::check()) {
        //     return redirect('/');
        // }

    }

    public function import(Request $request)
    {
        return view('hotel::booking_import');
    }

    public function importProduct(Request $request)
    {
        try{

            $user = \Auth::user();
            $organization_id = $user->organization_id;

            if ($request->hasFile('importFile')) {
                $extension = request()->importFile->getClientOriginalExtension();
                $fileName = $organization_id . '-' . time() . '-' . date('m-d-Y') . '.' . request()->importFile->getClientOriginalExtension();
                request()->importFile->move(public_path('uploads/imports/'), $fileName);
                $file = public_path('uploads/imports/') . $fileName;

            }else{
                $file = $request->file('importFile')->store('import');
            }

            $import = new BookingsImport($organization_id,$user->id,0);
            if ($extension == 'xlsx') {
                $import->import($file, null, \Maatwebsite\Excel\Excel::XLSX);
            } elseif ($extension == 'csv') {
                $import->import($file, null, \Maatwebsite\Excel\Excel::CSV);
            } elseif ($extension == 'xls') {
                $import->import($file, null, \Maatwebsite\Excel\Excel::XLS);
            } else {
                return redirect('ecommerce/products/import')->with('error', trans('messages.UNKNOWN_FILE_TYPE'));
            }
            $importResult = $import->data;
            if (!empty($importResult) && file_exists($file)) {
                unlink($file);
            }

            if (!empty($importResult['errors'])) {
                $tempArr = array_unique(array_column($importResult['errors'], 'row'));
                $errorsCount = count(array_values(array_intersect_key($importResult['errors'], $tempArr)));
            } else {
                $errorsCount = 0;
            }
            echo "<pre>";
            print_r($importResult);
            die;
            
            if (!empty($importResult['success'])) {
                if (!empty($importResult['errors'])) {
                    $message        = count($importResult['success']) . ' rows imported successfully. ' . $errorsCount . ' rows skipped due to errors';

                    return (new ProductErrorExport($importResult['errors']))->download('product_errors' . '.csv', \Maatwebsite\Excel\Excel::XLSX);
                    return redirect('ecommerce/products/import')->with('message', $message);

                } else {
                    $message        = count($importResult['success']) . ' rows imported successfully';
                    return redirect('ecommerce/products/import')->with('message', $message);
                }
                $data['errors']             = $importResult['errors'];
                return $this->sendSuccessResponse($data);
            } else {
                $message        = count($importResult['success']) . ' rows imported successfully. ' . $errorsCount . ' rows skipped due to errors';

                return (new ProductErrorExport($importResult['errors']))->download('product_errors' . '.csv', \Maatwebsite\Excel\Excel::XLSX);
                return redirect('ecommerce/products/import')->with('message', $message);
            }
                // ImportProduct::save_result($result->id)
            /*$import->queue($file)->chain([
                SendImportEmail::dispatch($result->id)->delay(Carbon::now()->addMinutes(2))
            ]);*/

            return back()->withStatus('Import in queue, we will send notification after import finished.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return $this->sendFailureResponse($failures);
        }
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try{

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


        return view('hotel::bulkBooking/index')->with(compact('bulkBookingCount','hotels','room_types'));
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
        $hotels = Hotel::get();
        return view('hotel::bulkBooking/bulkBooking', compact('hotels'));
    }

    public function store(Request $request)
    {
        try{

            if(isset($request->bulkBookingId)){
                BulkBookingRoom::where('bulk_booking_id',$request->bulkBookingId)->delete();
                foreach ($request->bookingId as $key => $value) {
                    $bulk_booking_room = new BulkBookingRoom();
                    $bulk_booking_room->room_id = $request->roomType;
                    $bulk_booking_room->bulk_booking_id = $request->bulkBookingId;
                    $bulk_booking_room->booking_id = $request->bookingId[$key];
                    $bulk_booking_room->adult_count = $request->adultCount[$key];
                    $bulk_booking_room->child_count = $request->childCount[$key];
                    $bulk_booking_room->guest_name = $request->guest_name[$key];
                    $bulk_booking_room->guest_designation = $request->guest_designation[$key];
                    $bulk_booking_room->save();
                }

                $msg = "Booking updated successfully";
                return redirect('/admin/bulk-bookings')->with('message', $msg);
            }else{
                $bulkBooking = new BulkBooking();
                HotelRoom::where('id', $request->roomType)->decrement('count', $request->rooms);
                $msg = "User added successfully";
                $bulkBooking->name = $request->name;
                $bulkBooking->hotel_id  = $request->hotel;
                $bulkBooking->room_type_id = $request->roomType;
                $bulkBooking->booking_person = $request->bookingFrom;
                $bulkBooking->checkin_date = date('Y-m-d', strtotime($request->checkin_date));
                $bulkBooking->checkout_date = date('Y-m-d', strtotime($request->checkout_date));
                $bulkBooking->room_count     = $request->rooms;
                if($bulkBooking->save()){
                    return redirect('/admin/bulk-bookings')->with('message', $msg);
                }else{
                    return redirect('/admin/bulk-bookings/create')->with('error', 'Something went wrong');
                }
            }
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

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
            $bulkBooking = BulkBooking::where('id',$id)->first();
            $bulkBooking->checkin_date = date('m/d/Y', strtotime($bulkBooking->checkin_date));
            $bulkBooking->checkout_date = date('m/d/Y', strtotime($bulkBooking->checkout_date));
            $hotels = Hotel::get();
            $roomTypes = HotelRoom::from('hotel_rooms as hr')
                ->select('hr.id', 'hr.hotel_id', 'hr.name', 'hr.type_id', 'hr.extra_bed_rate','rt.name as room_type_name')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->where('hr.hotel_id',$bulkBooking->hotel_id)
                ->orderby('rt.name','asc')
                ->get();
            // $availableRooms = HotelRoom::where('id',$bulkBooking->room_type_id)->first();
            $bulkBookingRooms = BulkBookingRoom::where('bulk_booking_id',$id)->get();
            return view('hotel::bulkBooking/bulkBooking',compact('bulkBooking','hotels','roomTypes','bulkBookingRooms'));

        } catch (Exception $e) {
            return redirect('admin/bulk-bookings')->with('error', $exception->getMessage());           
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
        try{

            $bulkBooking = BulkBooking::findorfail($id);

            $roomsCount = $bulkBooking->room_count;

            if($bulkBooking->forceDelete()){
                $rooms = HotelRoom::where('id', $bulkBooking->room_type_id)->first();
                $rooms->count = $roomsCount+$rooms->count;
                $rooms->save();
                return redirect('admin/bulk-bookings')->with('message', 'Booking deleted successfully');
            }else{
                return redirect('admin/bulk-bookings')->with('error', 'Somthing went wrong');
            }

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        try{

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
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }

    public function hotelRooms($id)
    {
        $rooms = HotelRoom::where('id',$id)->first();
        if($rooms){
            return array('success' => true,'hotelRooms' => $rooms);
        }else{
            return array('success' => false,'hotelRooms' => array());
        }
    }

}
