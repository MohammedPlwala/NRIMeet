<?php

namespace Modules\Hotel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Exports\VisitersExport;
use Modules\User\Entities\Visit;
use Modules\HomeStay\Entities\HomeStay;

class CronController extends Controller
{

    public function __construct()
    {

        /* Execute authentication filter before processing any request */
        // $this->middleware('auth');

        // if (\Auth::check()) {
        //     return redirect('/');
        // }

    }

    public function mahankalLokDarshan(Request $request)
    {
        try {
            $visiters = Visit::from('darshan_registration as dr')
                ->select('dr.name', 'dr.email', 'dr.mobile', 'dr.country', 'dr.members', 'dr.departure_indore', 'dr.departure_ujjain', \DB::raw('DATE_FORMAT(dr.created_at, "%d-%b-%Y") as created_at'))
                ->orderby('dr.name', 'asc')
                ->get();

            // $html = view('user::visit/mail_report', compact('visiters'))->render();

            $to_name = 'Vikalp';
            $to_email = 'vikalp@yopmail.com';

            $to_name = 'Vikalp';
            $to_email = 's.kurrey@mpstdc.com';
            $emails = array($to_email,'sachin@softude.com','events@overseastravels.co.in');

            $data = array('visiters'=>$visiters);
            \Mail::send('user::visit/mail_report', $data, function ($message)  use ($to_name, $to_email,$emails) {
                // $message->to($to_email, $to_name)
                $message->to($emails, $to_name)
                ->subject('Mahankal Lok Darshan Requests | '.date('d M').' | '. date('h:i A'))
                ->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
            });

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function homeStayRequests(Request $request)
    {
        try {
            $stays = HomeStay::from('home_stay as hs')
                    ->select('hs.id','hs.name','hs.email','hs.mobile','hs.address','hs.country','hs.check_in_date','hs.check_out_date','hs.status','host_id','h.name as hostName',
                        'guest_name_1','guest_age_1','guest_age_2','guest_name_2',
                        \DB::raw('DATE_FORMAT(hs.check_in_date, "%d-%b-%Y") as check_in_date'),
                        \DB::raw('DATE_FORMAT(hs.check_out_date, "%d-%b-%Y") as check_out_date'),
                        \DB::raw('DATE_FORMAT(hs.created_at, "%d-%b-%Y") as created_at'),
                    )
                    ->leftJoin('hosts as h','hs.host_id','=','h.id')
                    ->orderby('id','desc')
                    ->get();

            $to_name = 'Vikalp';
            $to_email = 's.kurrey@mpstdc.com';
            $emails = array($to_email,'sachin@softude.com','events@overseastravels.co.in');


            $data = array('stays'=>$stays);
            \Mail::send('homestay::stay_report', $data, function ($message)  use ($to_name, $to_email,$emails) {
                // $message->to($to_email, $to_name)
                $message->to($emails, $to_name)
                ->subject('Free Home Stay Requests | '.date('d M').' | '. date('h:i A'))
                ->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
            });

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
