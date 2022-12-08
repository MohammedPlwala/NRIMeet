@extends('frontend.layouts.app')

@section('content')
  <!-- Page Header -->
  <div class="page-header">
	<h1>My Bookings</h1>
  </div>
 <div class="container">

 	

	<div class="my-bookings-section">
 		@forelse ($bookings as $key => $booking)
	  	<div class="shb-booking-summary-wrapper">
			<div class="shb-booking-summary-item">
				<div class="shb-booking-summary-item-header">
					<h4>{{ $booking->hotel_name }} </h4> <a href="{{ url('booking-invoice/'.$booking->id) }}" class="primary-button sm"><em class="fas fa-download"></em> Download Invoice</a>
				</div>
				<ul>
				  	<li><strong>Dates:</strong> {{ date('d M, Y',strtotime($booking->check_in_date)) }} - {{ date('d M, Y',strtotime($booking->check_out_date)) }} ({{ $booking->nights }} Night)</li>
				  	<li><strong>Guests:</strong> {{ $booking->adults }} Adult, {{ $booking->childs }} Children</li>
				</ul>
				@forelse ($booking->rooms as $rkey => $room)
				<div class="shb-booking-summary-item-inner">
			  		<h5>Room {{ $rkey+1 }} </h5>
			  		<ul>
					  	<li><strong>Type:</strong> {{ $room->name }}</li>
					  	<li><strong>Rate:</strong> ₹{{ $room->rate }}/Night</li>
					  	@if($room->extra_bed)
					  	<li><strong>Extra Bed Rate:</strong> ₹{{ $room->extra_bed_cost }}</li></li>
					  	@endif
					  	<li><strong>Amount:</strong> ₹{{ $room->amount }}</li>
					  	<li><strong>Guests:</strong> {{ $booking->adults }} Adult, {{ $booking->childs }} Children</li>
					</ul>
			  		<div class="my_account_guest_box">
						<h5>Guests Infomation</h5>
						<div class="my_account_guest_inner">
							<p class="main_title_plural">Guests</p>
							<p class="child_title_plural">Adults 1: {{ $room->guest_one_name }}</p>
							@if(!empty($room->guest_two_name))
								<p class="child_title_plural">Adults 2: {{ $room->guest_two_name }}</p>
							@endif
							@if(!empty($room->guest_three_name))
								<p class="child_title_plural">Adults 3: {{ $room->guest_three_name }}</p>
							@endif
							@if(!empty($room->child_name))
								<p class="child_title_plural">Child 1: {{ $room->child_name }}</p>
							@endif
						</div>
			  		</div>
				</div>
				@empty
			  	@endforelse
			</div>
			<div class="shb-booking-summary-item amount_tax">
				<p><strong>Base Price: </strong> ₹{{ $booking->sub_total }}</p>
				<p><strong>TAX (18%): </strong> ₹{{ $booking->tax }}</p>
				<p><strong>Total: </strong> ₹{{ $booking->amount }}</p>
			</div>
	  	</div>
	  	@empty
	  	<h5>No Bookings</h5>
 		@endforelse
	</div>
</div>
@endsection
