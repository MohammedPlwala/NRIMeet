@extends('admin.layouts.app')

@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Dashboard</h3>
            </div><!-- .nk-block-head-content -->
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
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Booking</div>
                                    <div class="count">1,795</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">CC Booking</div>
                                    <div class="count">2,327</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Failed Booking</div>
                                    <div class="count">674</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Booking Recevied</div>
                                    <div class="count">68</div>
                                </div>  
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending bookings</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Booking Requested</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Confirmation Recevied</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancellation Request</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancellation Approved</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Cancelled Booking</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Refund Requested</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Hight Hotel Booking</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Lowest Hotel Booking</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Room Type Booked</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Adutls</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Kids</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Extra Bed Count</div>
                                    <div class="count">68</div>
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
                                <h6 class="title">Payment Stats</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Payment</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Under Processing</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Confirmed</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Cancelled</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Failed</div>
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
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Via - Debit Card</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Via - Credit Card</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Payment Via - Swift Transction </div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                        <div class="card-title-group mb-2">
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
                        </div>
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
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Booked Inventory</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Under Booking</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">CC Reserve</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-purple-dim ni ni-server"></em>
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
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Stock Out</div>
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
                                <h6 class="title">Customer Care</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Calls till date</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Todays Call</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Whstapp Till Date</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Whstapp Today</div>
                                    <div class="count">0.00</div>
                                </div>  
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Total Concenrs</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Closed Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Open Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Esclated Concern</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending with MEA</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Pending with MPTDC</div>
                                    <div class="count">0.00</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->
@endsection
