<?php
use Modules\User\Entities\User;
use Modules\User\Entities\OrganizationBuyer;
use Modules\User\Entities\RetailerCategories;
use App\SendNotification as SendNotification;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Modules\User\Entities\OrganizationStaff;

use Modules\Hotel\Entities\Booking;
use Modules\HomeStay\Entities\HomeStay;
use Modules\Hotel\Entities\BookingRoom;
use Modules\Hotel\Entities\BillingDetail;
use Modules\Hotel\Entities\Transaction;
use Modules\Hotel\Entities\RoomType;
use Modules\Hotel\Entities\Hotel;


class Helpers {
	
	public static function getAcronym($words) {
		$words = preg_replace('/\s+/', ' ', $words);
		$words = explode(" ", $words);

		$acronym = "";
		foreach ($words as $w) {
			if(strlen($acronym) < 2 && trim($w) != "")
			{
				$acronym .= $w[0];
			} 
		}
		return strtoupper($acronym);

	}

	/**
	 * function for calculate percentage
	 * @param $current
	 * @param $total
	 * @return float
	 */
	public static function calculatePercentage($current, $total){
		$percentage = ($current / $total) * 100;
		return round($percentage, 2);
	}

	public static function bookingDetails($booking_id) {
		$booking = 	Booking::from('bookings as b')
                    ->select('h.name as hotel','h.address as hotel_address','b.*','u.full_name as guest','u.email as guest_email','h.contact_number','h.contact_person',
                        \DB::Raw('COALESCE((select count(booking_rooms.id) from booking_rooms where booking_rooms.booking_id = b.id ),0) as rooms'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.guests) from booking_rooms where booking_rooms.booking_id = b.id ),0) as guests'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.adults) from booking_rooms where booking_rooms.booking_id = b.id ),0) as adults'),
                        \DB::Raw('COALESCE((select sum(booking_rooms.childs) from booking_rooms where booking_rooms.booking_id = b.id ),0) as childs'),
                    )
                    ->leftJoin('hotels as h','h.id','=','b.hotel_id')
                    ->leftJoin('users as u','u.id','=','b.user_id')
                	->where('b.id',$booking_id)
                    ->first();

        $booking->adults = $booking->guests-$booking->childs;
        $booking->childs = $booking->guests-$booking->adults;

		$bookingRooms = BookingRoom::from('booking_rooms as br')
                ->select('br.*','hr.rate','rt.name as room_type_name')
                ->leftJoin('hotel_rooms as hr','br.room_id','=','hr.id')
                ->join('room_types as rt','rt.id','=','hr.type_id')
                ->where('br.booking_id',$booking_id)
                ->get();

        $booking->bookingRooms = $bookingRooms;
        return $booking;
	}

	public static function sendBookingReceiveMailsOverseas($booking_id) {


		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		$to_email = $bookingDetails->guest_email;
		// $to_email = $bookingDetails->guest_email;

		$emails = array(\Config::get('constants.OVERSEAS_EMAIL'));

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.booking', $data, function ($message)  use ($to_name, $to_email,$emails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Thank you for booking with Pravasi Bharatiya Divas 2023')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendBookingReceiveMails($booking_id) {


		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		$to_email = $bookingDetails->guest_email;
		// $to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		$emails[] = \Config::get('constants.MPT_EMAIL');
		$emails[] = \Config::get('constants.OVERSEAS_EMAIL');

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.booking', $data, function ($message)  use ($to_name, $to_email,$emails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Thank you for booking with Pravasi Bharatiya Divas 2023')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendBookingConfirmationMails($booking_id) {


		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		// $to_email = $bookingDetails->guest_email; //uncomment for live
		// $to_email = $bookingDetails->guest_email;
		$to_email = 'vikalp@yopmail.com';

		$emails = array($to_email);
		// $emails[] = \Config::get('constants.MPT_EMAIL');

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.booking-confirmation', $data, function ($message)  use ($to_name, $to_email,$emails,$bookingDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Booking Confirmed : '.$bookingDetails->hotel.' '.$to_name)
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendCancellationReceivedMail($booking_id) {

		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		// $to_email = $bookingDetails->guest_email; //uncomment for live
		$to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.cancellation', $data, function ($message)  use ($to_name, $to_email,$emails,$bookingDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Cancellaiton Request Recevied : '.$bookingDetails->hotel.' '.$to_name)
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendCancellationApprovedMail($booking_id) {

		$bookingDetails = self::bookingDetails($booking_id);

		$to_name = $bookingDetails->guest;
		// $to_email = $bookingDetails->guest_email; //uncomment for live
		$to_email = $bookingDetails->guest_email;

		$emails = array($to_email);
		$emails[] = \Config::get('constants.MPT_EMAIL');

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.cancellation_approved', $data, function ($message)  use ($to_name, $to_email,$emails,$bookingDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Cancellaiton Request Approved : '.$bookingDetails->hotel.' '.$to_name)
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendRefundApprovedMail($booking_id) {

		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		// $to_email = $bookingDetails->guest_email; //uncomment for live
		$to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.refund_approved', $data, function ($message)  use ($to_name, $to_email,$emails,$bookingDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Refund Approved : '.$bookingDetails->hotel.' '.$to_name)
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function sendRefundProcessedMail($booking_id) {

		$bookingDetails = self::bookingDetails($booking_id);
		$to_name = $bookingDetails->guest;
		// $to_email = $bookingDetails->guest_email; //uncomment for live
		$to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		$data = array('bookingDetails'=>$bookingDetails);
		Mail::send('emails.refund_processed', $data, function ($message)  use ($to_name, $to_email,$emails,$bookingDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('Refund Processed : '.$bookingDetails->hotel.' '.$to_name)
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	public static function hotelClassifications() {
		$classifications = Hotel::from('hotels as h')
                        ->select('h.classification')
                        ->distinct('h.classification')
                        ->get();
		if(!empty($classifications->toArray())){
			return $classifications;
		}else{
			return array();
		}
	}

	public static function roomTypes() {
		$room_types = RoomType::from('room_types as rt')
        ->select('rt.name', 'rt.id')->get();
		if(!empty($room_types->toArray())){
			return $room_types;
		}else{
			return array();
		}
	}

	public static function hotels() {
		$hotels =Hotel::from('hotels as h')
        ->select('h.name', 'h.id')->get();
		if(!empty($hotels->toArray())){
			return $hotels;
		}else{
			return array();
		}
	}

	public static function sendStayRequestMailToDelegate($request_id) {


		$requestDetails = HomeStay::where('id',$request_id)->first();
		$to_name = $requestDetails->name;
		$to_email = $requestDetails->email;
		// $to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		// $emails[] = \Config::get('constants.MPT_EMAIL');
		// $emails[] = \Config::get('constants.OVERSEAS_EMAIL');

		$data = array('requestDetails'=>$requestDetails);
		Mail::send('emails.stay-request-delegate', $data, function ($message)  use ($to_name, $to_email,$emails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('FREE Home Stay Request')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}


	public static function sendStayRequestMailToOverseas($request_id) {


		$requestDetails = HomeStay::where('id',$request_id)->first();
		$to_name = $requestDetails->name;
		$to_email = \Config::get('constants.OVERSEAS_EMAIL');
		// $to_email = $bookingDetails->guest_email;

		$emails = array($to_email);

		// $emails[] = \Config::get('constants.MPT_EMAIL');
		// $emails[] = \Config::get('constants.OVERSEAS_EMAIL');

		$data = array('requestDetails'=>$requestDetails);
		Mail::send('emails.home-stay-request-overseas-team', $data, function ($message)  use ($to_name, $to_email,$emails,$requestDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('FREE Home Stay Request')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}


	public static function sendAllotmentMailToDelegate($request_id) {


		$requestDetails = HomeStay::from('home_stay as hs')->select('hs.name','hs.email','h.name as host_name','h.email as host_email','h.mobile as host_mobile','h.address as host_address','h.city as host_city','h.venue_distance','h.airport_distance','h.map_link','h.food_habit','h.vehicle','h.vehicle_number')->leftjoin('hosts as h','h.id','hs.host_id')->where('hs.id',$request_id)->first();
		$to_name = $requestDetails->name;
		$to_email = $requestDetails->email;

		$emails = array($to_email);

		$data = array('requestDetails'=>$requestDetails);
		Mail::send('emails.home-stay-allotted-delegate', $data, function ($message)  use ($to_name, $to_email,$emails,$requestDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('FREE Home Stay Alloted | Host Detail')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}


	public static function sendAllotmentMailToOverseas($request_id) {


		$requestDetails =  HomeStay::from('home_stay as hs')->select('hs.name','hs.email','hs.mobile','hs.address','hs.country','hs.city','hs.guest_name_1','hs.guest_age_1','hs.guest_name_2','hs.guest_age_2','hs.check_in_date','hs.check_out_date','h.name as host_name','h.email as host_email','h.mobile as host_mobile','h.address as host_address','h.city as host_city','h.venue_distance','h.airport_distance','h.map_link','h.food_habit','h.vehicle','h.vehicle_number')->leftjoin('hosts as h','h.id','hs.host_id')->where('hs.id',$request_id)->first();
		$to_name = 'Overseas Team';
		$to_email = \Config::get('constants.OVERSEAS_EMAIL');

		$emails = array($to_email);

		$data = array('requestDetails'=>$requestDetails);
		Mail::send('emails.home-stay-allotted-overseas', $data, function ($message)  use ($to_name, $to_email,$emails,$requestDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('FREE Home Stay Alloted | Host Details & Delegate Details')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}


	public static function sendAllotmentMailToHost($request_id) {


		$requestDetails =  HomeStay::from('home_stay as hs')->select('hs.name','hs.email','hs.mobile','hs.address','hs.country','hs.city','hs.guest_name_1','hs.guest_age_1','hs.guest_name_2','hs.guest_age_2','hs.check_in_date','hs.check_out_date','h.name as host_name','h.email as host_email')->leftjoin('hosts as h','h.id','hs.host_id')->where('hs.id',$request_id)->first();
		$to_name = $requestDetails->host_name;
		$to_email = $requestDetails->host_email;

		$emails = array($to_email);

		$data = array('requestDetails'=>$requestDetails);
		Mail::send('emails.home-stay-allotted-host', $data, function ($message)  use ($to_name, $to_email,$emails,$requestDetails) {
			// $message->to($to_email, $to_name)
			$message->to($emails, $to_name)
			->subject('FREE Home Stay Alloted | Delegate Detail')
			->from(\Config::get('constants.MAIL_FROM'),'Pravasi Bhartiya Divas');
		});
	}

	


	public static function sendNotifications($receiver = array(), $bodies = array(),$channels = array(),$mailSubject = '',$details = array()) {

		if(!empty($channels)){

			foreach ($channels as $key => $channel) {
				if(!empty($bodies) && isset($bodies[$channel])){
					// Push,In-app/WA/Email
					if($channel == 'wa'){
						$notifyNumbers = '91'.$receiver->phone_number;
		                if(!empty($notifyNumbers)){
		                    $broadcast = self::sendWaNotification($bodies[$channel],$notifyNumbers);
		                }
					}
					
					if($channel == 'database'){

						if(!empty($details) && $details['fcm_token'] != ""){
							$sendNotification = SendNotification::sendNotification($details);
						}


						/*$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/profitley-firebase.json');
						$firebase = (new Factory)
						->withServiceAccount($serviceAccount)
						->withDatabaseUri(\Config::get('constants.FIREBASE.DATABASEURI'))
						->create();
						$database = $firebase->getDatabase();*/


						if (\Auth::user()){
							$organization_id = \Auth::user()->organization_id;
				        }else{
				            $organization_id = $details['organization_id'];
				        }

						$factory = (new Factory)->withServiceAccount(__DIR__.'/profitley-firebase.json')->withDatabaseUri(\Config::get('constants.FIREBASE.DATABASEURI'));
						$database = $factory->createDatabase();
						$details['date'] = date('Y-m-d H:i:s');
						$newPost = $database
						// ->getReference(\Config::get('constants.FIREBASE.REFERENCE').'/user_id_'.$receiver->id)
						->getReference(\Config::get('constants.FIREBASE.REFERENCE').'/org_'.$organization_id.'_user_id_'.$receiver->id)
						->push($details);
					}

					if($channel == 'mail'){

						$to_name = $receiver->name;
						$to_email = $receiver->email;
						$data = array('name'=>$receiver->name, "body" => $bodies[$channel],'mailSubject' => $mailSubject);
						$mailBody = $bodies[$channel];

						Mail::send('emails.email_template', $data, function ($message)  use ($to_name, $to_email,$mailBody,$mailSubject) {
							// $message->to($to_email, $to_name)
							$message->to($to_email, $to_name)
							->subject($mailSubject)
							->from('support@profitley.com','Profitley');
							// ->setBody($mailBody, 'text/html');
						});


						// Mail::send(‘emails.mail’, $data, function($message) use ($to_name, $to_email) {
						// $message->to($to_email, $to_name)
						// ->subject(Laravel Test Mail’);
						// $message->from(‘SENDER_EMAIL_ADDRESS’,’Test Mail’);
						// });

					}

				}
			}
		}
	}

}
