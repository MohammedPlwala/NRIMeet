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
			@media print {
         .bg-blue {background-color: #1e306a; -webkit-print-color-adjust: exact; }
         .bg-white {background-color: #FFF; -webkit-print-color-adjust: exact; }
      }
		</style>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="background-color: #1e306a;" class="bg-blue">
			<tbody>
				<tr>
					<td style="padding-top: 2px; padding-left: 10px;">
            <a href="https://pbdaccommodation.mptourism.com" target="_blank">
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/PBD.png" alt="PBD Accommodation" style="max-width: 100%; width: 130px;" />
            </a>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/Group-64421.png" alt="PBD Accommodation" style="max-width: 100%; width: 100px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/azadi-75.png" alt="PBD Accommodation" style="max-width: 100%; width: 80px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/MP.png" alt="PBD Accommodation" style="max-width: 100%; width: 60px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/Hotels-resorts.png" alt="PBD Accommodation" style="max-width: 100%; width: 70px;" />
            </span>
          </td>
          <td style="padding-top: 2px;">
            <span>
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/MP-t.png" alt="PBD Accommodation" style="max-width: 100%; width: 50px;" />
            </span>
          </td>
				</tr>						
			</tbody>
		</table>
    <table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-top: 15px; vertical-align: top;">
            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: 600; color: #000; margin: 0;">Madhya Pradesh Tourism</p>
          </td>
          <td style="padding-top: 15px; font-family: Arial, Helvetica, sans-serif; font-size: 32px; font-weight: 700; color: #000; text-align: right; vertical-align: top;">
            ORDER
            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: 400; color: #000; text-align: right;">Order #: {{ $booking->order_id }}</p>
            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: 400; color: #000; text-align: right;">Date: {{ date('M d, Y',strtotime($booking->created_at)) }}</p>
          </td>
				</tr>						
			</tbody>
		</table>
		<!-- Content Area Start -->
		<table class="price-table" cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="margin-top: 20px;">
			<thead>
				<tr>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px 9px 10px; font-size: 13px; border-bottom: #D6D4D4;">HOTEL</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4;">ROOM TYPE</th>
					<th width="13%" style="text-align: center; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4; white-space: nowrap;">PER NIGHT CHARGE</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4; white-space: nowrap;">TOTAL CHARGES</th>
					<th width="13%" style="text-align: right; background: #F1F1F1; padding: 9px 4px; font-size: 13px; border-bottom: #D6D4D4; padding-right: 10px">AMOUNT</th>
				</tr>
			</thead>
			<tbody>

				@forelse($booking->bookingRooms as $key => $room)  
        <tr>
          <td width="13%" style="text-align: left; padding: 9px 4px 9px 10px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $booking->hotel }}</td>
          <td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $room->room_type_name }}</td>
          <td width="13%" style="text-align: center; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">INR {{ $room->rate }}</td>
          <td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">INR {{ $room->amount }}</td>
          <td width="13%" style="text-align: right; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; padding-right: 10px; white-space: nowrap;">INR {{ $room->amount }}</td>
        </tr>
				@empty
        @endforelse

				<tr>
					<td width="13%" colspan="4" style="text-align: right; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 15px; font-weight: 600;">Amount: In INR</td>
					<td width="13%" colspan="1" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 15px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">11</td>
				</tr>
        <tr>
					<td width="13%" colspan="4" style="text-align: right; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 15px; font-weight: 600;">Goods & Service Tax @ 18% / 12%</td>
					<td width="13%" colspan="1" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 15px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">{{ $booking->tax }}</td>
				</tr>
        <tr>
					<td width="13%" colspan="4" style="text-align: right; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 15px; font-weight: 600;">Net Amount Paid: IN INR</td>
					<td width="13%" colspan="1" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 15px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">{{ $booking->amount }}</td>
				</tr>
			</tbody>
		</table>

    <table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 30px; font-size: 14px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; line-height: 1.5;">
            Make all checks payable to Madhya Pradesh Tourism <br/>Thank you for stay, Hope you had a wonder stay & Experience.
          </td>
				</tr>
			</tbody>
		</table>

    <table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 20px; font-size: 14px; padding-bottom: 10px; font-family: Arial, Helvetica, sans-serif; line-height: 1.5;">
            <b>Thanks for choosing MP Tourism</b><br/>
            <b>Sincerely,</b><br/>
            <b>Pravasi Bharatiya Divas Team</b><br/>
            Overseas tours with MP Tourism
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
					<td style="background: #1e306a; padding-left: 10px; padding-top: 2px; padding-bottom: 4px" class="bg-blue">
            <a href="https://pbdaccommodation.mptourism.com" target="_blank">
              <img src="http://pbdaccommodation.mptourism.com/wp-content/uploads/2022/10/PBD.png" alt="profitley" style="width: 130px;" align="left" />
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