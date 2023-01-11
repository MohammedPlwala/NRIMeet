@extends('frontend.layouts.app')

@section('content')
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
                        data-amount="{{ $bookingData['amount']*100 }}" data-buttontext="" data-name="Pravasi Bhartiya Divas" data-description="17th Pravasi Bhartiya Divas 2023"
                        data-image="https://pbdaccommodation.mptourism.com/images/PBD.png" data-prefill.name="name"
                        data-prefill.email="email" data-theme.color="#ff7529"></script>
                        <p class="shb-booking-error-4-animation text-center">Please wait while your transaction is being processed.<br> do not close your browser or use <br>the back button at this time.</p>
                        <div class="text-center"><input type="submit" value="Pay {{ $bookingData['amount'] }} INR" class="primary-button razorpay-payment-button"></div>
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
