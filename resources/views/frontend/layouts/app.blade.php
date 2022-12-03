<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app" class="site-wrapper">
        <header class="header">
            <div class="top-header">
                <div class="row">
                <div class="logo-1">
                    <a href="/frontend/" title=""><img src="{{url('images/PBD.png')}}" alt="PBD" /></a>
                </div>
                <div class="logo-6"><img src="{{url('images/Group-64421.png')}}" alt="Group-64421" /></div>
                <div class="logo-2"><img src="{{url('images/azadi-75.png')}}" alt="azadi-75" /></div>
                <div class="logo-3"><img src="{{url('images/MP.png')}}" alt="MP" /></div>
                <div class="logo-4"><img src="{{url('images/Hotels-resorts.png')}}" alt="Hotels-resorts" /></div>
                <div class="logo-5"><img src="{{url('images/MP-t.png')}}" alt="MP-t" /></div>
                </div>
            </div>
            <a href="javascript:void(0)" class="mobile-navigation-button"><i class="fas fa-bars"></i></a>
            <div class="navigation">
                <ul>
                    <li class="nav-item">
                        <a href="/frontend/">Accommodation</a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/mahakal-lok-darshan">Mahakal Lok Darshan</a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/user-my-booking">My Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/contact-us">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="/frontend/my-account/customer-logout/">Log Out</a>
                    </li>
                </ul>
            </div>
        </header>

        

        <?php /* ?>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    NRIMeet
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <?php */ ?>
        <!-- <h1 class="text-3xl font-bold underline">
            Hello world!
        </h1> -->
        <main>
            @yield('content')
        </main>
        <footer class="footer">
            <div class="footer-container">
                <p class="footer-nav">
                    <a href="/frontend/about-us">About Us</a> | 
                    <a href="/frontend/privacy-policy">Privacy Policy</a> | 
                    <a href="frontend/booking-policy">Booking Policy</a> | 
                    <a href="/frontend/terms-and-conditions">Terms &amp; Conditions</a> | 
                    <a href="/frontend/refund-cancellation-policy">Refund &amp; Cancellation Policy</a> 
                </p>
                <p class="sohohotel-footer-message">Copyright © 2022, Madhya Pradesh State Tourism Development Corporation Ltd. All Rights Reserved.</p>
                <p class="sohohotel-footer-message" style="width: 100%;">Visitor: 70046</p>
            </div>
        </footer>
    </div>
    <script>
        $(function() {
            // Mobile navigation toggle
            $('.mobile-navigation-button').click(function() {
                $('.navigation').slideToggle("slow");
            });
        });
    </script>
</body>
</html>
