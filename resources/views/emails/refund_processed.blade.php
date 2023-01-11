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
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; font-weight: 600">Dear {{ $bookingDetails->guest }},</td>
				</tr>					
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 0px; font-size: 14px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; line-height: 1.5;">
            <p>We have received your cancellation request having booking / Order Id: {{ $bookingDetails->order_id }}</p>
						<p>Therefore, we would like to inform you that your refund is processed for the following booking: </p>
						{{-- <p>Amount issue to you is INR __________________</p> --}}
          </td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 0; padding-bottom: 10px; font-weight: 600">Booking Details</td>
				</tr>					
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="border-top: 1px solid #D6D4D4; border-left: 1px solid #D6D4D4">
				<tbody>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Order ID:</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->order_id }}</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Confirmation No: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->confirmation_number }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Hotel Name: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->hotel }}</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Contact:</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->contact_number }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Hotel Address:</td>
						<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;" colspan="3">{{ $bookingDetails->hotel_address }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Lead Guest: </td>
						<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;" colspan="3">{{ $bookingDetails->guest }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Check-In: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ date('M d, Y',strtotime($bookingDetails->check_in_date)) }}</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Checkout: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ date('M d, Y',strtotime($bookingDetails->check_out_date)) }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Duration: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->nights }} Nights </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">No of Rooms: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->rooms }}</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">No of Guest: </td>
						<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;" colspan="3">{{ $bookingDetails->guests }} Pax</td>
					</tr>
					<tr>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Adult: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->adults }}</td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Children: </td>
						<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px; font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ $bookingDetails->childs }}</td>
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
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; padding-bottom: 10px; font-weight: 600">Refund Details</td>
				</tr>					
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="border-top: 1px solid #D6D4D4; border-left: 1px solid #D6D4D4">
			<tbody>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Date:</td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">{{ date('M d, Y') }}</td>
				</tr>
				{{-- <tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Amount Refunded: (In INR) </td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">30,000</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Payment Via: </td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Razor Pay, Etc</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Method of payment: </td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Card, Neft, Swift, Bank Tt Etc</td>
				</tr>
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Transaction ID:</td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">`pay_Kmzo7Ty2iDXfkO</td>
				</tr> --}}
				<tr>
					<td width="25%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 600; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Status: </td>
					<td width="75%" style="color:000; font-size: 14px; font-family: arial; padding:5px;font-weight: 400; border-right: 1px solid #D6D4D4; border-bottom: 1px solid #D6D4D4;">Refund Processed</td>
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