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
                <button type="button" class="primary-button" onclick="pay()" class="btn">Pay</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@push('footerScripts')

    <script src="https://services.billdesk.com/checkout-widget/src/app.bundle.js"></script>
    <script type="text/javascript">
        var root_url = "<?php echo Request::root(); ?>";
        function pay() {
            $.ajax({
                type: 'GET',
                url: root_url+'/getChecksum',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    var url = root_url+'/billdesk-payment-response';
                    bdPayment.initialize({
                        // "msg": "MPSTDWCV2|7410|NA|100.00|NA|NA|NA|INR|DIRECT|R|6rVIafDL8nyzydKEAEGmXl0srhAENnjx|NA|NA|F|vikalp|8989067984|NA|NA|NA|NA|NA|NA|"+data,
                        "msg": "MPSTDWCV2|789654|NA|100.00|NA|NA|NA|INR|DIRECT|R|@Mpstdc1978|NA|NA|F|john@doe1.com|8989067984|NA|NA|NA|NA|NA|NA|"+data,
                        "options": {
                            "isSICCAllowed":true,
                            "isCsMsgMerc":true,
                            "AllowTezPayMode":true,
                            "isQPAllowed ":true,
                            "enableChildWindowPosting": false,
                            "enablePaymentRetry": false,
                            "retry_attempt_count": 0,
                            "txtPayCategory": "NETBANKING",
                            "paymentcategory": "clubs & associations",
                        },
                        "callbackUrl":       root_url+"/billdesk-payment-response"
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
@endpush
