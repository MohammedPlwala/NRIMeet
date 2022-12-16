@php
$userRole = \Session::get('role');
$rolePermissions = \Session::get('rolePermissions');
@endphp
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{url('/admin/dashboard')}}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{url('images/logo-dark.png')}}" srcset="{{url('images/logo-dark.png')}}" alt="logo">
                <img class="logo-dark logo-img" src="{{url('images/logo-dark.png')}}" srcset="{{url('images/logo-dark.png')}}" alt="logo-dark">
                <img class="logo-small logo-img logo-img-small" src="{{url('images/logo-small.png')}}" srcset="{{url('images/logo-small2x.png 2x')}}" alt="logo-small">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{url('/admin/dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    @if(!empty($rolePermissions) && in_array('Hotels', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                            <span class="nk-menu-text">Hotels</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/hotel')}}" class="nk-menu-link"><span class="nk-menu-text">Manage</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/hotel/rooms')}}" class="nk-menu-link"><span class="nk-menu-text">Rooms</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('Bookings', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-calender-date"></em></span>
                            <span class="nk-menu-text">Bookings</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/bookings')}}" class="nk-menu-link"><span class="nk-menu-text">Manage</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/bulk-bookings')}}" class="nk-menu-link"><span class="nk-menu-text">Bulk Booking</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('User Management', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">User Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/user')}}" class="nk-menu-link"><span class="nk-menu-text">Guests</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('/admin/user/staff')}}" class="nk-menu-link"><span class="nk-menu-text">Staff</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('Reports', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-list-index-fill"></em></span>
                            <span class="nk-menu-text">Reports</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/guest')}}" class="nk-menu-link"><span class="nk-menu-text">Guest</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/hotel-master')}}" class="nk-menu-link"><span class="nk-menu-text">Hotel Master</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/inventory')}}" class="nk-menu-link"><span class="nk-menu-text">Inventory</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/payment')}}" class="nk-menu-link"><span class="nk-menu-text">Payment</span></a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/failed-payments')}}" class="nk-menu-link"><span class="nk-menu-text">Failed Payment</span></a>
                            </li>

                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/booking')}}" class="nk-menu-link"><span class="nk-menu-text">Booking</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/booking-status')}}" class="nk-menu-link"><span class="nk-menu-text">Booking Status</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/cancellation')}}" class="nk-menu-link"><span class="nk-menu-text">Cancellation</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/refund')}}" class="nk-menu-link"><span class="nk-menu-text">Refund</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/total-inventory-data')}}" class="nk-menu-link"><span class="nk-menu-text">Total Inventory Data</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/booking-summary')}}" class="nk-menu-link"><span class="nk-menu-text">Booking Summary</span></a>
                            </li>
                            {{-- <li class="nk-menu-item">
                                <a href="{{url('admin/report/group-bookings')}}" class="nk-menu-link"><span class="nk-menu-text">Group Bookings</span></a>
                            </li> --}}
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/call-center')}}" class="nk-menu-link"><span class="nk-menu-text">Call Center</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/combined')}}" class="nk-menu-link"><span class="nk-menu-text">Combined</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/bulk-booking-rooms')}}" class="nk-menu-link"><span class="nk-menu-text">Bulk Booking Rooms</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/pending-confirmation')}}" class="nk-menu-link"><span class="nk-menu-text">Pending Confirmation</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/booking-checkin-status')}}" class="nk-menu-link"><span class="nk-menu-text">Booking Checkin Status</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/booking-checkout-status')}}" class="nk-menu-link"><span class="nk-menu-text">Booking Checkout Status</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('Mahankal Lok Darshan', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/mahankal-lok-darshan')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-centos"></em></span>
                            <span class="nk-menu-text">Mahakal Lok Darshan</span>
                        </a>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('Contacts', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/contacts')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                            <span class="nk-menu-text">Contacts</span>
                        </a>
                    </li>
                    @endif

                    @if(!empty($rolePermissions) && in_array('Call Center', $rolePermissions))
                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/call-center')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-headphone"></em></span>
                            <span class="nk-menu-text">Call Center</span>
                        </a>
                    </li>
                    @endif
                    
                
                </ul>
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>