@extends('public_panel.layout.master')
@section('content')

<!-- Content Wrapper Start -->
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Pricing Plan</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="index.html">Home </a></li>
                    <li>Pricing Plan</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Pricing Section Start -->
    <section class="pricing-wrap pt-100 pb-75">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <div class="pricing-header-left">
                                <h5>Basic Plan</h5>
                                <h2>$79<span>/Month</span></h2>
                            </div>
                            <div class="pricing-header-right">
                                <i class="flaticon-home"></i>
                            </div>
                        </div>
                        <ul class="pricing-features list-style">
                            <li class="checked">New Patient Consultation <i class="ri-check-line"></i></li>
                            <li class="checked">Regular health Checkup<i class="ri-check-line"></i></li>
                            <li class="checked">Ocupational Therapy<i class="ri-check-line"></i></li>
                            <li class="checked">Phusical Therapy<i class="ri-check-line"></i></li>
                            <li class="unchecked">X-rays<i class="ri-close-fill"></i></li>
                            <li class="unchecked">Cancer Treatment<i class="ri-close-fill"></i></li>
                        </ul>
                        <a href="login.html" class="btn style2">Get Started Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <div class="pricing-header-left">
                                <h5>Standard Plan</h5>
                                <h2>$89<span>/Month</span></h2>
                            </div>
                            <div class="pricing-header-right">
                                <i class="flaticon-user-2"></i>
                            </div>
                        </div>
                        <ul class="pricing-features list-style">
                            <li class="checked">New Patient Consultation <i class="ri-check-line"></i></li>
                            <li class="checked">Regular health Checkup<i class="ri-check-line"></i></li>
                            <li class="checked">Ocupational Therapy<i class="ri-check-line"></i></li>
                            <li class="checked">Phusical Therapy<i class="ri-check-line"></i></li>
                            <li class="checked">X-rays<i class="ri-check-line"></i></li>
                            <li class="unchecked">Cancer Treatment<i class="ri-close-fill"></i></li>
                        </ul>
                        <a href="login.html" class="btn style2">Get Started Now</a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <div class="pricing-header-left">
                                <h5>Premium Plan</h5>
                                <h2>$99<span>/Month</span></h2>
                            </div>
                            <div class="pricing-header-right">
                                <i class="flaticon-clipboard"></i>
                            </div>
                        </div>
                        <ul class="pricing-features list-style">
                            <li class="checked">New Patient Consultation <i class="ri-check-line"></i></li>
                            <li class="checked">Regular health Checkup<i class="ri-check-line"></i></li>
                            <li class="checked">Ocupational Therapy<i class="ri-check-line"></i></li>
                            <li class="checked">Phusical Therapy<i class="ri-check-line"></i></li>
                            <li class="checked">X-rays<i class="ri-check-line"></i></li>
                            <li class="checked">Cancer Treatment<i class="ri-check-line"></i></li>
                        </ul>
                        <a href="login.html" class="btn style2">Get Started Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->

</div>
<!-- Content wrapper end -->



@endsection