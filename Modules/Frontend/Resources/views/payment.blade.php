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
                <div class="shb-booking-step-wrapper booking-step-scroll shb-clearfix">
                    <div class="shb-booking-step shb-booking-step-current"><a href="{{ url('/search') }}">1</a><a
                            href="{{ url('/search') }}">Rooms</a></div>
                    <div class="shb-booking-step shb-booking-step-current"><a href="{{ url('/booking-summary') }}">2</a><a
                            href="{{ url('/booking-summary') }}">Booking Summary</a></div>
                    <div class="shb-booking-step shb-booking-step-current"><a href="javascript:void(0)">3</a><a
                            href="javascript:void(0)">Payment</a></div>
                    <div class="shb-booking-step "><a href="javascript:void(0)">4</a><a
                            href="javascript:void(0)">Complete</a></div>
                    <div class="shb-booking-step-line">
                        <div style="width:66%;"></div>
                    </div>
                </div>
                <form action="#" method="POST" id="billing_form">
                    <!-- Billing Details -->
                    <div id="billing_details" class="custom-form">
                        <h3 class="heading3">Billing details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-12 md:gap-y-4 gap-2">
                            <div class="form-item">
                                <label class="form-label">First name <span class="required"
                                        title="required">*</span></label>
                                <input type="text" name="billing_first_name" id="billing_first_name" value=""
                                    placeholder="First Name" required />
                            </div>
                            <div class="form-item">
                                <label class="form-label">Last name <span class="required" title="required">*</span></label>
                                <input type="text" name="billing_last_name" id="billing_last_name" value=""
                                    placeholder="Last Name" required />
                            </div>
                            <div class="form-item">
                                <label class="form-label">Company name <span class="required"
                                        title="optional">(optional)</span></label>
                                <input type="text" name="billing_company" id="billing_company" value=""
                                    placeholder="Company name" />
                            </div>

                            <div class="form-item">
                                <label class="form-label">Country / Region <span class="required"
                                        title="required">*</span></label>
                                <select name="billing_country" id="billing_country"
                                    class="country_to_state country_select select2-hidden-accessible" autocomplete="country"
                                    data-placeholder="Select a country / region???" data-label="Country / Region"
                                    tabindex="-1" aria-hidden="true" required>
                                    <option value="">Select a country / region???</option>
                                </select>
                            </div>
                            <div class="form-item" id="state_wrapper">
                                <label class="form-label"><span id="billing_state_label">State</span> <span class="required"
                                        title="required">*</span></label>
                                <div id="field_billing_state">
                                    <input type="text" class="input-text" name="state" id="state"
                                        placeholder="State" value="" required />
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label">Town / City <span class="required"
                                        title="required">*</span></label>
                                <input type="text" class="input-text" name="billing_city" id="billing_city"
                                    placeholder="Town / City" value="" autocomplete="address-level2" required />
                            </div>

                            <div class="form-item">
                                <label class="form-label">Street address <span class="required"
                                        title="required">*</span></label>
                                <input type="text" class="input-text " name="billing_address_1" id="billing_address_1"
                                    placeholder="House number and street name" value=""
                                    autocomplete="address-line1" data-gtm-form-interact-field-id="1" required />
                            </div>
                            <div class="form-item">
                                <label class="form-label">&nbsp;</label>
                                <input type="text" class="input-text " name="billing_address_2"
                                    id="billing_address_2" placeholder="Apartment, suite, unit, etc. (optional)"
                                    value="" autocomplete="address-line2" />
                            </div>
                            <div class="form-item">
                                <label class="form-label">PIN Code <span class="required"
                                        title="required">*</span></label>
                                <input type="text" class="input-text " name="billing_postcode" id="billing_postcode"
                                    placeholder="" value="" autocomplete="postal-code" required />
                            </div>

                            <div class="form-item hidden">
                                <label class="form-label">PBD Registration No <span class="required"
                                        title="optional">(optional)</span></label>
                                <input type="text" class="input-text " name="pbd_registration_no"
                                    id="pbd_registration_no" placeholder="PBD Registration No" value=""
                                    autocomplete="address-level2" />
                            </div>
                            <div class="form-item">
                                <label class="form-label">Phone <span class="required" title="required">*</span></label>
                                <input type="tel" class="input-text " name="billing_phone" id="billing_phone" data-parsley-pattern="{{ \Config::get('constants.REGEX.VALIDATE_NUMBER') }}"
                                    placeholder="" value="" autocomplete="tel" required />
                            </div>
                            <div class="form-item">
                                <label class="form-label">Email Address <span class="required"
                                        title="required">*</span></label>
                                <input type="email" class="input-text " name="billing_email" id="billing_email"
                                    placeholder="" value="" autocomplete="email username"
                                    data-gtm-form-interact-field-id="0" required />
                            </div>

                            <div class="form-item">
                                <label class="form-label">Alternate Phone <span class="required"
                                        title="optional">(optional)</span></label>
                                <input type="tel" class="input-text " name="billing_phone2" id="billing_phone2" data-parsley-pattern="{{ \Config::get('constants.REGEX.VALIDATE_NUMBER') }}"
                                    placeholder="Alternate Phone" value="" />
                            </div>
                            <div class="form-item">
                                <label class="form-label">Alternate Email Address <span class="required"
                                        title="optional">(optional)</span></label>
                                <input type="text" class="input-text" name="billing_email2" id="billing_email2"
                                    placeholder="Alternate Email Address" value="" />
                            </div>
                        </div>
                    </div>
                    <div id="booking_summary">
                        <h3 class="heading3">Booking Summary</h3>
                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <table class="shop_table woocommerce-checkout-review-order-table">
                                <thead>
                                    <tr>
                                        <th class="product-name">Room Payment Details</th>
                                        <th class="product-total text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td class="text-right"><span class="woocommerce-Price-amount amount"><bdi><span
                                                        class="woocommerce-Price-currencySymbol">???</span>@convert($bookingData['sub_total'])</bdi></span>
                                        </td>
                                    </tr>
                                    <tr class="tax-rate tax-rate-2">
                                        <th>GST 18%</th>
                                        <td class="text-right"><span class="woocommerce-Price-amount amount"><span
                                                    class="woocommerce-Price-currencySymbol">???</span>@convert($bookingData['tax'])</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td class="text-right">
                                            <strong><span class="woocommerce-Price-amount amount"><bdi><span
                                                            class="woocommerce-Price-currencySymbol">???</span>@convert($bookingData['amount'])</bdi></span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>


                    <div class="payment-radio-list">
                        <div class="payment-radio-list-item">
                            <input type="radio" name="gateway" class="gateway" value="payumoney"
                                id="payumoney_radio" />
                            <label for="payumoney_radio">
                                Credit Card/Debit Card/NetBanking/UPI
                                <img src="{{ url('/images/payubizlogo.png') }}" alt="payubizlogo" />
                            </label>
                            <div class="payment_box payment_method_payumoney">
                                <p>Pay securely by Credit or Debit card or net banking through PayUBiz.</p>
                            </div>
                        </div>
                        {{-- <div class="payment-radio-list-item">
                            <input type="radio" name="gateway" class="gateway" value="razorpay" id="razorpay_radio" />
                            <label for="razorpay_radio">
                                Credit Card/Debit Card/NetBanking/UPI
                                <img src="{{ url('/images/icici-logo.png') }}" alt="icici-logo" />
                            </label>
                            <div class="payment_box payment_method_razorpay">
                                <p>Pay securely by Credit or Debit card or net banking through RazorPay.</p>
                            </div>
                        </div> --}}
                    </div>

                    @csrf

                    <input type="hidden" name="bookingData" value="{{ json_encode($bookingData) }}">

                    <div class="razorpay-script"></div>

                    <div class="payment-buttons">
                        <input type="submit" value="Pay Now" class="primary-button md razorpay-payment-button"
                            style="display:none" />
                        <input type="submit" value="Pay Now" class="primary-button md payu-payment-button"
                            style="display:none" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@push('footerScripts')
    <script src="{{ url('js/address.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.gateway').change(function() {
                var gateway = $(this).val();

                var root_url = "<?php echo Request::root(); ?>";
                var action = '';


                if (gateway == 'payumoney') {
                    action = root_url + '/payu-payment';
                    $('.razorpay-payment-button').hide();
                    $('.payu-payment-button').show();
                    $('.payment_method_payumoney').slideDown("fast");
                    $('.payment_method_razorpay').slideUp("fast");
                    $('#billing_form').attr('action', action);
                }

                if (gateway == 'razorpay') {
                    action = root_url + '/razor-pay-form';
                    $('.payu-payment-button').hide();
                    $('.razorpay-payment-button').show();
                    $('.payment_method_razorpay').slideDown("fast");
                    $('.payment_method_payumoney').slideUp("fast");
                    $('#billing_form').attr('action', action);
                }
            });
        });
    </script>
@endpush
