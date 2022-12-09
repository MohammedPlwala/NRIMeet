@extends('admin.layouts.app')

@section('content')
<div class="dashboard-page">
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em
                            class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="more-options">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <a href="#" class="btn btn-outline-primary dropdown-toggle" data-toggle="modal"
                                    title="filter" data-target="#modalFilterUser">
                                    <em class="icon ni ni-filter"></em><span>Filter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="row g-gs">
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
                                    <div class="title">Total Booking</div>
                                    <div class="count">
                                        0.00
                                    </div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-calender-date"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">CC Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-calendar-booking"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Failed Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-calendar-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Booking Recevied</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-success-dim ni ni-calendar-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending Bookings</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Booking Requested</div>
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
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancelled Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-cross-circle"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Requested</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">High Hotel Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-trend-up"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Lowest Hotel Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-trend-down"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Room Type Booked</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-home"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Adutls</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-user-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Kids</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-secondary-dim ni ni-user"></em>
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
                                    <div class="title">Under Processing</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-reload-alt"></em>
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
                                    <div class="title">Payment Cancelled</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-danger-dim ni ni-cross-circle"></em>
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
                                    <div class="title">Payment Via - Debit Card</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-secondary-dim ni ni-cc-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Via - Credit Card</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-cc-alt2"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Via - Swift Transction </div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-cc-new"></em>
                            </li>
                        </ul>
                        <!-- <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Payment Via</h6>
                            </div>
                        </div>
                        <div class="analytic-data-group analytic-ov-group g-3">
                            <div class="analytic-data analytic-ov-data">
                                <div class="title">Debit Card</div>
                                <div class="amount">Rs. 2000.00</div>
                            </div>
                            <div class="analytic-data analytic-ov-data">
                                <div class="title">Credit Card</div>
                                <div class="amount">Rs. 3000.00</div>
                            </div>
                            <div class="analytic-data analytic-ov-data">
                                <div class="title">Swift Transction</div>
                                <div class="amount">Rs. 6000.00</div>
                            </div>
                        </div> -->
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
                                    <div class="title">Booked Inventory</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-success-dim ni ni-list-check"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Under Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-list-ol"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">CC Reserve</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-pink-dim ni ni-lock-alt"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">On Hold</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Under Cancellation</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-warning-dim ni ni-cross-circle"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Stock Out</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-danger-dim ni ni-wallet-out"></em>
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
    <div class="modal fade zoom" tabindex="-1" id="modalFilterUser">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form role="form" class="mb-0" method="get" action="#">
                @csrf
                <div class="modal-body modal-body-lg">
                    <div class="gy-3">
                        <div class="row g-3 align-center">
                            <div class="col-lg-5">
                                <x-inputs.verticalFormLabel label="Date" for="date" suggestion="Select the date." />
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div>
                                    <input type="text" class="form-control date-picker" placeholder="Date" data-date-format="yyyy-mm-dd" id="date" name="date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="userId" name="user_id" value="0">
                <div class="modal-footer bg-light">
                    <div class="row">
                        <div class="col-lg-12 p-0 text-right">
                            <button class="btn btn-outline-light" data-dismiss="modal" aria-label="Close">Cancel</button>
                            <button class="btn btn-danger resetFilter" data-dismiss="modal" aria-label="Close">Clear Filter</button>
                            <button class="btn btn-primary submitBtn" type="button">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- .dashboard-page -->
@endsection
