@extends('layouts.app')

@section('content')
    <?php /*
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title page-title">Dashboard</h4>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    */?>
    <div>
        {{-- <ul class="nav nav-tabs mt-n3">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#data">Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#insights">Insights</a>
            </li>
        </ul> --}}
        <div class="tab-content">
            <div class="tab-pane active" id="data">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-inline float-sm-right" action="{{ url('dashboard') }}" method="get">
                            <div class="form-group ml-2">
                                <select class="form-select" name="month">
                                <option>Select Month</option>
                                @for ($i = 1; $i <= 12 ; $i++)
                                    <option 
                                    @if(isset($_GET['month']) && $_GET['month'] == $i) selected @elseif($i == date('m')) selected @endif
                                    value="{{ $i }}">{{ date('F',strtotime('01-'.$i.'-2020')) }}</option>
                                @endfor
                            </select>
                            </div>
                            <div class="form-group ml-2">
                                <select class="form-select" name="year">
                                    <option>Select Year</option>
                                    @for ($i = 2020; $i <= date('Y') ; $i++)
                                        <option 
                                        @if(isset($_GET['year']) && $_GET['year'] == $i) selected @elseif($i == date('Y')) selected @endif
                                        value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group ml-2">
                                <button class="btn btn-primary" type="submit">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="nk-block custom-dashboard">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Orders by Status</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-success">Completed</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['completed']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['completed']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-info">Unapproved</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['unapproved']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['unapproved']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-success">Accepted</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['accepted']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['accepted']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-warning">Processing</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['processing']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['processing']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-danger">Declined</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['declined']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['declined']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-danger">Cancelled</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['cancelled']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['cancelled']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-primary">Invoiced</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['invoiced']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['invoiced']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <div class="nk-ecwg nk-ecwg6">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title text-secondary">Shipped</h6>
                                            </div>
                                        </div>
                                        <div class="data">
                                            <div class="data-group">
                                                <div class="amount">₹ @convert($orderByStatus['shipped']['amount'])</div>
                                                <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>{{ $orderByStatus['shipped']['orders'] }}</span><span> Orders</span></div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .nk-ecwg -->
                            </div><!-- .card -->
                        </div><!-- .col -->

                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Revenue</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title card-title-sm">
                                                <h6 class="title">Sales</h6>
                                                <p>Overall Sales</p>
                                            </div>
                                            {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                            <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                            </ul>
                                            </div> --}}
                                        </div>
                                        <div class="data-group mb-0">
                                            <div class="data">
                                                <div class="title">Sales</div>
                                                <div class="amount amount-sm">₹ @convert($orders->totalSales)</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>12.37%</div> --}}
                                            </div>
                                            <div class="data">
                                                <div class="title">Orders</div>
                                                <div class="amount amount-sm">{{ $orders->totalOrders }}</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>47.74%</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-3 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title card-title-sm">
                                                <h6 class="title">Collection</h6>
                                                <p>@if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else @if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else Current Month @endif  @endif collection</p>
                                            </div>
                                        </div>
                                        <div class="data-group mb-0">
                                            <div class="data">
                                                <div class="title">Collection</div>
                                                <div class="amount amount-sm">₹ @convert($collection)</div>
                                                {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div> --}}
                                            </div>
                                            <div class="data">
                                                <div class="title">Outstanding</div>
                                                <div class="amount amount-sm">₹ @convert($outstanding)</div>
                                                {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>0.35%</div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title card-title-sm">
                                                <h6 class="title">Sales & Orders</h6>
                                                <p>@if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else Current Month @endif  Sales & Orders</p>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="" data-original-title="Users of this month"></em>
                                            </div>
                                        </div>
                                        <div class="data-group mb-0">
                                            <div class="data">
                                                <div class="title">Today</div>
                                                <div class="amount amount-sm">₹ @convert($today_order->todayAmount)</div>
                                                <div class="title fs-16px">{{ $today_order->todayOrders }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">This Week</div>
                                                <div class="amount amount-sm">₹ @convert($week_order->weekAmount)</div>
                                                <div class="title fs-16px">{{ $week_order->weekOrders }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">This Month</div>
                                                <div class="amount amount-sm">₹ @convert($month_order->monthAmount)</div>
                                                <div class="title fs-16px">{{ $month_order->monthOrders }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">DSP</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card card-bordered h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title card-title-sm">
                                                <h6 class="title">DSP</h6>
                                                <p>@if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else Current Month @endif </p>
                                            </div>
                                            {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                                <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                    <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                    <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                                </ul>
                                            </div> --}}
                                        </div>
                                        <div class="data-group mb-0">
                                            <div class="data">
                                                <div class="title">Today</div>
                                                <div class="amount amount-sm">₹ @convert($dsp_today_order->todayAmount)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">This Week</div>
                                                <div class="amount amount-sm">₹ @convert($dsp_week_order->weekAmount)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">This Month</div>
                                                <div class="amount amount-sm">₹ @convert($dspOrders->totalAmount)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Avg. Order/DSP</div>
                                                <div class="amount amount-sm">₹ @convert($dspOrders->averageDspOrder)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Zero Billing</div>
                                                <div class="amount amount-sm">{{ $dspOrders->zeroBillingDsp }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Target Achieved</div>
                                                <div class="amount amount-sm">{{ $targetsAchieved }}</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Target Failed</div>
                                                <div class="amount amount-sm">{{ $targetsFailed }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        {{-- <div class="col-md-3 col-lg-5 col-xxl-5">
                            <div class="card card-bordered h-100">
                                <div class="nk-ecwg nk-ecwg5">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start pb-3 g-2">
                                            <div class="card-title card-title-sm">
                                                <h6 class="title">DSP Orders</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                            </div>
                                        </div>
                                        <div class="data-group mb-0">
                                            <div class="data">
                                                <div class="title">Monthly</div>
                                                <div class="amount amount-sm">₹ @convert($dspOrders->totalAmount)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Weekly</div>
                                                <div class="amount amount-sm">₹ @convert($dsp_week_order->weekAmount)</div>
                                            </div>
                                            <div class="data">
                                                <div class="title">Daily</div>
                                                <div class="amount amount-sm">₹ @convert($dsp_today_order->todayAmount)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div> --}}<!-- .col -->
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card h-100">
                                <div class="card-inner mb-n2">
                                    <div class="card-title-group">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Target vs Achievement - DSP</h6>
                                            <p>Achievement Metrics of DSP.</p>
                                        </div>
                                        {{-- <div class="card-tools">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">30 Days</a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>7 Days</span></a></li>
                                                        <li><a href="#"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="nk-block table-compact">
                                    <div class="nk-tb-list is-separate is-medium mb-3">
                                        <table id="SP_target" class="products-init nowrap nk-tb-list is-separate table-head-bottom" data-auto-responsive="false">
                                            <thead>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col tb-col-mb" rowspan="2"><span class="sub-text">Sales Person</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center" colspan="2"><span class="sub-text">Sales</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center" colspan="2"><span class="sub-text">Orders</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center" colspan="2"><span class="sub-text">Line Items</span></th>
                                                </tr>
                                                <tr class="nk-tb-item nk-tb-head">
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Target</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Achievement</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Target</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Achievement</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Target</span></th>
                                                    <th class="nk-tb-col tb-col-mb text-center"><span class="sub-text">Achievement</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($targets as $target)
                                                    <tr class="nk-tb-item">
                                                        <td class="nk-tb-col tb-col-lg">{{ ucfirst($target->username) }}</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">₹ @convert($target->total_sales)</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">₹ @convert($target->achivedSales)</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">{{ $target->total_orders }}</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">{{ $target->achivedOrders }}</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">{{ $target->total_line_items }}</td>
                                                        <td class="nk-tb-col tb-col-lg text-center">{{ $target->achivedItems }}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td class="nk-tb-col tb-col-lg text-center" colspan="7">No Targets</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="nk-tb-list is-loose traffic-channel-table">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-channel"><span>DSP Name</span></div>
                                        <div class="nk-tb-col nk-tb-sessions"><span>Target</span></div>
                                        <div class="nk-tb-col nk-tb-prev-sessions"><span>Achievement</span></div>
                                        
                                        <div class="nk-tb-col nk-tb-change"><span>Difference</span></div>
                                        <div class="nk-tb-col nk-tb-change"><span>No. Orders</span></div>
                                        <div class="nk-tb-col nk-tb-change"><span>Orders Amount</span></div>
                                    </div><!-- .nk-tb-head -->
                                    @forelse ($targets as $target)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-channel">
                                                <span class="tb-lead">{{ ucfirst($target->username) }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-sessions">
                                                <span class="tb-sub tb-amount"><span>₹ @convert($target->total_sales)</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions">
                                                <span class="tb-sub tb-amount"><span>₹ @convert($target->achivedSales)</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change">

                                                @php
                                                    if($target->total_sales > $target->achivedSales){
                                                        $arrow = 'down';

                                                        $difference = (($target->total_sales - $target->achivedSales)*100)/$target->total_sales ;
                                                        $difference = number_format((float) $difference, 2, '.', '');
                                                    }elseif($target->total_sales < $target->achivedSales){
                                                        $arrow = 'up';

                                                        $difference = (($target->achivedSales - $target->total_sales)*100)/$target->achivedSales ;
                                                        $difference = number_format((float) $difference, 2, '.', '');
                                                    }else{
                                                        $difference = 0;
                                                        $arrow = 'up';
                                                    }

                                                @endphp

                                                <span class="tb-sub"><span>{{ $difference }}%</span> <span class="change up"><em class="icon ni ni-arrow-long-{{ $arrow }}"></em></span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change">
                                                <span class="tb-sub"><span>{{ $target->achivedOrders }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change">
                                                <span class="tb-sub"><span>₹ @convert($target->achivedSales)</span></span>
                                            </div>
                                        </div>
                                    @empty
                                        
                                    @endforelse
                                </div> --}}
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Buyer</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Buyers</h6>
                                        </div>
                                        {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                            <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <ul class="nk-store-statistics">
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Sales</div>
                                                <div class="count">₹ @convert($buyerOrders->totalAmount)</div>
                                            </div>
                                            <em class="icon bg-primary-dim ni ni-bag"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Avg. Order/Buyer</div>
                                                <div class="count">₹ @convert($buyerOrders->averageBuyerOrder)</div>
                                            </div>
                                            <em class="icon bg-pink-dim ni ni-box"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Zero Billing</div>
                                                <div class="count">{{ $buyerOrders->zeroBillingBuyer }}</div>
                                            </div>
                                            <em class="icon bg-purple-dim ni ni-server"></em>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-lg-3 col-xxl-3">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Buyer New Registrations</h6>
                                        </div>
                                    </div>
                                    <ul class="nk-store-statistics">
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">Today</div>
                                                <div class="count">{{ $todayRetailers }}</div>
                                            </div>
                                            <em class="icon bg-primary-dim ni ni-bag"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">This Week</div>
                                                <div class="count">{{ $weekRetailers }}</div>
                                            </div>
                                            <em class="icon bg-pink-dim ni ni-box"></em>
                                        </li>
                                        <li class="item">
                                            <div class="info">
                                                <div class="title">This Month</div>
                                                <div class="count">{{ $monthRetailers }}</div>
                                            </div>
                                            <em class="icon bg-purple-dim ni ni-server"></em>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            <div class="card h-100">
                                <div class="card-inner mb-n2">
                                    <div class="card-title-group pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Category Wise Buyer Sales</h6>
                                        </div>
                                        {{-- <div class="card-tools mt-n1 mr-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="active"><span>@if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else Current Month @endif </span></a></li>
                                                        <li><a href="#"><span>Previous Month</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="nk-tb-list catgory-list-pad is-loose traffic-channel-table">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-channel"><span>Category</span></div>
                                        <div class="nk-tb-col nk-tb-sessions text-center"><span>No. of Buyers</span></div>
                                        <div class="nk-tb-col nk-tb-prev-sessions text-center"><span>Buyer Orders</span></div>
                                        
                                        <div class="nk-tb-col nk-tb-change text-right"><span>Order Amount</span></div>
                                    </div><!-- .nk-tb-head -->
                                    @forelse ($categoryBuyers as $categoryBuyer)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-channel">
                                                <span class="tb-lead">{{ $categoryBuyer->category }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $categoryBuyer->count }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $categoryBuyer->totalOrders }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change text-right">
                                                <span class="tb-sub"><span>₹ @convert($categoryBuyer->totalAmount)</span></span>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
                                </div><!-- .nk-tb-list -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        
                        {{-- <div class="col-lg-6 ">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Orders Overview</h6>
                                            <p>In last 15 days completed and pending orders overview. <a href="#" class="link link-sm">Detailed Stats</a></p>
                                        </div>
                                        <div class="card-tools mt-n1 mr-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                        <li><a href="#"><span>3 Months</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-title-group -->
                                    <div class="nk-order-ovwg">
                                        <div class="row g-4 align-end">
                                            <div class="col-sm-6 col-xxl-6">
                                                <div class="nk-order-ovwg-data buy">
                                                    <div class="amount">12,954.63 <small class="currenct currency-usd">INR</small></div>
                                                    <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">INR</span></strong></div>
                                                    <div class="title"><em class="icon ni ni-arrow-down-left"></em> Completed Orders</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xxl-6">
                                                <div class="nk-order-ovwg-data sell">
                                                    <div class="amount text-danger">12,954.63 <small class="currenct currency-usd">INR</small></div>
                                                    <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">INR</span></strong></div>
                                                    <div class="title "><em class="icon ni ni-arrow-up-left"></em> Pending Orders</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .nk-order-ovwg -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-end g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Orders by Brands</h6>
                                            <p>Last 30 Days Orders</p>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                        </div>
                                    </div>
                                    <ul class="nk-top-products">
                                        <li class="item">
                                            <div class="thumb">
                                                <img src="{{url('images/product/a.png')}}" alt="">
                                            </div>
                                            <div class="info">
                                                <div class="title">Tata</div>
                                            </div>
                                            <div class="total">
                                                <div class="amount">$990.00</div>
                                                <div class="count">10 Sold</div>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="thumb">
                                                <img src="{{url('images/product/d.png')}}" alt="">
                                            </div>
                                            <div class="info">
                                                <div class="title">Maruti</div>
                                            </div>
                                            <div class="total">
                                                <div class="amount">$990.00</div>
                                                <div class="count">10 Sold</div>
                                            </div>
                                        </li>
                                        <li class="item">
                                            <div class="thumb">
                                                <img src="{{url('images/product/g.png')}}" alt="">
                                            </div>
                                            <div class="info">
                                                <div class="title">Hyundai</div>
                                            </div>
                                            <div class="total">
                                                <div class="amount">$990.00</div>
                                                <div class="count">10 Sold</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col --> --}}

                        <div class="col-xxl-12 col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Visit Insights</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-xxl-3">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start pb-3 g-2">
                                                <div class="card-title card-title-sm">
                                                    <h6 class="title">Monthly Visits</h6>
                                                </div>
                                            </div>
                                            <ul class="nk-store-statistics">
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">This Month</div>
                                                        <div class="count">{{ $monthvisits->totalVisits }}</div>
                                                    </div>
                                                    <em class="icon bg-primary-dim ni ni-bag"></em>
                                                </li>
                                                
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">This Week</div>
                                                        <div class="count">{{ $weekvisits }}</div>
                                                    </div>
                                                    <em class="icon bg-pink-dim ni ni-box"></em>
                                                </li>
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Today</div>
                                                        <div class="count">{{ $todayvisits }}</div>
                                                    </div>
                                                    <em class="icon bg-purple-dim ni ni-server"></em>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xxl-3">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start pb-3 g-2">
                                                <div class="card-title card-title-sm">
                                                    <h6 class="title">On Field</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <h6>{{ $monthvisits->totalOnFieldVisits }}</h6>
                                                </div>
                                            </div>
                                            <ul class="nk-store-statistics">
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Planned</div>
                                                        <div class="count">{{ $monthvisits->totalOnFieldVisits }}</div>
                                                    </div>
                                                    <em class="icon bg-primary-dim ni ni-bag"></em>
                                                </li>
                                                
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Pending</div>
                                                        <div class="count">{{ $monthvisits->pendingOnFieldVisits }}</div>
                                                    </div>
                                                    <em class="icon bg-pink-dim ni ni-box"></em>
                                                </li>
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Completed</div>
                                                        <div class="count">{{ $monthvisits->completedOnFieldVisits }}</div>
                                                    </div>
                                                    <em class="icon bg-purple-dim ni ni-server"></em>
                                                </li>
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Cancelled</div>
                                                        <div class="count">{{ $monthvisits->cancelledOnFieldVisits }}</div>
                                                    </div>
                                                    <em class="icon bg-info-dim ni ni-users"></em>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xxl-3">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start pb-3 g-2">
                                                <div class="card-title card-title-sm">
                                                    <h6 class="title">Off Field</h6>
                                                </div>
                                                <div class="card-tools">
                                                    <h6>{{ $monthvisits->totalOffFieldVisits }}</h6>
                                                </div>
                                            </div>
                                            <ul class="nk-store-statistics">
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Holiday</div>
                                                        <div class="count">{{ $monthvisits->holidays }}</div>
                                                    </div>
                                                    <em class="icon bg-primary-dim ni ni-bag"></em>
                                                </li>
                                                
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Full Day Off</div>
                                                        <div class="count">{{ $monthvisits->fullDayOffs }}</div>
                                                    </div>
                                                    <em class="icon bg-pink-dim ni ni-box"></em>
                                                </li>
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">Half Day Off</div>
                                                        <div class="count">{{ $monthvisits->halfDayOffs }}</div>
                                                    </div>
                                                    <em class="icon bg-purple-dim ni ni-server"></em>
                                                </li>
                                                <li class="item">
                                                    <div class="info">
                                                        <div class="title">HO</div>
                                                        <div class="count">{{ $monthvisits->ho }}</div>
                                                    </div>
                                                    <em class="icon bg-info-dim ni ni-users"></em>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xxl-3">
                                    <div class="">
                                        <div class="">
                                            <div class="card card-bordered">
                                                <div class="nk-ecwg nk-ecwg6">
                                                    <div class="card-inner">
                                                        <div class="card-title-group">
                                                            <div class="card-title">
                                                                <h6 class="title">Productive</h6>
                                                            </div>
                                                        </div>
                                                        <div class="data">
                                                            <div class="data-group">
                                                                <div class="amount">{{ $monthvisits->productive }}</div>
                                                            </div>
                                                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-ecwg -->
                                            </div><!-- .card -->
                                            <div class="card  card-bordered">
                                                <div class="nk-ecwg nk-ecwg6">
                                                    <div class="card-inner">
                                                        <div class="card-title-group">
                                                            <div class="card-title">
                                                                <h6 class="title text-danger">Non Productive</h6>
                                                            </div>
                                                        </div>
                                                        <div class="data">
                                                            <div class="data-group">
                                                                <div class="amount text-danger">{{ $monthvisits->nonProductive }}</div>
                                                            </div>
                                                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .nk-ecwg -->
                                            </div><!-- .card -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card h-100">
                                <div class="card-inner mb-n2">
                                    <div class="card-title-group">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Visit Insights - DSP</h6>
                                        </div>
                                        {{-- <div class="card-tools">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-sm btn-outline-light btn-white" data-toggle="dropdown">30 Days</a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>7 Days</span></a></li>
                                                        <li><a href="#"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="nk-tb-list is-loose traffic-channel-table">
                                    <div class="nk-tb-item nk-tb-head">
                                        <div class="nk-tb-col nk-tb-channel"><span>DSP Name</span></div>
                                        <div class="nk-tb-col nk-tb-sessions text-center"><span>Planned</span></div>
                                        <div class="nk-tb-col nk-tb-prev-sessions text-center"><span>Pending</span></div>
                                        
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Completed</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Cancelled</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Holiday</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Full Day</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Half Day</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Ho</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Productive</span></div>
                                        <div class="nk-tb-col nk-tb-change text-center"><span>Non Productive</span></div>
                                    </div><!-- .nk-tb-head -->
                                    @forelse ($dspVisits as $dspVisit)
                                        <div class="nk-tb-item">
                                            <div class="nk-tb-col nk-tb-channel">
                                                <span class="tb-lead">{{ ucfirst($dspVisit->dspName) }}</span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->totalVisits }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->pendingOnFieldVisits }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->completedOnFieldVisits }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->cancelledOnFieldVisits }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->holidays }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->fullDayOffs }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->halfDayOffs }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-prev-sessions text-center">
                                                <span class="tb-sub tb-amount"><span>{{ $dspVisit->ho }}</span></span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change text-center">
                                                <span class="tb-sub"><span class="text-success">{{ $dspVisit->productive }}</span> </span>
                                            </div>
                                            <div class="nk-tb-col nk-tb-change text-center">
                                                <span class="tb-sub"><span class="text-danger">{{ $dspVisit->nonProductive }}</span> </span>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                    @empty
                                        {{-- empty expr --}}
                                    @endforelse
                                </div><!-- .nk-tb-list -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        
                        <div class="col-xxl-12">
                            <div class="card card-full card-tabs">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title"><span class="mr-2">Top 5</span></h6>
                                        </div>
                                        <div class="card-tools">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tabCategories"><span>Categories</span></a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabBuyers"><span>Buyers</span></a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabBrand"><span>Brand</span></a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tabDSP"><span>DSP</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner p-0 border-top">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabCategories">
                                            <div class="nk-tb-list nk-tb-orders">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Category Name</span></div>
                                                    <div class="nk-tb-col tb-col-sm text-center"><span>Sold Quantity</span></div>
                                                    <div class="nk-tb-col tb-col-md text-right"><span>Amount</span></div>
                                                    <div class="nk-tb-col tb-col-lg text-center"><span>Total Items</span></div>
                                                </div>
                                                @forelse ($topCategories as $category)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <span class="tb-lead">{{ $category->name }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-sm text-center">
                                                            <span class="tb-sub">{{ $category->totalQuantity }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md text-right">
                                                            <span class="tb-sub">₹ @convert($category->totalAmount)</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md text-center">
                                                            <span class="tb-sub">{{ $category->items }}</span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    {{-- empty expr --}}
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabBuyers">
                                            <div class="nk-tb-list nk-tb-orders">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col tb-col-sm"><span>Company Name</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span>Contact Person</span></div>
                                                    <div class="nk-tb-col text-right"><span>Amount</span></div>
                                                    <div class="nk-tb-col text-center"><span>Total Orders</span></div>
                                                </div>
                                                @forelse ($topBuyers as $buyers)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col tb-col-sm">
                                                            <div class="user-card">
                                                                <div class="user-avatar user-avatar-sm bg-purple">
                                                                    <span>{{ \Helpers::getAcronym($buyers->shop_name) }}</span>
                                                                </div>
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{ ucfirst($buyers->shop_name) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span class="tb-sub">{{ ucfirst($buyers->username) }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg text-right">
                                                            <span class="tb-sub">₹ @convert($buyers->totalAmount)</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg text-center">
                                                            <span class="tb-sub">{{ $buyers->totalOrders }}</span>
                                                        </div>  
                                                    </div>
                                                @empty
                                                    {{-- empty expr --}}
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabBrand">
                                            <div class="nk-tb-list nk-tb-orders">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span>Brand Name</span></div>
                                                    <div class="nk-tb-col tb-col-sm text-center"><span>Sold Quantity</span></div>
                                                    <div class="nk-tb-col tb-col-md text-right"><span>Amount</span></div>
                                                    <div class="nk-tb-col tb-col-lg text-center"><span>Total Items</span></div>
                                                </div>
                                                @forelse ($topBrands as $brand)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col">
                                                            <span class="tb-lead">{{ $brand->name }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-sm text-center">
                                                            <span class="tb-sub">{{ $brand->totalQuantity }}</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md text-right">
                                                            <span class="tb-sub">₹ @convert($brand->totalAmount)</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md text-center">
                                                            <span class="tb-sub">{{ $brand->items }}</span>
                                                        </div>
                                                    </div>
                                                @empty
                                                    {{-- empty expr --}}
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabDSP">
                                            <div class="nk-tb-list nk-tb-orders">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col tb-col-sm"><span>DSP Name</span></div>
                                                    <div class="nk-tb-col text-right"><span>Amount</span></div>
                                                    <div class="nk-tb-col text-center"><span>Total Orders</span></div>
                                                </div>
                                                @forelse ($topsalesPersons as $sp)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col tb-col-sm">
                                                            <div class="user-card">
                                                                <div class="user-avatar user-avatar-sm bg-purple">
                                                                    <span>{{ \Helpers::getAcronym($sp->username) }}</span>
                                                                </div>
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{ ucfirst($sp->username) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg text-right">
                                                            <span class="tb-sub">₹ @convert($sp->totalAmount)</span>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-lg text-center">
                                                            <span class="tb-sub">{{ $sp->totalOrders }}</span>
                                                        </div>  
                                                    </div>
                                                @empty
                                                    {{-- empty expr --}}
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner-sm border-top text-center d-sm-none">
                                    <a href="#" class="btn btn-link btn-block">See History</a>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="insights">
            <div class="nk-block custom-dashboard">
                    <div class="row g-gs">
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Revenue</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Sales</h6>
                                        </div>
                                        {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                            <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="analytic-ov">
                                        <div class="analytic-data-group analytic-ov-group g-3">
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Sales</div>
                                                <div class="amount">₹ @convert($orders->totalSales)</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>12.37%</div> --}}
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Orders</div>
                                                <div class="amount">{{ $orders->totalOrders }}</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>47.74%</div> --}}
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Collection</div>
                                                <div class="amount">₹ @convert($collection)</div>
                                                {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>12.37%</div> --}}
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Receivable</div>
                                                <div class="amount">₹0</div>
                                                {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>0.35%</div> --}}
                                            </div>
                                        </div>
                                        <div class="analytic-ov-ck">
                                            <canvas class="analytics-line-large" id="analyticOvData"></canvas>
                                        </div>
                                        <div class="chart-label-group ml-5">
                                            <div class="chart-label">01 Jan, 2020</div>
                                            <div class="chart-label d-none d-sm-block">15 Jan, 2020</div>
                                            <div class="chart-label">30 Jan, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Sales & Orders</h6>
                                            <p>@if(isset($_GET['month']) && isset($_GET['year'])) {{ date('F-Y',strtotime('01-'.$_GET['month'].'-'.$_GET['year'])) }} @else Current Month @endif  Sales & Orders</p>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                        </div>
                                    </div>
                                    <div class="analytic-au">
                                        <div class="analytic-data-group analytic-au-group g-3">
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">Today</div>
                                                <div class="amount">₹ @convert($today_order->todayAmount)</div>
                                                <div class="title fs-16px">{{ $today_order->todayOrders }}</div>
                                            </div>
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">This Week</div>
                                                <div class="amount">₹ @convert($week_order->weekAmount)</div>
                                                <div class="title fs-16px">{{ $week_order->weekOrders }}</div>
                                            </div>
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">This Month</div>
                                                <div class="amount">₹ @convert($month_order->monthAmount)</div>
                                                <div class="title fs-16px">{{ $month_order->monthOrders }}</div>
                                            </div>
                                        </div>
                                        <div class="analytic-au-ck">
                                            <canvas class="analytics-au-chart" id="analyticAuDatas1"></canvas>
                                        </div>
                                        <div class="chart-label-group">
                                            <div class="chart-label">01 Jan, 2020</div>
                                            <div class="chart-label">30 Jan, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">DSP</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-lg-7 col-xxl-7">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">DSP</h6>
                                            <p>Last 30 Days Orders</p>
                                        </div>
                                        {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                            <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="analytic-ov dsp-analytics">
                                        <div class="analytic-data-group analytic-ov-group g-3">
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Sales</div>
                                                <div class="amount">₹ @convert($dspOrders->totalAmount)</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Avg. Order/DSP</div>
                                                <div class="amount">₹ @convert($dspOrders->averageDspOrder)</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Zero Billing</div>
                                                <div class="amount">{{ $dspOrders->zeroBillingDsp }}</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Target Achieved</div>
                                                <div class="amount">{{ $targetsAchieved }}</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Target Failed</div>
                                                <div class="amount">{{ $targetsFailed }}</div>
                                            </div>
                                        </div>
                                        <div class="analytic-ov-ck">
                                            <canvas class="analytics-line-large" id="analyticOvData1"></canvas>
                                        </div>
                                        <div class="chart-label-group ml-5">
                                            <div class="chart-label">01 Jan, 2020</div>
                                            <div class="chart-label d-none d-sm-block">15 Jan, 2020</div>
                                            <div class="chart-label">30 Jan, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-3 col-lg-5 col-xxl-5">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">DSP Orders</h6>
                                            
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                        </div>
                                    </div>
                                    <div class="analytic-au">
                                        <div class="analytic-data-group analytic-au-group g-3">
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">Monthly</div>
                                                <div class="amount">₹ @convert($dspOrders->totalAmount)</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%</div> --}}
                                            </div>
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">Weekly</div>
                                                <div class="amount">₹ @convert($dsp_week_order->weekAmount)</div>
                                                {{-- <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%</div> --}}
                                            </div>
                                            <div class="analytic-data analytic-au-data">
                                                <div class="title">Daily</div>
                                                <div class="amount">₹ @convert($dsp_today_order->todayAmount)</div>
                                                {{-- <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%</div> --}}
                                            </div>
                                        </div>
                                        <div class="analytic-au-ck">
                                            <canvas class="analytics-au-chart" id="analyticAuData"></canvas>
                                        </div>
                                        <div class="chart-label-group">
                                            <div class="chart-label">01 Jan, 2020</div>
                                            <div class="chart-label">30 Jan, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        
                        <div class="col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Buyer</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                        </div>
                        <div class="col-lg-12 col-xxl-12">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group pb-3 g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Buyers</h6>
                                        </div>
                                        {{-- <div class="card-tools shrink-0 d-none d-sm-block">
                                            <ul class="nav nav-switch-s2 nav-tabs bg-white">
                                                <li class="nav-item"><a href="#" class="nav-link">7 D</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link active">1 M</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link">1 Yr</a></li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                    <div class="analytic-ov ">
                                        <div class="analytic-data-group analytic-ov-group g-3">
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Sales</div>
                                                <div class="amount">₹ @convert($buyerOrders->totalAmount)</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Avg. Order/Buyer</div>
                                                <div class="amount">₹ @convert($buyerOrders->averageBuyerOrder)</div>
                                            </div>
                                            <div class="analytic-data analytic-ov-data">
                                                <div class="title">Zero Billing</div>
                                                <div class="amount">{{ $buyerOrders->zeroBillingBuyer }}</div>
                                            </div>
                                        </div>
                                        <div class="analytic-au-ck">
                                            <canvas class="analytics-au-chart" id="analyticAuData2"></canvas>
                                        </div>
                                        <div class="chart-label-group">
                                            <div class="chart-label">01 Jan, 2020</div>
                                            <div class="chart-label">30 Jan, 2020</div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        
                        <div class="col-lg-6 ">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Orders Overview</h6>
                                            <p>In last 15 days completed and pending orders overview. <a href="#" class="link link-sm">Detailed Stats</a></p>
                                        </div>
                                        <div class="card-tools mt-n1 mr-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                        <li><a href="#"><span>3 Months</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-title-group -->
                                    <div class="nk-order-ovwg">
                                        <div class="row g-4 align-end">
                                            <div class="col-xxl-8">
                                                <div class="nk-order-ovwg-ck">
                                                    <canvas class="order-overview-chart" id="orderOverview"></canvas>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-xxl-4">
                                                <div class="row g-4">
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data buy">
                                                            <div class="amount">12,954.63 <small class="currenct currency-usd">INR</small></div>
                                                            <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">INR</span></strong></div>
                                                            <div class="title"><em class="icon ni ni-arrow-down-left"></em> Completed Orders</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data sell">
                                                            <div class="amount text-danger">12,954.63 <small class="currenct currency-usd">INR</small></div>
                                                            <div class="info">Last month <strong>39,485 <span class="currenct currency-usd">INR</span></strong></div>
                                                            <div class="title "><em class="icon ni ni-arrow-up-left"></em> Pending Orders</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div>
                                    </div><!-- .nk-order-ovwg -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-md-6 col-lg-6 col-xxl-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-end g-2">
                                        <div class="card-title card-title-sm">
                                            <h6 class="title">Orders by Brands</h6>
                                            <p>Last 30 Days Orders</p>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                        </div>
                                    </div>
                                    <div class="analytic-au">
                                        <div class="analytic-au-ck">
                                            <canvas class="bar-chart" id="barChartStacked"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card -->
                        </div><!-- .col -->
                        
                        
                        
                        
                        <div class="col-xxl-12 col-md-12">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title page-title">Visit Insights</h5>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xxl-6">
                                    <div class="card card-bordered h-100">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start pb-3 g-2">
                                                <div class="card-title card-title-sm">
                                                    <h6 class="title">Monthly Visits</h6>
                                                </div>
                                            </div>
                                            <div class="analytic-au">
                                                <div class="analytic-data-group analytic-au-group g-3">
                                                    <div class="analytic-data analytic-au-data">
                                                        <div class="title">This Month</div>
                                                        <div class="amount">{{ $monthvisits->totalVisits }}</div>
                                                    </div>
                                                    <div class="analytic-data analytic-au-data">
                                                        <div class="title">This Week</div>
                                                        <div class="amount">{{ $weekvisits }}</div>
                                                    </div>
                                                    <div class="analytic-data analytic-au-data">
                                                        <div class="title">Today</div>
                                                        <div class="amount">{{ $todayvisits }}</div>
                                                    </div>
                                                </div>
                                                <div class="analytic-au-ck">
                                                    <canvas class="analytics-au-chart" id="analyticAuDatas"></canvas>
                                                </div>
                                                <div class="chart-label-group">
                                                    <div class="chart-label">01 Jan, 2020</div>
                                                    <div class="chart-label">30 Jan, 2020</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Tab End -->
    
    <?php /*
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-4 col-md-6">
                <div class="card is-dark h-100">
                    <div class="nk-ecwg nk-ecwg1">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Sales <span>/ Orders</span></h6>
                                </div>
                                <div class="card-tools">
                                    <a href="#" class="link">View Report</a>
                                </div>
                            </div>
                            <div class="data">
                                <div class="amount">₹{{number_format($orders->totalSales,2)}} <span>/ 5</span></div>
                                <div class="info"><strong>₹{{number_format($last_orders->totalSales,2)}} / 5</strong> in last month</div>
                            </div>
                            <div class="data">
                                
                                @php
                                    $arrowType = 'up';
                                    $percentChange = 0;
                                    if($last_orders->totalSales > 0 && $last_orders->totalSales = 0){
                                        $percentChange = (1 - $last_orders->totalSales / $orders->totalSales) * 100;
                                        $percentChange = number_format($percentChange,2);


                                        if($last_orders->totalSales > $orders->totalSales){
                                            $arrowType = 'down';
                                        }
                                    }

                                @endphp 

                                <h6 class="sub-title">This week so far</h6>
                                <div class="data-group">
                                    <div class="amount">₹{{number_format($week->totalSales,2)}} <span>/ 5</span></div>
                                    <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-{{ $arrowType }}"></em>{{ $percentChange }}%</span><br><span>vs. last week</span></div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg1-ck">
                            <canvas class="ecommerce-line-chart-s1" id="totalSales"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-4 col-md-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg2">
                        <div class="card-inner">
                            <div class="card-title-group mt-n1">
                                <div class="card-title">
                                    <h6 class="title">Average order</h6>
                                </div>
                                <div class="card-tools mr-n1">
                                    {{-- <div class="dropdown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                <li><a href="#"><span>30 Days</span></a></li>
                                                <li><a href="#"><span>3 Months</span></a></li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount">₹{{number_format($orders->averageOrder,2)}}</div>

                                    @php

                                        $arrowType = 'up';
                                        $percentChange = 0;
                                        if($last_orders->averageOrder = 0 && $last_orders->averageOrder = 0){
                                            $percentChange = (1 - $last_orders->averageOrder / $orders->averageOrder) * 100;
                                            $percentChange = number_format($percentChange,2);


                                            if($last_orders->averageOrder > $orders->averageOrder){
                                                $arrowType = 'down';
                                            }
                                        }

                                    @endphp

                                    <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-{{ $arrowType }}"></em>{{ $percentChange }}%</span><br><span>vs. last week</span></div>
                                </div>
                            </div>
                            <h6 class="sub-title">Orders over time</h6>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg2-ck">
                            <canvas class="ecommerce-bar-chart-s1" id="averargeOrder"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-4">
                <div class="row g-gs">
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Orders</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $orders->totalOrders }}</div>
                                            {{-- <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div> --}}
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="ecommerce-line-chart-s1" id="totalOrders"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-xxl-12 col-md-6">
                        <div class="card">
                            <div class="nk-ecwg nk-ecwg3">
                                <div class="card-inner pb-0">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Customers</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="data-group">
                                            <div class="amount">{{ $retailers }}</div>
                                            {{-- <div class="info text-right"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last week</span></div> --}}
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="nk-ecwg3-ck">
                                    <canvas class="ecommerce-line-chart-s1" id="totalCustomers"></canvas>
                                </div>
                            </div><!-- .nk-ecwg -->
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .col -->
            <div class="col-xxl-8">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Orders</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Order No.</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col text-right"><span>Action</span></div>
                        </div>
                        
                        @forelse ($recentOrders as $order)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    @php
                                        $detailUrl =URL::to('ecommerce/orders/detail/'.$order->order_id);
                                    @endphp

                                    <span class="tb-lead"><a href="{{ $detailUrl }}">#{{ $order->order_number }}</a></span>
                                </div>
                                <div class="nk-tb-col tb-col-sm">
                                    <div class="user-card">

                                        @php

                                            if(!is_null($order->file)){
                                                $file = public_path('uploads/users/') . $order->file;
                                            }

                                            if(!is_null($order->file) && file_exists($file))
                                                $avatar = "<img src=".url('uploads/users/'.$order->file).">";
                                            else
                                                $avatar = "<span>".\Helpers::getAcronym($order->buyerName)."</span>";
                                        @endphp     

                                        <div class="user-avatar sm bg-purple-dim">
                                            <span>{!! $avatar !!}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $order->buyerName }}</span>
                                            <!-- <span>{{ $order->buyerName }}</span> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span class="tb-sub">{{ date(\Config::get('constants.DATE.DATE_FORMAT') , strtotime($order->orderDate)) }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="badge badge-success">{{ ucfirst($order->status) }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span class="tb-sub tb-amount"><span>₹</span>{{ $order->amount }}</span>
                                </div>
                                <div class="nk-tb-col text-right nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li class="nk-tb-action-hidden">
                                            <a href="{{ $detailUrl }}" class='viewItem btn btn-trigger btn-icon' data-toggle='tooltip' data-placement='top' title='View'>
                                                <em class='icon ni ni-eye'></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty
                            <p>No Recent Orders</p>
                        @endforelse
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white">
                        <div class="card-title-group mt-1">
                            <div class="card-title">
                                <h6 class="title">Top 5 Products</h6>
                            </div>
                            <div class="card-tools">
                                {{-- <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">Weekly</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Daily</span></a></li>
                                            <li><a href="#" class="active"><span>Weekly</span></a></li>
                                            <li><a href="#"><span>Monthly</span></a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-inner">
                        <ul class="nk-top-products">
                            @forelse ($products as $product)
                                <li class="item">
                                    <div class="user-avatar md shadow1 mr-2 bg-purple-dim">
                                        <span>
                                            @php

                                                if(!is_null($product->file) && $product->file != ""){
                                                    $file = public_path('uploads/users/') . $product->file;
                                                }

                                                if(!is_null($product->file) && file_exists($file))
                                                    $src = URL::to('/').'/uploads/products/'.$product->organization_id.'/'.$product->file;
                                                else
                                                    $src = "./images/product/a.png";
                                            @endphp
                                            <img src="{{ $src }}" alt="">
                                        </span>
                                    </div>
                                    <div class="info">
                                        <div class="title">{{ $product->item_name }}</div>
                                        <div class="price">₹{{ $product->sale_price }}</div>
                                    </div>
                                    <div class="total">
                                        <h6 class="amount1">₹{{ $product->TotalAmount }}</h6>
                                        <div class="count">{{ $product->TotalQuantity }} Sold</div>
                                    </div>
                                </li>
                            @empty
                                {{-- empty expr --}}
                            @endforelse
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Top 5 Categories</h6>
                            </div>
                            <div class="card-tools">
                                {{-- <div class="dropdown">
                                    <a href="#" class="dropdown-toggle link link-light link-sm dropdown-indicator" data-toggle="dropdown">Weekly</a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Daily</span></a></li>
                                            <li><a href="#" class="active"><span>Weekly</span></a></li>
                                            <li><a href="#"><span>Monthly</span></a></li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <ul class="nk-top-products">

                            @forelse ($topCategories as $category)
                                <li class="item">
                                    <div class="user-avatar md shadow1 mr-2 bg-purple-dim">
                                        <span>
                                            @php
                                            if(!is_null($category->file) && $category->file != ""){
                                                $file = public_path('uploads/users/') . $category->file;
                                            }

                                            if(!is_null($category->file) && file_exists($file))
                                                $src = URL::to('/').'/uploads/category/'.$category->file;
                                            else
                                                $src = "./images/product/a.png";
                                            @endphp
                                            <img src="{{ $src }}" alt="">
                                        </span>
                                    </div>
                                    <div class="info">
                                        <div class="title">{{ $category->name }}</div>
                                    </div>
                                    <div class="total">
                                        <h6 class="amount1">₹{{ $category->TotalAmount }}</h6>
                                        <div class="count">{{ $category->TotalQuantity }} Products  Sold</div>
                                    </div>
                                </li>
                            @empty
                                {{-- empty expr --}}
                            @endforelse
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            <div class="col-xxl-8 col-md-8">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Store Statistics</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Orders</div>
                                    <div class="count">{{ $statistics['orders'] }}</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Customers</div>
                                    <div class="count">{{ $statistics['customers'] }}</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Products</div>
                                    <div class="count">{{ $statistics['products'] }}</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Categories</div>
                                    <div class="count">{{ $statistics['categories'] }}</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div><!-- .col -->
            {{-- <div class="col-xxl-6 col-lg-6">
                <div class="card h-100">
                    <div class="nk-ecwg nk-ecwg5">
                        <div class="card-inner">
                            <div class="card-title-group align-start pb-3 g-2">
                                <div class="card-title">
                                    <h6 class="title">Orders</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                </div>
                            </div>
                            <div class="data-group">
                                <div class="data">
                                    <div class="title">This Month</div>
                                    <div class="amount amount-sm">1075</div>
                                </div>
                                <div class="data">
                                    <div class="title">This Week</div>
                                    <div class="amount amount-sm">320</div>
                                </div>
                                <div class="data">
                                    <div class="title">Today</div>
                                    <div class="amount amount-sm">40</div>
                                </div>
                            </div>
                            <div class="card-title-group align-start pb-3 g-2">
                                <div class="card-title">
                                    <h6 class="title">Orders Total Amount</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help" data-toggle="tooltip" data-placement="left" title="Users of this month"></em>
                                </div>
                            </div>
                            <div class="data-group">
                                <div class="data">
                                    <div class="title">This Month</div>
                                    <div class="amount amount-sm"><em class="icon ni ni-sign-inr"></em> 9.28K</div>
                                </div>
                                <div class="data">
                                    <div class="title">This Week</div>
                                    <div class="amount amount-sm"><em class="icon ni ni-sign-inr"></em> 2.69K</div>
                                </div>
                                <div class="data">
                                    <div class="title">Today</div>
                                    <div class="amount amount-sm"><em class="icon ni ni-sign-inr"></em> 0.94K</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div> --}}
        </div><!-- .row -->
    </div><!-- .nk-block -->
    */?>
@endsection
@push('footerScripts')
<script src="{{url('js/APIDataTable.js')}}"></script>
{{-- <script src="{{url('js/chart-analytics.js')}}"></script> --}}
<script src="{{url('js/jqvmap.js')}}"></script>
<script src="{{url('js/example-chart.js')}}"></script>
<script src="{{url('js/gd-default.js')}}"></script>
<script src="{{url('js/chart-ecommerce.js')}}"></script>
@endpush