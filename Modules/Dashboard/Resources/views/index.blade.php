@extends('admin.layouts.app')

@section('content')
<div class="dashboard-page">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="row g-3 align-center dashboard-date-filter">
                    <div class="col-lg-5">
                        <x-inputs.verticalFormLabel label="Date:" for="date" />
                    </div>
                    <div class="col-lg-7">
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-calendar"></em>
                            </div>
                            <input type="text" class="form-control date-picker" placeholder="Date" data-date-format="d-M-yyyy" id="date" name="date">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-3 col-sm-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Bulk Bookings</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">1,945</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">MEA Bookings</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">1,945</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayRevenue"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Online Bookings</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">1,945</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayCustomers"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg6">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Offline Bookings</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">1,945</div>
                                    <div class="nk-ecwg6-ck">
                                        <canvas class="ecommerce-line-chart-s3" id="todayVisitors"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Cancellation Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancellation Recevied</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancellation Request</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancellation Approved</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Refund Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Requested</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Approved</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Issued</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Guest Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Adutls</div>
                                    <div class="count">525</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Kids</div>
                                    <div class="count">10</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Room Type Booking Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Booking Stats</h6>
                            </div>
                        </div>
                        <!-- <div class="analytic-wp-group g-3">
                            <div class="analytic-data analytic-wp-data">
                                <div class="analytic-wp-graph">
                                    <div class="title">Total Booking</div>
                                </div>
                                <div class="analytic-wp-text">
                                    <div class="amount amount-sm">0.00</div>
                                </div>
                            </div>
                            <div class="analytic-data analytic-wp-data">
                                <div class="analytic-wp-graph">
                                    <div class="title">Pageviews <span>(avg)</span></div>
                                </div>
                                <div class="analytic-wp-text">
                                    <div class="amount amount-sm">5.48</div>
                                </div>
                            </div>
                            <div class="analytic-data analytic-wp-data">
                                <div class="analytic-wp-graph">
                                    <div class="title">New Users <span>(avg)</span></div>
                                </div>
                                <div class="analytic-wp-text">
                                    <div class="amount amount-sm">549</div>
                                </div>
                            </div>
                            <div class="analytic-data analytic-wp-data">
                                <div class="analytic-wp-graph">
                                    <div class="title">Time on Site <span>(avg)</span></div>
                                </div>
                                <div class="analytic-wp-text">
                                    <div class="amount amount-sm">3m 35s</div>
                                </div>
                            </div>
                        </div> -->
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Bookings</div>
                                    <div class="count">
                                        0.00
                                    </div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-calender-date"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Failed Bookings</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-calendar-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Bookings Recevied</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-success-dim ni ni-calendar-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Bookings Shared</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Confirmation Recevied</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Extra Bed Count</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-inbox"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Payment Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Payment</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-sign-inr"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Confirmed</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Failed</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-stop-circle-fill"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Approved</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-check-round-cut"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Issued</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Inventory Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Inventory</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-list-round"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base Allocated</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-list-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base Booked</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-list-ol"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base Available</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Base MPT</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium Allocated</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-list-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium Booked</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-list-ol"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium Available</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Premium MPT</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite Allocated</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-list-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite Booked</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-list-ol"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite Available</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Suite MPT</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Under Cancellation</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-cross-circle"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-3 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Customer Care</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Calls Till Date</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-call"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Todays Call</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-call-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Whstapp Till Date</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-whatsapp"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Whstapp Today</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-purple-dim ni ni-whatsapp"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Concenrs</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-question"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Closed Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-question-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Open Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-chat"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Esclated Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-growth"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending with MEA</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-clock"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending with MPTDC</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-clock"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
</div><!-- .dashboard-page -->
@endsection
@push('footerScripts')
<script src="{{url('js/chart-ecommerce.js')}}"></script>
@endpush
