<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>17th Pravasi Bharatiya Divas 2023 Accommodation</title>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/dialog.css">
    <script type="text/javascript" src="/js/dialog.js"></script>


    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/date-picker.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="site-wrapper">
        <header class="header">
            <div class="top-header">
                <div class="row">
                    <div class="logo-1">
                        <a href="{{ url('/') }}" title=""><img src="{{ url('images/PBD.png') }}"
                                alt="PBD" /></a>
                    </div>
                    <div class="logo-6"><img src="{{ url('images/Group-64421.png') }}" alt="Group-64421" /></div>
                    <div class="logo-2"><img src="{{ url('images/azadi-75.png') }}" alt="azadi-75" /></div>
                    <div class="logo-3"><img src="{{ url('images/MP.png') }}" alt="MP" /></div>
                    <div class="logo-4"><img src="{{ url('images/Hotels-resorts.png') }}" alt="Hotels-resorts" /></div>
                    <div class="logo-5"><img src="{{ url('images/MP-t.png') }}" alt="MP-t" /></div>
                </div>
            </div>
            <a href="javascript:void(0)" class="mobile-navigation-button"><i class="fas fa-bars"></i></a>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="{{ url('/') }}">Accommodation</a>
                    </li>
                    <li>
                        <a href="{{ url('/mahakal-lok-darshan') }}">Mahakal Lok Darshan</a>
                    </li>
                    <li>
                        <a href="{{ url('/my-booking') }}">My Bookings</a>
                    </li>
                    <li>
                        <a href="{{ url('/contact-us') }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ url('/my-account/customer-logout/') }}">Log Out</a>
                    </li>
                </ul>
            </div>
        </header>

        @guest
            <!-- START: Login Modal -->
            <div class="login-modal-wrap">
                <div class="login-modal-overlay">&nbsp;</div>
                <div class="login-modal">
                    <div class="login-modal-left">
                        <div class="img-div"></div>
                    </div>
                    <div class="login-modal-right">
                        <div class="login-modal-header">
                            <h2 class="login-modal-heading">Login account</h2>
                        </div>
                        {!! NoCaptcha::renderJs() !!}
                        <form method="POST" action="{{ url('post-login') }}" data-validate="parsley" autocomplete="off">
                            @csrf
                            <div class="login-form-item">
                                <div class="input-group">
                                    <div class="input-group-icon">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <input class="form-control" id="username" name="email" type="text"
                                        placeholder="Username/Email" required />
                                </div>
                            </div>
                            <div class="login-form-item">
                                <div class="input-group">
                                    <div class="input-group-icon">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="******************" required />
                                    <i class="fa fa-eye" id="togglePassword"></i>
                                </div>
                            </div>
                            <div class="login-form-item">
                                {!! app('captcha')->display() !!}
                            </div>
                            <div class="login-form-item login-form-button">
                                <button type="submit" class="primary-button">Login</button>
                            </div>
                        </form>
                        <p class="footer-b">
                            Our representatives are <br>available to assist you 24*7

                            <br><br>
                            Contact Us: <a href="tel:+91 731 244 4404" target="_blank">+91 731 244 4404</a><br>
                            WhatsApp Support: <a
                                href="https://api.whatsapp.com/send?phone=+919893908123&amp;text=Welcome%20to%20Pravasi%20Bharatiya%20Divas%202023"
                                target="_blank">+91 9893908123</a>
                            <br><br>

                            Note: Only the registered delegates of PBD can access this website for accommodation.
                            If not registered, please <a href="https://pbdindia.gov.in/registration" target="_blank">click
                                here </a>to get registered for Pravasi Bharatiya Divas.
                        </p>
                    </div>
                </div>
            </div>
            <!-- END: Login Modal -->
        @endguest

        <?php /* ?> ?>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    NRIMeet
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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
                    <a href="{{ url('/about-us') }}">About Us</a> |
                    <a href="{{ url('/privacy-policy') }}">Privacy Policy</a> |
                    <a href="{{ url('/booking-policy') }}">Booking Policy</a> |
                    <a href="{{ url('/terms-and-conditions') }}">Terms &amp; Conditions</a> |
                    <a href="{{ url('/refund-cancellation-policy') }}">Refund &amp; Cancellation Policy</a>
                </p>
                <p class="sohohotel-footer-message">Copyright © 2022, Madhya Pradesh State Tourism Development
                    Corporation Ltd. All Rights Reserved.</p>
                <p class="sohohotel-footer-message" style="width: 100%;">Visitor: 70046</p>
            </div>
        </footer>
    </div>

    <script src="{{ url('js/bundle.js?ver=1.9.0') }}"></script>
    {{-- <script src="{{url('js/scripts.js?ver=1.9.0')}}"></script> --}}
    {{-- <script src="{{url('js/chart-ecommerce.js')}}"></script> --}}
    <script src="{{ url('js/parsley.min.js') }}"></script>
    <script src="{{ url('js/date-picker.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
    @stack('footerScripts')
    <script src="{{ url('js/common.js?t=' . time()) }}"></script>

    <style type="text/css">
        #g-recaptcha-response {
            display: block !important;
            position: absolute;
            margin: -78px 0 0 0 !important;
            width: 302px !important;
            height: 76px !important;
            z-index: -999999;
            opacity: 0;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("form").parsley();
        });

        window.addEventListener('load', () => {
            const $recaptcha = document.querySelector('#g-recaptcha-response');
            if ($recaptcha) {
                $recaptcha.setAttribute('required', 'required');
            }
        })

        $(function() {
            // Mobile navigation toggle
            $('.mobile-navigation-button').click(function() {
                $('.navigation').slideToggle("slow");
            });
        });
    </script>
    <script
        src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js">
    </script>
    <script id="rendered-js">
        function getVals() {
            // Get slider values
            let parent = this.parentNode;
            let slides = parent.getElementsByTagName("input");
            let slide1 = parseFloat(slides[0].value);
            let slide2 = parseFloat(slides[1].value);
            // Neither slider will clip the other, so make sure we determine which is larger
            if (slide1 > slide2) {
                let tmp = slide2;
                slide2 = slide1;
                slide1 = tmp;
            }

            let displayElement = parent.getElementsByClassName("rangeValues")[0];
            displayElement.innerHTML = "₹" + slide1 + " - ₹" + slide2;
        }

        window.onload = function() {
            // Initialize Sliders
            let sliderSections = document.getElementsByClassName("range-slider");
            for (let x = 0; x < sliderSections.length; x++) {
                if (window.CP.shouldStopExecution(0)) break;
                let sliders = sliderSections[x].getElementsByTagName("input");
                for (let y = 0; y < sliders.length; y++) {
                    if (window.CP.shouldStopExecution(1)) break;
                    if (sliders[y].type === "range") {
                        sliders[y].oninput = getVals;
                        // Manually trigger event first time to display values
                        sliders[y].oninput();
                    }
                }
                window.CP.exitedLoop(1);
            }
            window.CP.exitedLoop(0);
        };
        //# sourceURL=pen.js
    </script>
</body>

</html>
