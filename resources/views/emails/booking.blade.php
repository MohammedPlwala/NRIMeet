<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>PBD Accommodation</title>
		<style type="text/css">
			body{font-family: Arial, Helvetica, sans-serif; margin: 0; color: #000;}
			.price-table tr th{text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4}
			.price-table tr td{text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4}
		</style>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="background-color: #1e306a;">
			<tbody>
				<tr>
					<td style="padding-top: 2px; padding-left: 10px;">
            <a href="https://pbdaccommodation.mptourism.com" target="_blank">
              <img src="http://pbdaccommodation.mptourism.com/images/PBD.png" alt="PBD Accommodation" style="max-width: 100%; width: 130px;" />
            </a>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/images/Group-64421.png" alt="PBD Accommodation" style="max-width: 100%; width: 100px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/images/azadi-75.png" alt="PBD Accommodation" style="max-width: 100%; width: 80px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/images/MP.png" alt="PBD Accommodation" style="max-width: 100%; width: 60px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/images/Hotels-resorts.png" alt="PBD Accommodation" style="max-width: 100%; width: 70px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/images/MP-t.png" alt="PBD Accommodation" style="max-width: 100%; width: 50px;" />
            </span>
          </td>
				</tr>						
			</tbody>
		</table>
		<!-- Content Area Start -->
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; font-weight: 600">Dear {{ ucfirst($bookingDetails->guest) }},</td>
				</tr>					
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 0px; font-size: 14px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; line-height: 1.5;">
            <p>Thank you for booking with us, We have received your booking with the following details.</p>
          </td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 0; padding-bottom: 10px; font-weight: 600">Booking details:</td>
				</tr>					
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="border-top: 1px solid #D6D4D4; border-left: 1px solid #D6D4D4">
			<tbody>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Service Booked:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Hotel</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Hotel Name:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->hotel }}</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Lead Guest:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ ucfirst($bookingDetails->guest) }}</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">No of Guest:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->guests }}</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">No of Rooms:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->rooms }}</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Price:</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Rs.@convert($bookingDetails->amount)</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Check-In: </td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ date('M d, Y',strtotime($bookingDetails->check_in_date)) }}</td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Checkout: </td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ date('M d, Y',strtotime($bookingDetails->check_out_date)) }}</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Duration: </td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->nights }} Night(s) </td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">City: </td>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Indore</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Hotel Address:</td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;" colspan="3">{{ $bookingDetails->hotel_address }}</td>
				</tr>
			</tbody>
		</table>

		<table class="price-table" cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="margin-top: 20px;">
			<thead>
				<tr>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px 9px 10px; font-size: 13px; border-bottom: #D6D4D4;">Rooms</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4;">Room Type</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4; white-space: nowrap;">No. of Guests</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4; white-space: nowrap;">Guest Name</th>
				</tr>
			</thead>
			<tbody>

				@forelse($bookingDetails->bookingRooms as $key => $room)    
        <tr>
          <td width="13%" style="text-align: left; padding: 9px 4px 9px 10px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $key+1 }}</td>
          <td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $room->room_type_name }}</td>
          <td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">{{ $room->adults }} Adult(s) <br/>{{ $room->childs }} Child(ren)</td>
          <td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;"><p style="margin:0;">{{ $room->guest_one_name }}</p>
          	@if(!is_null($room->guest_two_name)) <p style="margin:0;">{{ $room->guest_two_name}}</p> @endif
          	@if(!is_null($room->guest_three_name)) <p style="margin:0;">{{ $room->guest_three_name}}</p> @endif
          	@if(!is_null($room->child_name)) <p style="margin:0;">{{ $room->child_name}}</p> @endif
          	 </td>
        </tr>
        @empty
        @endforelse

			</tbody>
		</table>

		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; padding-bottom: 10px; font-weight: 600">Booking policy: </td>
				</tr>
				<tr>
					<td>
						<ul style="font-size: 14px; font-family: arial; margin: 0; line-height: 20px;">
							<li>Booking is non-transferable</li>
							<li>Management reserve the right to cancel advance booking in exceptional and unavoidable circumstances</li>
							<li>Maximum 2 Rooms to be booked by a registered delegate</li>
							<li>Only Registered PBD Delegates will be eligible for book accommodation</li>
							<li>Last date to reserve your accommodation is 20th December'2022</li>
							<li>Hotel bookings window will be available from 6 January'2023 Check in & 13th January'2023 check out</li>
							<li>For refunds all bank charges & currency fluctuation charges will be borne by the guest.</li>
							<li>All bank charges for booking accommodation will be on the delegate.</li>
							<li>All Disputes are subject to the jurisdiction of Bhopal courts only.</li>
							<li>Please carry a valid photo identity card along with Booking receipt at the time of check-in in the Hotel</li>
							<li>CHECK-IN TIME: 1400 HRS. (2 PM)</li>
							<li>CHECK-OUT TIME: 1200 HRS. (12 PM)</li>
						</ul>
						<p style="font-size: 14px; font-family: arial; font-weight: 600; margin: 20px 0 0 0; line-height: 20px;">For More details: Login at <a href="https://pbdaccommodation.mptourism.com/booking-policy/" target="_blank">https://pbdaccommodation.mptourism.com/booking-policy/</a></p>
					</td>
				</tr>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; padding-bottom: 10px; font-weight: 600">Refund & Cancellation Policy:</td>
				</tr>
				<tr>
					<td>
						<ul style="font-size: 14px; font-family: arial; margin: 0; line-height: 20px;">
							<li>Before 10 Days of check-in 100% refund</li>
							<li>- Within 2-10 Days of Check-in 20% of the booking amount</li>
							<li>- Within 2 Days of Check-in 100% Retention</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>

    <table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="width: 60%;">&nbsp;</td>
					<td style="padding-left:0px; padding-top: 20px; font-size: 14px; padding-bottom: 0; font-family: Arial, Helvetica, sans-serif; line-height: 25px;">
            <b>Thanks for choosing MP Tourism</b><br/>
            <b>Sincerely,</b><br/>
            <b>Pravasi Bharatiya Divas Team</b>
          </td>
				</tr>
			</tbody>
		</table>

		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="height: 15px;">&nbsp;</td>
				</tr>
			</tbody>
		</table>
		<!-- content Area End -->
		<!-- footer start -->
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="background: #1e306a; padding-left: 10px; padding-top: 2px; padding-bottom: 4px">
            <a href="https://pbdaccommodation.mptourism.com" target="_blank">
              <img src="http://pbdaccommodation.mptourism.com/images/PBD.png" alt="PBD Logo" style="width: 130px;" align="left" />
            </a>
          </td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="border-bottom: 1px solid #D6D4D4">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 10px; font-size: 12px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; line-height: 18px;">
            <b>For Customer Support:</b><br/>
            Call: <a href="tel: +91-731-2444404" style="color: #000; text-decoration: none;">+91-731-2444404</a> WhatsApp: <a href="https://api.whatsapp.com/send?phone=+919893908123&amp;text=Welcome%20to%20Pravasi%20Bharatiya%20Divas%202023" target="_blank" rel="noopener" style="color: #000; text-decoration: none;">+91-9893908123</a> Email: <a href="mailto: Events@overseastravels.co.in" style="color: #000; text-decoration: none;">Events@overseastravels.co.in</a><br/>
            Copyright © 2022, Madhya Pradesh State Tourism Development Corporation Ltd. All Rights Reserved.
          </td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 10px; font-size: 11px; padding-bottom: 10px; color: #7F7F7F; font-family: Arial, Helvetica, sans-serif;">This is an auto-generated mail. Please do not reply.</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>