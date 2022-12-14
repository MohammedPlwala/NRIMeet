<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'payu-payment-cancel',
        'payu-money-payment-cancel',
        'payu-money-payment-success',
        'admin/report/combined',
        'payu-payment-success',
        'razorpay-payment'
    ];

    // protected $except = [
    //     '*',
    // ];
}
