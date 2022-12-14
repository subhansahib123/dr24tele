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
                                <a href="tel:2455921125">+91 79-94945555</a>
                            </li>
                            <li>
                                <span><i class="ri-map-pin-fill"></i></span>
                                <p>Mbedcare Pvt Ltd, Kerala, India</p>
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

                                    
                                    <a class="dropdown-item" href="{{route('convertCurrency','usd')}}"  >
                                        <img src="{{ asset('public_assets/img/uk.png') }}" alt="flag">
                                        Usd
                                    </a>
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
                            <a href="{{ route('home.page') }}" class="nav-link ">
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
                        <li class="nav-item"> <a href="{{ route('hospitalsList') }}" class="nav-link">
                                Hospitals

                            </a></li>
                        <li class="nav-item"> <a href="{{route('howItWorks')}}" class="nav-link">
                                How It works

                            </a></li>


                        {{--<li class="nav-item">
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
                            <a href="{{ route('home.departmentSpecializations') }}" class="nav-link">Specializations</a>
                        </li>

                        <li class="nav-item pt-4 gx-0">
                            <div class="input-group rounded">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <span class=" border-0" id="search-addon">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                                    <a href="{{route('patient.login')}}" class="profile-button rounded my-3 py-3 px-3 mx-1">Login</a>
                        </li> --}}
                        @if(auth()->user())
                        <li class="nav-item ">
                            @if(isset(auth()->user()->user_role))
                            @if(auth()->user()->username=='nissi' || auth()->user()->username=='akhil')
                            <a href="{{route('dashboard')}}" class="profile-button rounded  py-2 px-4  "> Profile</a>
                            @elseif(auth()->user()->user_role->role_id=='3')
                            <a href="{{route('hospital.dashboard')}}" class="profile-button rounded  py-2 px-4 ">Profile</a>
                            @elseif(auth()->user()->user_role->role_id=='4')
                            <a href="{{route('doctor.dashboard')}}" class="profile-button rounded  py-2 px-4 ">Profile</a>
                            @endif

                            @elseif(auth()->user()->patient())
                            <a href="{{route('patient.dashboard')}}" class="profile-button rounded  py-2 px-4">Profile</a>
                            @endif
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{route('patient.login')}}" class="profile-button rounded  py-2 px-4">Login</a>
                        </li>
                        @endif



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