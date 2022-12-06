<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Session;
use Exception;

class FrontendController extends Controller
{
    public function booking()
    {
        return view('frontend::booking');
    }


    public function mahakalLokDarshan()
    {
        return view('frontend::mahakalLokDarshan');
    }
    public function myBookings()
    {
        return view('frontend::myBookings');
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
                'registration_number' => $input['registration_number'],
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
}
