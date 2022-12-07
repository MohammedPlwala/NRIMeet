<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>InfraWorld</title>
		<style type="text/css">
			body{font-family: arial}
			.price-table tr th{text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4}
			.price-table tr td{text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4}
		</style>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-bottom: 15px; padding-top: 10px;"><img src="https://sa.infraworld.in/images/logo-dark.png" alt="InfraWorld"></td>
				</tr>
			</tbody>
		</table>
		<!-- Banner content start -->
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="background: #0048BA; width: 1%; padding-right: 15px; padding-left: 15px; padding-top: 10px; padding-bottom: 10px"><img src="https://profitley.com/email-templates/images/cart-icon.png" alt="InfraWorld"></td>
					<td style="background: #0048BA; padding-left: 15px;padding-top: 10px; padding-bottom: 10px">
						<table>
							<tr>
								<td style="font-family: arial; font-size: 32px; font-weight: 700; color: #fff;">Sales Order Created</td>
							</tr>
							<tr>
								<td style="font-family: arial; font-size:18px; font-weight: normal; color: #fff;">Sales Order #: {{ $order->order_number }} </td>
							</tr>
							<tr>
								<td style="font-family: arial; font-size: 14px; font-weight: normal; color: #fff;">Created on {{ date('d M, Y h:i A',strtotime($order->created_at)) }} by {{ $order->created_by_name }} </td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		<!-- Content Area Start -->
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 14px; font-family: arial; padding-top: 20px; padding-bottom: 10px; font-weight: 600">Hello {{ $name }}</td>
				</tr>
				<tr>
					<td style="color:#000; font-size: 14px; font-family: arial; padding-top: 10px; padding-bottom: 10px; font-weight: normal; line-height:20px;">A Sales Order has been created against your purhcase order.</strong></td>
				</tr>		
				<tr>
					<td style="color:#FF8000; font-size: 16px; font-family: arial; padding-top: 10px; padding-bottom: 10px; font-weight: 600">Below are the buyer details</td>
				</tr>
				<tr>
					<td style="color:#0048BA; font-size: 16px; font-family: arial; padding-top: 0px; padding-bottom: 10px; font-weight: normal; line-height:20px;font-weight: 600">Name: {{ $user->name.' '.$user->last_name }}</td>
				</tr>
				<tr>
					<td style="color:#0048BA; font-size: 16px; font-family: arial; padding-top: 0px; padding-bottom: 10px; font-weight: normal; line-height:20px;font-weight: 600">Shop Name: {{ $user->shop_name }}</td>
				</tr>
				<tr>
					<td style="color:#0048BA; font-size: 16px; font-family: arial; padding-top: 0px; padding-bottom: 10px; font-weight: normal; line-height:20px;font-weight: 600">Mobile No.: {{ $user->phone_number }}</td>
				</tr>

			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 16px; font-family: arial; padding-top: 10px; padding-bottom: 10px; font-weight: 600">Sales Order Details</td>
				</tr>
				<tr>
					<td style="color:#0048BA; font-size: 16px; font-family: arial; padding-top: 0px; padding-bottom: 10px; font-weight: normal; line-height:20px;font-weight: 600">Distributor: Infra World</td>
				</tr>						
			</tbody>
		</table>
		<table class="price-table" cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<thead>
				<tr>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">SKU</th>
					<th width="48%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">NAME</th>
					<th width="13%" style="text-align: center; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">QTY</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">PRICE</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">Tax %</th>
					<th width="13%" style="text-align: left; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4;">TAX</th>
					<th width="13%" style="text-align: right; background: #F1F1F1; padding: 9px 4px; font-size: 14px; border-bottom: #D6D4D4; padding-right: 10px">AMOUNT</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($orderItems as $orderItem)
					<tr>
						<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $orderItem->sku_code }}</td>
						<td width="48%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">{{ $orderItem->name }}</td>
						<td width="13%" style="text-align: center; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">{{ $orderItem->quantity }}</td>
						<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">₹ {{ $orderItem->price }}</td>
						<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">{{ $orderItem->tax_percentage }}</td>
						<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; white-space: nowrap;">₹ {{ $orderItem->tax }}</td>
						<td width="13%" style="text-align: right; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4; padding-right: 10px; white-space: nowrap;">₹ {{ $orderItem->sub_total }}</td>
					</tr>
				@empty
					{{-- empty expr --}}
				@endforelse
				<tr>
					<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">&nbsp;</td>
					<td width="48%" style="text-align: left; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 18px; font-weight: 600;">SUBTOTAL</td>
					<td width="13%" colspan="5" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 18px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">₹ {{ $order->sub_total }}</td>
				</tr>
				<tr>
					<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">&nbsp;</td>
					<td width="48%" style="text-align: left; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 18px; font-weight: 600;">TAX</td>
					<td width="13%" colspan="5" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 18px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">₹ {{ $order->tax }}</td>
				</tr>
				<tr>
					<td width="13%" style="text-align: left; padding: 9px 4px; font-size: 14px; border-bottom: 1px solid #D6D4D4;">&nbsp;</td>
					<td width="48%" style="text-align: left; padding: 9px 4px; border-bottom: 1px solid #D6D4D4; font-size: 18px; font-weight: 600;">TOTAL</td>
					<td width="13%" colspan="5" style="text-align: right; padding: 9px 4px; padding-right: 10px;font-size: 18px; font-weight: 600; border-bottom: 1px solid #D6D4D4;">₹ {{ $order->amount }}</td>
				</tr>
			</tbody>
		</table>
		@if(!empty($order->notes))
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="color:#FF8000; font-size: 16px; font-family: arial; padding-top: 10px; padding-bottom: 10px; font-weight: 600">Order Notes</td>
				</tr>
				<tr>
					<td style="color:#000; font-size: 14px; font-family: arial; padding-top: 10px; padding-bottom: 10px; font-weight: normal; line-height:20px;">{{ $order->notes }}</td>
				</tr>						
			</tbody>
		</table>
		@endif

		
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
					<td style="background: #0048BA; padding-left: 15px; padding-top: 10px; padding-bottom: 10px"><img src="https://sa.infraworld.in/images/logo-dark.png" alt="InfraWorld"></td>
					<td style="background:#0048BA; text-align: right; padding-right: 15px; padding-top: 10px; padding-bottom: 10px">
						<a href="#" target="_blank" style="color: #fff; font-size: 14px; text-decoration: none; font-family: arial">Help</a>
					</td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center" style="border-bottom: 1px solid #D6D4D4">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 10px; font-size: 12px; padding-bottom: 10px; font-family: arial;">©2022 InfraWorld. All Rights Reserved.</td>
					<td style="text-align: right; padding-right:0px; padding-top: 10px; padding-bottom: 10px; font-family: arial;">
						
						<a href="#" target="_blank" style="color: #000; font-size: 12px; text-decoration: none; font-family: arial">Facebook</a> | 
						<a href="#" target="_blank" style="color: #000; font-size: 12px; text-decoration: none; font-family: arial">Twitter</a> | 
						<a href="#" target="_blank" style="color: #000; font-size: 12px; text-decoration: none; font-family: arial">LinkedIn</a>
					</td>
				</tr>
			</tbody>
		</table>
		<table cellpadding="0" cellspacing="0" border="0" width="650" align="center">
			<tbody>
				<tr>
					<td style="padding-left:0px; padding-top: 10px; font-size: 11px; padding-bottom: 10px; color: #7F7F7F; font-family: arial;">This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>