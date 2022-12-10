@php
$userRole = \Session::get('role');
$userPermission = \Session::get('userPermission');
$organization_type = \Session::get('organization_type');
$tallyIntegration = \Session::get('tallyIntegration');
$ecommerceDiscount = \Session::get('ecommerceDiscount');
$planApprovalRequired = \Session::get('planApprovalRequired');
@endphp
<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{url('/dashboard')}}" class="logo-link nk-sidebar-logo">
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
                    <!-- <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt">Dashboard</h6>
                                </li> -->
                    <!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{url('/dashboard')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-growth-fill"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->

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
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/group-bookings')}}" class="nk-menu-link"><span class="nk-menu-text">Group Bookings</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/call-center')}}" class="nk-menu-link"><span class="nk-menu-text">Call Center</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/combined')}}" class="nk-menu-link"><span class="nk-menu-text">Combined</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/bulk-booking-rooms')}}" class="nk-menu-link"><span class="nk-menu-text">Bulk Booking Rooms</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/mahankal-lok-darshan')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-centos"></em></span>
                            <span class="nk-menu-text">Mahakal Lok Darshan</span>
                        </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/contacts')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-contact"></em></span>
                            <span class="nk-menu-text">Contacts</span>
                        </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="{{url('/admin/call-center')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-headphone"></em></span>
                            <span class="nk-menu-text">Call Center</span>
                        </a>
                    </li>

                    @if(isset($userRole) && $userRole != \Config::get('constants.ROLES.SUPERUSER'))
                    @if(isset($userPermission['orders']) || isset($userPermission['invoices']) || isset($userPermission['ledger']) || isset($userPermission['targets']))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-activity-round-fill"></em></span>
                            <span class="nk-menu-text">Business</span>
                        </a>
                        <ul class="nk-menu-sub">
                            @isset($userPermission['orders'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/orders')}}" class="nk-menu-link"><span class="nk-menu-text">Orders</span></a>
                            </li>
                            @endisset

                            @if($tallyIntegration)
                            @isset($userPermission['invoices'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/invoices')}}" class="nk-menu-link"><span class="nk-menu-text">Invoices</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['ledger'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/ledger')}}" class="nk-menu-link"><span class="nk-menu-text">Ledger</span></a>
                            </li>
                            @endisset
                            @endif
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/collection')}}" class="nk-menu-link"><span class="nk-menu-text">Collection</span></a>
                            </li>

                            @isset($userPermission['targets'])
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Targets</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    {{-- <li class="nk-menu-item">
                                        <a href="{{url('/ecommerce/targets')}}" class="nk-menu-link"><span class="nk-menu-text">Overview</span></a>
                                    </li> --}}
                                    <li class="nk-menu-item">
                                        <a href="{{url('/ecommerce/targets/buyer')}}" class="nk-menu-link"><span class="nk-menu-text">Buyer Target</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('/ecommerce/targets/sales-person')}}" class="nk-menu-link"><span class="nk-menu-text">Sales Person Target</span></a>
                                    </li>
                                </ul>
                            </li>
                            @endisset
                        </ul>
                    </li>
                    @endif
                    @if(isset($userPermission['brands']) || isset($userPermission['categories']) || isset($userPermission['models']) || isset($userPermission['segments']) || isset($userPermission['tags']) || isset($userPermission['products']) || isset($userPermission['manufacturer']) || isset($userPermission['discounts']) || isset($userPermission['rating_reviews']) || isset($userPermission['product_assignment']))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></span>
                            <span class="nk-menu-text">Ecommerce</span>
                        </a>
                        <ul class="nk-menu-sub">
                            @isset($userPermission['products'])
                            <li class="nk-menu-item">
                                <a href="{{ url('ecommerce/products') }}" class="nk-menu-link"><span class="nk-menu-text">Products</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['categories'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/categories')}}" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['brands'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/brands')}}" class="nk-menu-link"><span class="nk-menu-text">Brands</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['manufacturer'])
                            <li class="nk-menu-item">
                                <a href="{{ url('ecommerce/manufacturer') }}" class="nk-menu-link"><span class="nk-menu-text">Manufacturer</span></a>
                            </li>
                            @endisset
                            <li class="nk-menu-item">
                                <a href="{{ url('ecommerce/unit') }}" class="nk-menu-link"><span class="nk-menu-text">Units</span></a>
                            </li>
                            
                            @isset($userPermission['models'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/models')}}" class="nk-menu-link"><span class="nk-menu-text">Models</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['segments'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/segments')}}" class="nk-menu-link"><span class="nk-menu-text">Segments</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['tags'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/tags')}}" class="nk-menu-link"><span class="nk-menu-text">Tags</span></a>
                            </li>
                            @endisset


                            @isset($userPermission['attributes'])
                            <!-- <li class="nk-menu-item">
                                            <a href="{{url('/ecommerce/attributes')}}" class="nk-menu-link"><span class="nk-menu-text">Attributes</span></a>
                                        </li> -->
                            @endisset
                            @if($ecommerceDiscount)
                            @isset($userPermission['discounts'])
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Discounts</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Product</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            {{-- <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts')}}" class="nk-menu-link"><span class="nk-menu-text">Overview</span></a>
                                            </li> --}}
                                            <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts/discount-buyer')}}" class="nk-menu-link"><span class="nk-menu-text">Specific Buyer</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts/discount-buyer-category')}}" class="nk-menu-link"><span class="nk-menu-text">Buyer Category</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts/discount-product-category')}}" class="nk-menu-link"><span class="nk-menu-text">Product Category</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Order</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts/order/discount-buyer')}}" class="nk-menu-link"><span class="nk-menu-text">Specific Buyer</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="{{url('ecommerce/discounts/order/discount-buyer-category')}}" class="nk-menu-link"><span class="nk-menu-text">Buyer Category</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endisset
                            @endif


                            @isset($userPermission['rating_reviews'])
                            <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/ratings')}}" class="nk-menu-link"><span class="nk-menu-text">Review & Ratings</span></a>
                            </li>
                            @endisset

                            @isset($userPermission['product_assignment'])
                            {{-- <li class="nk-menu-item">
                                <a href="{{url('/ecommerce/products-assignment')}}" class="nk-menu-link"><span class="nk-menu-text">Product Assignment</span></a>
                            </li> --}}
                            @endisset
                            <!-- <li class="nk-menu-item">
                                            <a href="#" class="nk-menu-link"><span class="nk-menu-text">Coupons</span></a>
                                        </li> -->
                        </ul>
                    </li>
                    @endif
                    @if(isset($userPermission['buyer']) || isset($userPermission['staff']))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">User Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            @isset($userPermission['buyer'])
                            <li class="nk-menu-item">
                                <a href="{{url('/user')}}" class="nk-menu-link"><span class="nk-menu-text">Buyers</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['staff'])
                            <li class="nk-menu-item">
                                <a href="{{url('/user/staff')}}" class="nk-menu-link"><span class="nk-menu-text">Staff</span></a>
                            </li>
                            @endisset


                        </ul>
                    </li>
                    @endif
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-location"></em></span>
                            <span class="nk-menu-text">Visit Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{url('/visit/calendar')}}" class="nk-menu-link"><span class="nk-menu-text">Calendar</span></a>
                            </li>
                            @if($planApprovalRequired)
                            <li class="nk-menu-item">
                                <a href="{{url('/visit/unapproved')}}" class="nk-menu-link"><span class="nk-menu-text">Unapproved</span></a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @if(isset($userPermission['notification_templates']) || isset($userPermission['settings']) || isset($userPermission['roles']) || isset($userPermission['permissions']) || isset($userPermission['mapping']))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-view-group-fill"></em></span>
                            <span class="nk-menu-text">Administration</span>
                        </a>
                        <ul class="nk-menu-sub">

                            @if(isset($organization_type) && $organization_type == 'MULTIPLE')
                            <li class="nk-menu-item">
                                <a href="{{url('administration/organization')}}" class="nk-menu-link"><span class="nk-menu-text">Organization</span></a>
                            </li>
                            @endif
                            @isset($userPermission['settings'])
                            <li class="nk-menu-item">
                                <a href="{{url('administration/settings')}}" class="nk-menu-link"><span class="nk-menu-text">Settings</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['roles'])
                            <li class="nk-menu-item">
                                <a href="{{url('/administration/roles')}}" class="nk-menu-link"><span class="nk-menu-text">Roles</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['permissions'])
                            <li class="nk-menu-item">
                                <a href="{{url('/administration/permissions')}}" class="nk-menu-link"><span class="nk-menu-text">Permissions</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['mapping'])
                            <li class="nk-menu-item">
                                <a href="{{url('/administration/mapping')}}" class="nk-menu-link"><span class="nk-menu-text">Buyer & SP Mapping</span></a>
                            </li>
                            @endisset
                            @isset($userPermission['notification_templates'])
                            <li class="nk-menu-item">
                                <a href="{{url('administration/notification/templates')}}" class="nk-menu-link"><span class="nk-menu-text">Notification Templates</span></a>
                            </li>
                            @endisset
                            <li class="nk-menu-item">
                                <a href="{{url('administration/menu')}}" class="nk-menu-link"><span class="nk-menu-text">Menu</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('administration/labels')}}" class="nk-menu-link"><span class="nk-menu-text">Manage Labels</span></a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    {{-- @if(isset($userPermission['reports'])) --}}
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-list-index-fill"></em></span>
                            <span class="nk-menu-text">Reports</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Sales</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/sales-by-sales-person')}}" class="nk-menu-link"><span class="nk-menu-text">by Sales Person</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/sales-by-buyers')}}" class="nk-menu-link"><span class="nk-menu-text">by Buyers</span></a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/sales-by-product-categories')}}" class="nk-menu-link"><span class="nk-menu-text">by Product Categories</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{url('admin/report/pending-sales-order')}}" class="nk-menu-link"><span class="nk-menu-text">Pending Sales Order</span></a>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Top 10</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/top-buyers')}}" class="nk-menu-link"><span class="nk-menu-text">Buyers</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/top-sales-person')}}" class="nk-menu-link"><span class="nk-menu-text">Sales Person</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/top-10-products')}}" class="nk-menu-link"><span class="nk-menu-text">Products</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/top-10-categories')}}" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Zero Billing</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/zero-billing-sales-person')}}" class="nk-menu-link"><span class="nk-menu-text">Sales Person</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/zero-billing-buyers')}}" class="nk-menu-link"><span class="nk-menu-text">Buyers</span></a>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/zero-billing-items')}}" class="nk-menu-link"><span class="nk-menu-text">Items</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Target Achievement</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/target-achievement-buyers')}}" class="nk-menu-link"><span class="nk-menu-text">Buyers</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/target-achievement-sales-person')}}" class="nk-menu-link"><span class="nk-menu-text">Sales Person</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-text">Visits</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/onfield-visits')}}" class="nk-menu-link"><span class="nk-menu-text">On-Field</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{url('admin/report/offfield-visits')}}" class="nk-menu-link"><span class="nk-menu-text">Off-Field</span></a>
                                    </li>
                                </ul>
                            </li>

                            {{-- <li class="nk-menu-item">
                                            <a href="{{url('admin/report/billing')}}" class="nk-menu-link"><span class="nk-menu-text">Billing</span></a>
                    </li> --}}

                    {{-- <li class="nk-menu-item">
                                            <a href="{{url('admin/report/collection-report')}}" class="nk-menu-link"><span class="nk-menu-text">Collection Report</span></a>
                    </li> --}}

                </ul>
                </li>
                {{-- @endif --}}
                @if(isset($userPermission['banners']) || isset($userPermission['pages']))
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-monitor"></em></span>
                        <span class="nk-menu-text">CMS</span>
                    </a>
                    <ul class="nk-menu-sub">
                        @isset($userPermission['banners'])
                        <li class="nk-menu-item">
                            <a href="{{url('/cms/banners')}}" class="nk-menu-link"><span class="nk-menu-text">Banners</span></a>
                        </li>
                        @endisset
                        @isset($userPermission['pages'])
                        <li class="nk-menu-item">
                            <a href="{{url('/cms/pages')}}" class="nk-menu-link"><span class="nk-menu-text">Pages</span></a>
                        </li>
                        @endisset
                    </ul>
                </li>
                @endif
                @isset($userPermission['broadcast'])
                <li class="nk-menu-item">
                    <a href="{{url('broadcast')}}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-vol"></em></span>
                        <span class="nk-menu-text">Broadcast</span>
                    </a>
                </li>
                @endisset

                <li class="nk-menu-item">
                    <a href="{{url('administration/contactus')}}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-call"></em></span>
                        <span class="nk-menu-text">Contact Us</span>
                    </a>
                </li>


                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-monitor"></em></span>
                        <span class="nk-menu-text">Support</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="https://profitley.freshdesk.com" target="_blank" rel="noopener" class="nk-menu-link"><span class="nk-menu-text">Help Desk</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="https://profitley.freshdesk.com" target="_blank" rel="noopener" class="nk-menu-link"><span class="nk-menu-text">Guide</span></a>
                        </li>
                    </ul>
                </li>


                @endif
                @if(isset($userRole) && $userRole == \Config::get('constants.ROLES.SUPERUSER'))
                <li class="nk-menu-item has-sub">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                        <span class="nk-menu-text">Organization</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="{{url('/saas/organization/')}}" class="nk-menu-link"><span class="nk-menu-text">Manage</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{url('/saas/organization/industries')}}" class="nk-menu-link"><span class="nk-menu-text">Industry Master</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{url('/saas/organization/segments')}}" class="nk-menu-link"><span class="nk-menu-text">Segment Master</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{url('/saas/organization/modules')}}" class="nk-menu-link"><span class="nk-menu-text">Modules</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{url('/saas/organization/settings')}}" class="nk-menu-link"><span class="nk-menu-text">Settings</span></a>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-text">Ecommerce</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{url('/saas/organization/ecommerce/products')}}" class="nk-menu-link"><span class="nk-menu-text">Products</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('/saas/organization/ecommerce/brands')}}" class="nk-menu-link"><span class="nk-menu-text">Brand</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('/saas/organization/ecommerce/categories')}}" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('/saas/organization/ecommerce/manufacturer')}}" class="nk-menu-link"><span class="nk-menu-text">Manufacturer</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{url('/saas/organization/ecommerce/models')}}" class="nk-menu-link"><span class="nk-menu-text">Models</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                </ul>
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>