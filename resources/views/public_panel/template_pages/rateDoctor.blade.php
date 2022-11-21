<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Link of CSS files -->
    <link rel="stylesheet" href="{{ asset('public_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('public_assets/css/dark-theme.css') }}">
    <title>DrTele | Hospital | Doctors</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>

</head>

<body>

    <!--Preloader starts-->
    {{-- <div class="loader js-preloader">--}}
    {{-- <div class="absCenter">--}}
    {{-- <div class="loaderPill">--}}
    {{-- <div class="loaderPill-anim">--}}
    {{-- <div class="loaderPill-anim-bounce">--}}
    {{-- <div class="loaderPill-anim-flop">--}}
    {{-- <div class="loaderPill-pill"></div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- <div class="loaderPill-floor">--}}
    {{-- <div class="loaderPill-floor-shadow"></div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    {{-- </div>--}}
    <!--Preloader ends-->

    <!-- Theme Switcher Start -->
    <div class="switch-theme-mode">
        <label id="switch" class="switch">
            <input type="checkbox" onchange="toggleTheme()" id="slider">
            <span class="slider round"></span>
        </label>
    </div>
    <!-- Theme Switcher End -->
    <!-- Header Section Start -->
    <header class="header-wrap style2">
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-top-left">
                            <ul class="contact-info list-style">
                                <li>
                                    <span><i class="ri-customer-service-fill"></i></span>
                                    <p>Your Trusted Service Provider</p>
                                </li>
                                <li>
                                    <span><i class="ri-phone-fill"></i></span>
                                    <a href="tel:2455921125">(+245) 592 1125</a>
                                </li>
                                <li>
                                    <span><i class="ri-map-pin-fill"></i></span>
                                    <p>2767 Sunrise Street, NY 1002, USA</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-top-right">

                            <div class="select-lang">
                                <i class="ri-earth-fill"></i>
                                <div class="navbar-option-item navbar-language dropdown language-option">
                                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="lang-name"></span>
                                    </button>
                                    <div class="dropdown-menu language-dropdown-menu">
                                        <a class="dropdown-item" href="#">
                                            <img src="{{ asset('public_assets/img/uk.png') }}" alt="flag">
                                            Eng
                                        </a>
                                        {{-- <a class="dropdown-item" href="#">
                                        <img src="{{asset('public_assets/img/china.png')}}" alt="flag">
                                        简体中文
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <img src="{{asset('public_assets/img/uae.png')}}" alt="flag">
                                            العربيّة
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                            <ul class="social-profile list-style style1">
                                <li>
                                    <a href="https://facebook.com">
                                        <i class="ri-facebook-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com">
                                        <i class="ri-twitter-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://linkedin.com">
                                        <i class="ri-linkedin-fill"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com">
                                        <i class="ri-pinterest-line"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ route('home.page') }}">
                        <img class="logo-light" src="{{ asset('public_assets/img/logo.png') }}" width="120px" alt="logo">
                        <img class="logo-dark" src="{{ asset('public_assets/img/logo.png') }}" width="120px" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse main-menu-wrap" id="navbarSupportedContent">
                        <div class="menu-close d-lg-none">
                            <a href="javascript:void(0)"> <i class="ri-close-line"></i></a>
                        </div>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="{{ route('home.page') }}" class="nav-link active">
                                    Home
                                    {{-- <i class="ri-arrow-down-s-line"></i> --}}
                                </a>

                                <!-- <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link">Home One</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-2.html" class="nav-link active">Home Two</a>
                                </li>
                                <li class="nav-item">
                                    <a href="index-3.html" class="nav-link">Home Three</a>
                                </li>
                            </ul> -->
                            </li>
                            <li class="nav-item"> <a href="{{ route('home.page') }}" class="nav-link">
                                    Hospitals

                                </a></li>
                            <li class="nav-item"> <a href="#" class="nav-link">
                                    How It works

                                </a></li>

                            {{-- <li class="nav-item">
                            <a href="about.html" class="nav-link">
                                About
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('aboutUs')}}" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="portfolio.html" class="nav-link">Our Portfolio</a>
                            </li>
                            <li class="nav-item">
                                <a href="portfolio-details.html" class="nav-link">Single Portfolio</a>
                            </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Services
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="service-one.html" class="nav-link">Service One</a>
                                </li>
                                <li class="nav-item">
                                    <a href="service-two.html" class="nav-link">Service Two</a>
                                </li>
                                <li class="nav-item">
                                    <a href="service-details.html" class="nav-link">Single Service</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pages
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('ourTeam')}}" class="nav-link">Our Team</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('bookAppointment')}}" class="nav-link">Book Appointment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('faq')}}" class="nav-link">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('pricingPlan')}}" class="nav-link">Pricing Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('testimonials')}}" class="nav-link">Testimonials</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        User Pages
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="login.html" class="nav-link">Login</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="register.html" class="nav-link">Register</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="recover-password.html" class="nav-link">Recover Password</a>
                                        </li>
                                    </ul>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('home.allDepartments') }}" class="nav-link">Find Departments</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('home.allDoctors') }}" class="nav-link">Find Doctors</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{route('patient.login')}}" class="nav-link">Login</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact Us</a>
                        </li>

                        </ul>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                Blog
                                <i class="ri-arrow-down-s-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Blog Layout
                                        <i class="ri-arrow-right-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{route('blogGrid')}}" class="nav-link">Blog Grid</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('blogLeftSidebar')}}" class="nav-link">Blog Left Sidebar</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('blogRightSidebar')}}" class="nav-link">Blog Right Sidebar</a>
                        </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Single Blog
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="{{route('noSidebar')}}" class="nav-link">Blog Details No Sidebar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('leftSidebar')}}" class="nav-link">Blog Details Left Sidebar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rightSidebar')}}" class="nav-link">Blog Details Right Sidebar</a>
                                </li>
                            </ul>
                        </li>
                        </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contactUs')}}" class="nav-link">Contact Us</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a href="appointment.html" class="nav-link btn style1">Book Appointment</a>
                        </li>
                        </ul>
                        <div class="other-options md-none">
                            <div class="option-item">
                                <button class="searchbtn"><i class="ri-search-line"></i></button>
                            </div>
                            <div class="option-item">
                                <a href="appointment.html" class="btn style1">Book Appointment</a>
                            </div>
                        </div> --}}
                    </div>
                </nav>
                <div class="search-area">
                    <input type="search" placeholder="Search Here..">
                    <button type="submit"><i class="ri-search-line"></i></button>
                </div>
                <div class="mobile-bar-wrap">
                    <button class="searchbtn d-lg-none"><i class="ri-search-line"></i></button>
                    <div class="mobile-menu d-lg-none">
                        <a href="javascript:void(0)"><i class="ri-menu-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <div class="content-wrapper">

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap bg-f br-1">
            <div class="container">
                <div class="breadcrumb-title">
                    <h2>Feedback Doctor</h2>
                    <ul class="breadcrumb-menu list-style">
                        <li><a href="index.html">Home </a></li>
                        <li>Feedback</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb End -->

        <!-- Account Section start -->
        <section class="Login-wrap pt-100 pb-75">
            <div class="container">
                <div class="row gx-5">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="login-form-wrap">
                            <div class="login-header">
                                @include('admin_panel.frontend.includes.messages')
                                <div class="alert alert-danger" id="error" style="display: none;"></div>

                                <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                            </div>
                            <form method="POST" action="{{route('doctorRated')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                        <input id="ratinginput" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group v1">
                                            <textarea name="feedback" id="message_01" placeholder="Your Messages.." cols="30" rows="7" required="" data-error="Please enter your message"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn style1 w-100 d-block" ]>
                                            Send Feedback
                                        </button>

                                    </div>
                                </div>

                        </div>
                        </form>
                    </div>
                </div>

            </div>
    </div>
    </section>
    <!-- Account Section end -->

    </div>

    </div>
    <!-- Back-to-top button Start -->
    <a href="javascript:void(0)" class="back-to-top bounce"><i class="ri-arrow-up-s-line"></i></a>
    <!-- Back-to-top button End -->

    <!-- Link of JS files -->


    @if (Route::is('conference'))
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src='{{ asset('public_assets/js/AgoraRTCSDK.min.js') }}'></script>
    <script src='{{ asset('public_assets/js/agora-interface.js') }}'></script>
    <script src="{{asset('public_assets/js/custom-Agora.js')}}"></script>

    <script src="{{asset('public_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('public_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('public_assets/js/aos.js')}}"></script>
    <script src="{{asset('public_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public_assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('public_assets/js/fancybox.js')}}"></script>
    <script src="{{asset('public_assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('public_assets/js/tweenmax.min.js')}}"></script>
    <script src="{{asset('public_assets/js/main.js')}}"></script>


    @else
    <script src="{{asset('public_assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public_assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public_assets/js/form-validator.min.js')}}"></script>
    <script src="{{asset('public_assets/js/contact-form-script.js')}}"></script>
    <script src="{{asset('public_assets/js/aos.js')}}"></script>
    <script src="{{asset('public_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public_assets/js/odometer.min.js')}}"></script>
    <script src="{{asset('public_assets/js/fancybox.js')}}"></script>
    <script src="{{asset('public_assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('public_assets/js/tweenmax.min.js')}}"></script>
    <script src="{{asset('public_assets/js/main.js')}}"></script>
    <script src="{{asset('public_assets/js/star-rating.js')}}"></script>
    <script src="{{asset('public_assets/js/rating-picker.js')}}"></script>
    <!-- //rating -->
    <script>
        $("#ratinginput").rating();
    </script>
    </script>


    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var loggedIn = {
            {
                auth() - > check() ? 1 : 0
            }
        };
        var user_id = '';
        @auth
        if (loggedIn == 1) {
            var user_id = {
                {
                    auth() - > user() - > id
                }
            };
        }
        @endauth
    </script>
    <script src="{{asset('public_assets/js/firebase.js')}}"></script>

    @endif

</body>

</html>