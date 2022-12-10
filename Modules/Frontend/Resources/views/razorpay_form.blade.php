@extends('frontend.layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="pb-35">
        <div class="marquee">
            <marquee width="100%" direction="left" height="100px">
                Dear PBD Delegates, Govt of M.P. has revised the rates of hotel accommodation. Delegates who have booked the
                accommodation before 21/11/2022 16:00 hours IST, any excess amount charged will be refunded to their
                respective bank account with-in 15 working days.
            </marquee>
        </div>
    </div>
    <div class="container">
        <div class="shb-booking-page-wrapper shb-clearfix">
            <div class="shb-booking-page-main full-width">
                <form action="{{ url('razorpay-payment') }}" method="POST" id="billing_form">
                    <!-- Billing Details -->
                    @csrf
                    
                    <input type="hidden" name="bookingData" value="{{ json_encode($bookingData) }}">
                    <input type="hidden" name="billingData" value="{{ json_encode($data) }}">

                    <div class="razorpay-script"></div>

                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ config('constants.RAZORPAY_KEY') }}" {{-- data-amount="{{ $bookingData['amount']*100 }}" --}}
                        data-amount="{{ $bookingData['amount'] }}" data-buttontext="" data-name="NRI MEET" data-description="PBD NRI MEET"
                        data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png" data-prefill.name="name"
                        data-prefill.email="email" data-theme.color="#ff7529"></script>
                    <input style="display:none;" type="submit" value="Pay {{ $bookingData['amount'] }} INR" class="primary-button razorpay-payment-button">
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@push('footerScripts')
<script src="{{url('js/address.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.razorpay-payment-button').trigger('click');
    });
</script>

@endpush
