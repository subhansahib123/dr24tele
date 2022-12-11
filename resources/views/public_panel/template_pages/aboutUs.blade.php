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
                    <li><a href="index.html">Home</a></li>
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
    <div class="counter-wrap pt-100 pb-75  bg-blue">
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
    </div>  
</div>
<!-- Content wrapper end -->



@endsection