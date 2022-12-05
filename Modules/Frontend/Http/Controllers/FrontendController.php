<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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
        //
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
