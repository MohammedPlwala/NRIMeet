@extends('frontend.layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('payumoney/payu.css')}}">

<div class="payfrom">
    <div class="main-form position-relative">
        <div class="infyom-logo">
            <img src="{{asset('payumoney/infyom-logo.png')}}" alt="infyom logo">
        </div>
        <div class="text-center grp-logo">
            <img src="{{url('images/logo-dark.png')}}" alt="paymoney logo" class="logo" />
        </div>
        <br/>
        @if($formError)

            <span style="color:red">Please fill all mandatory fields.</span>
            <br/>
            <br/>
        @endif
        <form action="{{ $action }}" method="post" name="payuForm" class="pb-0">
            @csrf
            <input type="hidden" name="key" value="{{$MERCHANT_KEY}}"/>
            <input type="hidden" name="hash" value="{{$hash}}"/>
            <input type="hidden" name="txnid" value="{{$txnid}}"/>
            <div class="px-5 pt-4 pb-5 form-block">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3 position-relative">
                            <input type="text" class="input-box form-control w-100" placeholder="Name *"
                                   aria-label="Recipient's username"
                                   aria-describedby="button-addon2" name="firstname" readonly
                                   value="{{!empty($billingDetails['billing_first_name']) ? $billingDetails['billing_first_name'].' '.$billingDetails['billing_last_name'] : ''}}">
                            <div class="icon-group-append">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3 position-relative">
                            <input class="input-box form-control w-100" placeholder="Email *" type="email" name="email" readonly
                                   value="{{!empty($billingDetails['billing_email']) ? $billingDetails['billing_email'] : ''}}">
                            <div class="icon-group-append">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3 position-relative">
                            <input class="input-box form-control w-100" placeholder="Phone *" type="text" name="phone" readonly
                                   value="{{!empty($billingDetails['billing_phone']) ? $billingDetails['billing_phone'] : ''}}">
                            <div class="icon-group-append">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3 position-relative">
                            <input class="input-box form-control w-100" placeholder="Amount *" type="text" name="amount" readonly 
                                   value="{{!empty($bookingData['amount']) ? $bookingData['amount'] : '100000'}}">
                            <div class="icon-group-append">
                                <i class="fas fa-tag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3 position-relative">
                            <textarea readonly class="input-box form-control w-100" placeholder="Note *" name="productinfo">Hotel Booking</textarea>
                            <div class="icon-group-append">
                                <i class="fas fa-pencil-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           @if(!$hash)
            <div class="px-5 pt-0 pb-4">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="shb-booking-error-4-animation">please wait while your transaction is being processed.<br> do not close your browser or use <br>the back button at this time.</p>
                        
                        <button type="submit" class="btn btn-primary w-100 continue-pay-btn">Continue to pay</button>
                    </div>
                </div>
            </div>
            @endif
            <input name="surl" value="{{ url('payu-payment-success') }}" hidden/>
            <input name="furl" value="{{ url('payu-payment-cancel') }}" hidden/>

            <input type="hidden" name="bookingData" value="{{ json_encode($bookingData) }}">
            <input type="hidden" name="billingData" value="{{ json_encode($billingDetails) }}">

            <input type="hidden" name="service_provider" value="payu_paisa"/>
        </form>
    </div>
</div>
@endsection
@push('footerScripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>

<script>

    $(window).on('load', function(){
        submitPayuForm();
    });
        var hash = '{{$hash}}';

        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>

@endpush