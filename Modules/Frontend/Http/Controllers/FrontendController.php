<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Frontend\Entities\HomeStayRegistration;
use Modules\HomeStay\Entities\Host;
use DB;
use Session;
use Exception;
use Helpers;

class FrontendController extends Controller
{
    
    public function __construct() {
        $this->homeStayRequests =  50;
    }

    public function booking()
    {
        return view('frontend::booking');
    }


    public function mahakalLokDarshan()
    {
        return view('frontend::mahakalLokDarshan');
    }
    
    public function contactUs()
    {
        return view('frontend::contactUs');
    }
    
    public function about()
    {
        return view('frontend::about');
    }
    public function privacyPolicy()
    {
        return view('frontend::privacyPolicy');
    }
    public function bookingPolicy()
    {
        return view('frontend::bookingPolicy');
    }
    public function termsAndConditions()
    {
        return view('frontend::termsAndConditions');
    }
    public function refundCancellationPolicy()
    {
        return view('frontend::refundCancellationPolicy');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try {

              $data = array(
                'name' => $input['full_name'],
                'email' => $input['email_id'],
                'country_code' => $input['country_code'],
                'mobile' => $input['phone_or_mobile_no'],
                // 'registration_number' => $input['registration_number'],
                'country'  => $input['country'],
                'members'  => $input['members'],
                'departure_indore'  => $input['departure_from_indore'],
                'departure_ujjain'  => $input['departure_from_ujjain'],
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $fileNameWithExt = $image->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $fileName = preg_replace("/[^A-Za-z0-9 ]/", '', $fileName);
                $fileName = preg_replace("/\s+/", '-', $fileName);
                $extension = $image->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
                $data['file'] = $fileName;
                $destinationPath = public_path('/uploads/mahakalLokDarshan');
                $image->move($destinationPath, $fileName);
            }

            DB::table('darshan_registration')->insert($data);
              
            return redirect()->back()->with('success', 'Registration successful');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
  
        
    }

    public function storeContact(Request $request)
    {
        $input = $request->all();

        try {

            $data = array(
                'name' => $input['full_name'],
                'email' => $input['contact_email'],
                'mobile' => $input['contact_tel'],
                'message' => $input['contact_message'],
                'created_at' => date('Y-m-d H:i:s')
            );

            DB::table('contact')->insert($data);
              
            return redirect()->back()->with('success', 'Submitted successful');

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
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
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

    public function homeStay()
    {
        $user = \Auth::user();

        $totalHosts = Host::count();
        $totalRequests = HomeStayRegistration::count();

        $soldOut = $registered = 0;
        if($totalRequests >= $this->homeStayRequests){
            $soldOut = 1;
        }

        $checkRequest = HomeStayRegistration::where('user_id',$user->id)->first();
        if($checkRequest){
            $registered = 1;
        }

        return view('frontend::homeStay',['registered' => $registered,'soldOut' => $soldOut]);
    }

    public function homeStayRegistration(Request $request)
    {

        $user = \Auth::user();

        $input = $request->all();

        
        $checkInDate = date('d',strtotime($input['check_in_date']));
        $checkOutDate = date('d',strtotime($input['check_out_date']));
        if($checkOutDate<$checkInDate){
            return redirect('/free-home-stay')->with('error', 'Check Out Date cannot be less then Check In Date')->withInput();
        }

        try {
            $totalHosts = Host::count();
            $totalHosts = $this->homeStayRequests;
            $totalRequests = HomeStayRegistration::count();
            $soldOut = 0;
            $isExist = HomeStayRegistration::where('user_id',$user->id)->first();
            if($isExist){
                return redirect('/free-home-stay')->with('error', 'Sorry, you have already registered for free home stay.');
            }elseif($totalRequests >= $totalHosts){
                return redirect('/free-home-stay')->with('error', 'Sorry, request for registrations are closed for now. Please check later.')->withInput();
            }else{
                $request = new HomeStayRegistration();
                $request->name = $input['full_name'];
                $request->email = $input['email_id'];
                $request->country_code = $input['country_code'];
                $request->mobile = $input['phone_or_mobile_no'];
                $request->address = $input['address'];
                $request->country = $input['country'];
                $request->city = $input['city'];
                $request->guest_name_1 = $input['adult_name_1'];
                $request->guest_age_1 = $input['adult_age_1'];
                $request->guest_name_2 = $input['adult_name_2'];
                $request->guest_age_2 = $input['adult_age_2'];
                $request->check_in_date = date('Y-m-d',strtotime($input['check_in_date']));
                $request->check_out_date = date('Y-m-d',strtotime($input['check_out_date']));
                $request->status = 'Request Received';
                $request->created_at = date('Y-m-d H:i:s');
                $request->user_id = $user->id;

                if($request->save()){
                    \Helpers::sendStayRequestMailToDelegate($request->id);
                    \Helpers::sendStayRequestMailToOverseas($request->id);
                    return redirect()->back()->with('success', 'Registration successful');
                }else{
                    return redirect('/free-home-stay')->with('error', 'Something went wrong');
                }
            }
              
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
