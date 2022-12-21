@extends('public_panel.layout.master')
@section('content')


<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>About Us</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{route('home.page')}}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Start -->
    <section class="about-wrap style1 ptb-100">
        <div class="container">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6">
                    <div class="about-img-wrap">
                        <img src="{{asset('public_assets/img/Vectors/SpecialistAdvise.jpg')}}" alt="Image" class="about-img-one">
                        <img src="{{asset('public_assets/img/Vectors/PathologyTest.jpg')}}" alt="Image" class="about-img-two">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <div class="content-title style1">
                            <span>About Our Program</span>
                            <h2>Take Care Of Your Health With Our Health Package</h2>
                            <p>There are many variations of passages of Lorem Ipsum amets avoilble but majority have suffered alteration in some form, by injected humour or randomise words which don't sure amet consec tetur adicing.</p>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <ul class="content-feature-list list-style">
                                    <li><i class="ri-checkbox-circle-line"></i>Provide More Potential Health
                                    </li>
                                    <li><i class="ri-checkbox-circle-line"></i>Operational Research Transformation
                                    </li>
                                    <li><i class="ri-checkbox-circle-line"></i>Mental health Solution
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-5">
                                <div class="about-promo-video bg-f">
                                    <a class="play-now" data-fancybox="" href="https://www.youtube.com/watch?v=UNSSuTSQI9I">
                                        <i class="ri-play-fill"></i>
                                        <span class="ripple"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="ceo-msg">
                            <div class="ceo-img">
                                <img src="{{asset('public_assets/img/webImages/download1.jfif')}}" alt="Image">
                            </div>
                            <p>"Think Hard And Focus On The Patient's Well-Being"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Counter Section Start -->
    <!-- <div class="counter-wrap pt-100 pb-75  bg-blue">
        <div class="container">
            <div class="counter-card-wrap style1 pb-75">
                <div class="counter-card style1">
                    <span class="counter-icon">
                        <i class="flaticon-admision-form"></i>
                    </span>
                    <div class="counter-text">
                        <h2 class="counter-num">
                            <span class="odometer" data-count="60"></span>
                            <span class="target">+</span>
                        </h2>
                        <p>Project Completed</p>
                    </div>
                </div>
                <div class="counter-card style1">
                    <span class="counter-icon">
                        <i class="flaticon-doctor"></i>
                    </span>
                    <div class="counter-text">
                        <h2 class="counter-num">
                            <span class="odometer" data-count="99"></span>
                            <span class="target">%</span>
                        </h2>
                        <p>Patients Satisfied</p>
                    </div>
                </div>
                <div class="counter-card style1">
                    <span class="counter-icon">
                        <i class="flaticon-medical-operation"></i>
                    </span>
                    <div class="counter-text">
                        <h2 class="counter-num">
                            <span class="odometer" data-count="700"></span>
                            <span class="target">+</span>
                        </h2>
                        <p>Medical Beds</p>
                    </div>
                </div>
                <div class="counter-card style1">
                    <span class="counter-icon">
                        <i class="flaticon-blood-test"></i>
                    </span>
                    <div class="counter-text">
                        <h2 class="counter-num">
                            <span class="odometer" data-count="70"></span>
                            <span class="target">+</span>
                        </h2>
                        <p>Laboratory Experts</p>
                    </div>
                </div>
            </div>
        </div>
    </div>   -->

    <section class="wh-wrap style3 ptb-100 bg-chathamas">
        <div class="container">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-lg-1 order-md-2 order-2 aos-init aos-animate" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                    <div class="wh-content">
                        <div class="content-title style2">
                            <span>Why Choose us</span>
                            <h2>We Care about your health and guide you the best way. </h2>
                            <p>We guide you to the best way to improve your health and live a healthier life. Our tips and advice are based on years of experience and research, so you can be sure you're getting the best possible advice.</p>
                        </div>
                        <div class="feature-item-wrap">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Mental Health Solution</h3>
                                    <p> There are a number of effective treatments available. The most important thing is to seek help from a qualified professional who can tailor a treatment plan to your specific needs.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Timely Cured from Disease</h3>
                                    <p>No matter what type of disease you have been diagnosed with, it is important to follow your doctor's instructions and get plenty of rest. </p>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn style1">Get More info</a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-md-1 order-1 aos-init aos-animate" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <div class="wh-img-wrap">
                        <div class="wh-bg-3 bg-f"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section Start -->
    <section class="service-wrap style3 ptb-100 bg-athens">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="section-title style1 text-center mb-40">
                        <span>Our Services</span>
                        <h2>Think Hard &amp; Focus On The Patient's Well-Being</h2>
                    </div>
                </div>
            </div>
            <div class="service-slider-one style2 owl-carousel">
                <div class="service-card style3" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <div class="service-img">
                        <img src="{{asset('public_assets/img/Vectors/Orthopediacsolutions.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-traumatology"></i></span>
                    </div>
                    <div class="service-info">
                        <h3><a href="">Orthopedic Solution</a></h3>
                        <p>It is a long established fact that reader will content of page when looks layout.</p>
                        <a href="#" class="link style2">Explore More</a>
                    </div>
                </div>
                <div class="service-card style3" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400">
                    <div class="service-img">
                        <img src="{{asset('public_assets/img/services/PatientOnboarding.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                    </div>
                    <div class="service-info">
                        <h3><a href="#">Patient Onboarding</a></h3>
                        <p>It is a long established fact that reader will content of page when looks layout.</p>
                        <a href="#" class="link style2">Explore More</a>
                    </div>
                </div>
                <div class="service-card style3" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="600">
                    <div class="service-img">
                        <img src="{{asset('public_assets/img/services/SpecialistAdvise.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-nurse"></i></span>
                    </div>
                    <div class="service-info">
                        <h3><a href="#">Specialist Advise</a></h3>
                        <p>It is a long established fact that reader will content of page when looks layout.</p>
                        <a href="#" class="link style2">Explore More</a>
                    </div>
                </div>
                <div class="service-card style3" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="800">
                    <div class="service-img">
                        <img src="{{asset('public_assets/img/Vectors/HeartCheck up.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-health-care"></i></span>
                    </div>
                    <div class="service-info">
                        <h3><a href="#">Heart Checkup</a></h3>
                        <p>It is a long established fact that reader will content of page when looks layout.</p>
                        <a href="#" class="link style2">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->












</div>
<!-- Content wrapper end -->



@endsection