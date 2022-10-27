@extends('public_panel.layout.master')
@section('content')



    <!-- Hero Section Start -->
    <section class="hero-wrap style2">
        <img src="{{asset('public_assets/img/hero/hero-shape-3.png')}}" alt="Image" class="hero-shape-one bounce">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6">
                    <div class="hero-content" data-speed="0.10" data-revert="true">
                        <h1 data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">Leading Patient Engagement Platform For Clinics</h1>
                        <p data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">Ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from making it over years around the world.</p>
                        <div class="hero-btn" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">
                            <a href="about.html" class="btn style1">Find Out More</a>
                            <a class="play-video" data-fancybox="" href="https://www.youtube.com/watch?v=UNSSuTSQI9I">
                                        <span class="video-icon">
                                            <i class="ri-play-fill"></i>
                                        </span>
                                <span> Watch Video</span>
                            </a>
                        </div>
                        <div class="counter-card-wrap" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="500">
                            <div class="counter-card style1">
                                        <span class="counter-icon">
                                            <i class="flaticon-emergency-kit"></i>
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
                                            <i class="flaticon-headache"></i>
                                        </span>
                                <div class="counter-text">
                                    <h2 class="counter-num">
                                        <span class="odometer" data-count="99"></span>
                                        <span class="target">%</span>
                                    </h2>
                                    <p>Patients Satisfied</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-appointment" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                        <img src="{{asset('public_assets/img/hero/hero-shape-4.png')}}" alt="Image" class="hero-shape-two rotate">
                        <div class="hero-appointment-img bg-f" ></div>
                        <div class="hero-appointment-form">
                            <div class="row fg-opt-wrap">
                                <div class="col-sm-5">
                                    <div class="fg-opt">
                                        <span>Date</span>
                                        <p>13 Jul, 20222</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="fg-opt">
                                        <span>Time</span>
                                        <p>9:30 PM</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="fg-opt">
                                        <button type="button" class="btn style1">Edit Time</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row  fg-opt-wrap">
                                <div class="col-sm-5">
                                    <div class="fg-opt">
                                        <span>Doctor</span>
                                        <p>Dr. Kate Winslate</p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="fg-opt">
                                        <span>Branch</span>
                                        <p>Radiology</p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="fg-opt">
                                        <button type="button" class="btn style2">Book Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-doctor" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                        <div class="about-doctor-box">
                            <div class="doctor-img">
                                <img src="{{asset('public_assets/img/about/doctor-1.jpg')}}" alt="Image">
                            </div>
                            <div class="doctor-info">
                                <h5>Dr. Kate Winslet</h5>
                                <span>Radiology</span>
                            </div>
                            <button type="button" class="btn style1">Select</button>
                        </div>
                        <div class="hero-doctor-bg bg-f"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Promo Section Start -->
    <div class="promo-wrap style2 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-admision-form"></i>
                        </div>
                        <div class="promo-info">
                            <h3>Contact Our Doctor</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="service-one.html" class="link style2">View All Services <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-aid-man"></i>
                        </div>
                        <div class="promo-info">
                            <h3>Need Family Health</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="appointment.html" class="link style2">Book Appointment <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="promo-info">
                            <h3>24 Hours Service</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="register.html" class="link style2">Provide Registration<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta-wrap style2 pt-75">
                <div class="row gx-5 align-items-center">
                    <div class="col-xl-8 col-lg-7">
                        <div class="cta-content">
                            <div class="cta-logo">
                                <img src="{{asset('public_assets/img/cta-icon-2.png')}}" alt="Image">
                            </div>
                            <div class="content-title style2">
                                <h2>Don't Hesitate To Contact us</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto inventore voluptatem possimus quibusdam veritatis. Accusamus ipsum saepe quas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="cta-btn">
                            <a href="appointment.html" class="btn style2">Make Appointment</a>
                            <a href="contact.html" class="btn style6">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Promo Section End -->

    <!-- About Section Start -->
    {{-- <section class="about-wrap style2 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="section-title style1 text-center mb-40">
                        <span>About Us</span>
                        <h2>Our Best Services &amp; Poplular Treatment Here</h2>
                    </div>
                </div>
            </div>
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                    <div class="about-img-wrap">
                        <img src="{{asset('public_assets/img/about/about-img-4.jpg')}}" alt="Image" class="about-img-one">
                        <img src="{{asset('public_assets/img/about/about-img-5.jpg')}}" alt="Image" class="about-img-two">
                        <div class="about-promo-box">
                            <span class="promo-icon"><i class="flaticon-medical-operation"></i></span>
                            <h2>700+ <span>Labratory Experts</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <div class="about-content">
                        <div class="content-title style1">
                            <p>There are many variations of passages of Lorem Ipsum amets avoilble but majority have suffered alteration in some form, by injected humour or randomise words which don't sure amet consec tetur adicing.</p>
                        </div>
                        <div class="feature-item-wrap">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Mental health Solutions</h3>
                                    <p>Vestibulum ac diam sit amet quam vehicula elemen tum sed sit amet dui praesent sapien pellen tesque injected humour.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Rapid Patient Improvement</h3>
                                    <p>Vestibulum ac diam sit amet quam vehicula elemen tum sed sit amet dui praesent sapien pellen tesque injected humour.</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="ri-check-line"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>World Class Treatment</h3>
                                    <p>Vestibulum ac diam sit amet quam vehicula elemen tum sed sit amet dui praesent sapien pellen tesque injected humour.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- About Section End -->

    <!-- Service Section Start -->
    <section class="service-wrap style2 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title style2 text-center mb-40">
                        <span>Our Services</span>
                        <h2>Think Hard &amp; Focus On The Patient's Well-Being</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="d-flex justify-content-end">
                        <div class="mb-3 w-25">
                            <input type="text" class="form-control" id="search-hospital" placeholder="Search ..." name="search" value="{{old('search')}}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div id="get-hospitals">
                        <div class="row">
                            @foreach ($organizations as $organization )
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="service-card style1 h-100">
                                        <div class="service-img">
                                            <img src="{{asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                            <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                        </div>
                                        <div class="service-info">
                                            <h2><a href="">{{strtoupper($organization->name)}}</a></h2>
                                            <h3><a href="">Best Department : {{strtoupper($organization->department[0]->name)}}</a></h3>
                                            <a href="{{route('departments.of.hospital',$organization->id)}}" class="link style2">Explore More Departments</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {!! $organizations->render() !!}
                            </div>
                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Partner Area Start -->
    {{-- <div class="container  pb-100">
        <div class="partner-slider-one owl-carousel">
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-7.png')}}" alt="Image">
            </div>
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-8.png')}}" alt="Image">
            </div>
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-9.png')}}" alt="Image">
            </div>
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-10.png')}}" alt="Image">
            </div>
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-11.png')}}" alt="Image">
            </div>
            <div class="partner-item">
                <img src="{{asset('public_assets/img/partner/partner-12.png')}}" alt="Image">
            </div>
        </div>
    </div> --}}
    <!-- Partner Area End -->

    <!-- Testimonial Section Start -->
    {{-- <section class="testimonial-wrap style2 ptb-100 bg-athens">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2  col-md-10 offset-md-1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="section-title style1 text-center mb-40">
                        <span>Testimonial</span>
                        <h2>Our Great Psychitrist Services Provided For You</h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider-two owl-carousel">
                <div class="testimonial-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                    <div class="client-info-area">
                        <div class="client-info-wrap">
                            <div class="client-img">
                                <img src="{{asset('public_assets/img/testimonials/client-1.jpg')}}" alt="Image">
                            </div>
                            <div class="client-info">
                                <h3>Jim Morison</h3>
                                <span>Director, BAT</span>
                            </div>
                        </div>
                        <div class="quote-icon">
                            <i class="flaticon-straight-quotes"></i>
                        </div>
                    </div>
                    <ul class="ratings list-style">
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                    </ul>
                    <p class="client-quote">Lorem ipsum dolor sit amet adip selection repellat tetur delni vel quam aliq earu expel dolor eme fugiat enim amet sit dolor.</p>
                </div>
                <div class="testimonial-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="300">
                    <div class="client-info-area">
                        <div class="client-info-wrap">
                            <div class="client-img">
                                <img src="{{asset('public_assets/img/testimonials/client-2.jpg')}}" alt="Image">
                            </div>
                            <div class="client-info">
                                <h3>Alex Cruis</h3>
                                <span>CEO, IBAC</span>
                            </div>
                        </div>
                        <div class="quote-icon">
                            <i class="flaticon-straight-quotes"></i>
                        </div>
                    </div>
                    <ul class="ratings list-style">
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                    </ul>
                    <p class="client-quote">Lorem ipsum dolor sit amet adip selection repellat tetur delni vel quam aliq earu expel dolor eme fugiat enim amet sit dolor.</p>
                </div>
                <div class="testimonial-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="400">
                    <div class="client-info-area">
                        <div class="client-info-wrap">
                            <div class="client-img">
                                <img src="{{asset('public_assets/img/testimonials/client-3.jpg')}}" alt="Image">
                            </div>
                            <div class="client-info">
                                <h3>Tom Haris</h3>
                                <span>Engineer, Olleo</span>
                            </div>
                        </div>
                        <div class="quote-icon">
                            <i class="flaticon-straight-quotes"></i>
                        </div>
                    </div>
                    <ul class="ratings list-style">
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                    </ul>
                    <p class="client-quote">Lorem ipsum dolor sit amet adip selection repellat tetur delni vel quam aliq earu expel dolor eme fugiat enim amet sit dolor.</p>
                </div>
                <div class="testimonial-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="500">
                    <div class="client-info-area">
                        <div class="client-info-wrap">
                            <div class="client-img">
                                <img src="{{asset('public_assets/img/testimonials/client-4.jpg')}}" alt="Image">
                            </div>
                            <div class="client-info">
                                <h3>Harry Jackson</h3>
                                <span>Enterpreneur</span>
                            </div>
                        </div>
                        <div class="quote-icon">
                            <i class="flaticon-straight-quotes"></i>
                        </div>
                    </div>
                    <ul class="ratings list-style">
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                    </ul>
                    <p class="client-quote">Lorem ipsum dolor sit amet adip selection repellat tetur delni vel quam aliq earu expel dolor eme fugiat enim amet sit dolor.</p>
                </div>
                <div class="testimonial-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="600">
                    <div class="client-info-area">
                        <div class="client-info-wrap">
                            <div class="client-img">
                                <img src="{{asset('public_assets/img/testimonials/client-5.jpg')}}" alt="Image">
                            </div>
                            <div class="client-info">
                                <h3>Chris Haris</h3>
                                <span>MD, ITec</span>
                            </div>
                        </div>
                        <div class="quote-icon">
                            <i class="flaticon-straight-quotes"></i>
                        </div>
                    </div>
                    <ul class="ratings list-style">
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                        <li><i class="ri-star-fill"></i></li>
                    </ul>
                    <p class="client-quote">Lorem ipsum dolor sit amet adip selection repellat tetur delni vel quam aliq earu expel dolor eme fugiat enim amet sit dolor.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8">
                    <p class="mb-0 md-center">Are you impressed?Do you want to take our service here? <a href="appointment.html" class="link style1">Book An Appointment</a></p>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Testimonial Section End -->

    <!-- Appointment Section Start -->
    {{-- <section class="appointment-wrap style2 bg-blue pb-100">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6" >
                    <div class="appointment-content pt-100">
                        <div class="content-title style2">
                            <span>Best Solutions</span>
                            <h2>Awesome Smart Health Can Make Your Life Easier</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iste cupiditate sit debitis, aut, perferendis praesentium alias, asperiores similique veniam vitae veritatis.</p>
                        </div>
                        <ul class="content-feature-list list-style">
                            <li><i class="ri-checkbox-circle-line"></i>Top Professional Team</li>
                            <li><i class="ri-checkbox-circle-line"></i>World Class Dental Services</li>
                            <li><i class="ri-checkbox-circle-line"></i>Discount On Treatment Fees</li>
                            <li><i class="ri-checkbox-circle-line"></i>Multi-Functional Hospital</li>
                            <li><i class="ri-checkbox-circle-line"></i>20+ Years Of Experience</li>
                            <li><i class="ri-checkbox-circle-line"></i>Top Professional Specialist</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="promo-bg bg-f">
                        <a class="play-now" data-fancybox="" href="https://www.youtube.com/watch?v=UNSSuTSQI9I">
                            <i class="ri-play-fill"></i>
                            <span class="ripple"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Appointment Section End -->

    <!-- Why Choose Us Section Start -->
    {{-- <section class="wh-wrap style2 pt-100">
        <div class="container">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                    <div class="wh-img-wrap">
                        <form action="#" class="appointment-form">
                            <h2>Book An Appointment</h2>
                            <div class="form-group">
                                <input type="text" placeholder="Full name">
                            </div>
                            <div class="form-group">
                                <input type="number" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <select name="select_doctor" id="select_doctor">
                                    <option value="0" data-display="Select Doctor">Select Doctor</option>
                                    <option value="1" >Dr. Novlel Josef</option>
                                    <option value="2" >Dr. Fredrick Henry</option>
                                    <option value="3" >Dr. Steave Mark</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="date">
                            </div>
                            <button type="submit" class="btn style2">Book Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <div class="wh-content">
                        <div class="content-title style1">
                            <span>Why Choose us</span>
                            <h2>Protect Your Health With Our Health Package</h2>
                            <p>There are many variations of passages of Lorem Ipsum amets avoilble but majority have suffered alteration in some form, by injected humour or randomise words which don't sure amet consec tetur adicing.</p>
                        </div>
                        <div class="feature-item-wrap">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="flaticon-pulse"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Good People Work</h3>
                                    <p>Vestibulum ac diam sit amet quam vehicula elemen tum sed sit amet dui praesent sapien pellen tesque .</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="flaticon-pills"></i>
                                </div>
                                <div class="feature-text">
                                    <h3>Live Healthy Life</h3>
                                    <p>Vestibulum ac diam sit amet quam vehicula elemen tum sed sit amet dui praesent sapien pellen tesque.</p>
                                </div>
                            </div>
                        </div>
                        <a href="about.html" class="btn style7">Get More info</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Why Choose Us Section End -->

    <!-- Portfolio Section Start -->
    {{-- <section class="portfolio-wrap ptb-100">
        <div class="container">
            <div class="section-title style1 text-center mb-40">
                <span>Our Portfolio</span>
                <h2>All The Great Project That We've Done</h2>
            </div>

        </div>
        <div class="portfolio-slider-two owl-carousel">
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <img src="{{asset('public_assets/img/portfolio/portfolio-7.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Surgery</a>
                    <h3><a href="portfolio-details.html">Neuro Surgery</a></h3>
                </div>
            </div>
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="300">
                <img src="{{asset('public_assets/img/portfolio/portfolio-8.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Health</a>
                    <h3><a href="portfolio-details.html">Child Care</a></h3>
                </div>
            </div>
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="400">
                <img src="{{asset('public_assets/img/portfolio/portfolio-1.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Cardiology</a>
                    <h3><a href="portfolio-details.html">Cardio Surgery</a></h3>
                </div>
            </div>
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="500">
                <img src="{{asset('public_assets/img/portfolio/portfolio-2.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Eye Care</a>
                    <h3><a href="portfolio-details.html">Retina Checkup</a></h3>
                </div>
            </div>
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="600">
                <img src="{{asset('public_assets/img/portfolio/portfolio-4.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Dental</a>
                    <h3><a href="portfolio-details.html">Root Canal</a></h3>
                </div>
            </div>
            <div class="portfolio-card style2" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="700">
                <img src="{{asset('public_assets/img/portfolio/portfolio-6.jpg')}}" alt="Image">
                <div class="portfolio-info">
                    <a href="portfolio-category.html" class="portfolio-cat">Family</a>
                    <h3><a href="portfolio-details.html">Adult Health</a></h3>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Portfolio Section End -->

    <!-- Team Section Start -->
    {{-- <section class="team-wrap ptb-100 bg-chathamas">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2  col-md-10 offset-md-1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="section-title style2 text-center mb-40">
                        <span>Our Team</span>
                        <h2>Meet Our Expert &amp; Experienced Team Members</h2>
                    </div>
                </div>
            </div>
            <div class="team-slider-one owl-carousel">
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <img src="{{asset('public_assets/img/team/team-1.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Fedrick Bonita</h3>
                        <span>Othopedic Surgeon</span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                    <img src="{{asset('public_assets/img/team/team-2.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Ken Moris</h3>
                        <span>Urology Efficient</span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">
                    <img src="{{asset('public_assets/img/team/team-3.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Luiz Frank</h3>
                        <span>Neurosurgery Efficient</span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="500">
                    <img src="{{asset('public_assets/img/team/team-4.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Selina Gomez</h3>
                        <span>Surgery Efficient </span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="600">
                    <img src="{{asset('public_assets/img/team/team-5.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Sarai Conn</h3>
                        <span>Senior Dentist</span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="team-card style1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="700">
                    <img src="{{asset('public_assets/img/team/team-6.jpg')}}" alt="Image">
                    <div class="team-info">
                        <a href="mailto:fedrick@teli.com" class="team-mail"><i class="ri-mail-send-line"></i></a>
                        <h3>Dr. Maureen Klein</h3>
                        <span>Othopedic Surgeon</span>
                        <ul class="social-profile style2 list-style">
                            <li>
                                <a target="_blank" href="https://facebook.com">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://instagram.com">
                                    <i class="ri-instagram-line"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://linkedin.com">
                                    <i class="ri-linkedin-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Team Section End -->

    <!-- Blog Section Start -->
    {{-- <section class="blog-wrap pt-100 pb-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3  col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title style1 text-center mb-40">
                        <span>Our Blog</span>
                        <h2>Our Latest &amp; Most Popular Tips &amp; Tricks For You</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-5.jpg')}}" alt="Image">
                            <a href="posts-by-date.html" class="blog-date"><span>22</span> Jun</a>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-metainfo  list-style">
                                <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                <li><i class="ri-wechat-line"></i>No Comment</li>
                            </ul>
                            <h3><a href="blog-details-right-sidebar.html">Telehealth Services Are Ready To Help Your Family </a></h3>
                            <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                            <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="300">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-6.jpg')}}" alt="Image">
                            <a href="posts-by-date.html" class="blog-date"><span>17</span>Jun</a>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-metainfo  list-style">
                                <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                <li><i class="ri-wechat-line"></i>No Comment</li>
                            </ul>
                            <h3><a href="blog-details-right-sidebar.html">10 Tips To Lead A Healthy And Happy Life</a></h3>
                            <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                            <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400">
                    <div class="blog-card style2">
                        <div class="blog-img">
                            <img src="{{asset('public_assets/img/blog/blog-4.jpg')}}" alt="Image">
                            <a href="posts-by-date.html" class="blog-date"><span>25</span> May</a>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-metainfo  list-style">
                                <li><i class="ri-user-unfollow-line"></i><a href="posts-by-author.html">Admin</a></li>
                                <li><i class="ri-wechat-line"></i>No Comment</li>
                            </ul>
                            <h3><a href="blog-details-right-sidebar.html">The Day I'd Spent At Square Medical Center</a></h3>
                            <p>Lorem Ipsum is simply dummy text the and standard dummy text ever since.</p>
                            <a href="blog-details-right-sidebar.html" class="link style2">Read More<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Blog Section End -->






@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('keyup', '#search-hospital', function(event){
                event.preventDefault();
                var query = $('#search-hospital').val();
                var page = $('#hidden_page').val()
                getData(page, query);
            });
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var page=$(this).attr('href').split('page=')[1];
                var query = $('#search-hospital').val()
                getData(page,query);
            });
            function getData(page,query){
                $.ajax(
                    {
                        url: '/?page=' + page +'&query='+query,
                        type: "get",
                        datatype: "html",
                    }).done(function(data){
                        if (data.length > 0) {
                            $("body").empty().html(data);
                        }
                        else{
                            var html = 'No data Found'
                            $("body").empty().html(html);
                        }
                }).fail(function(jqXHR, ajaxOptions, thrownError){
                    alert('No response from server');
                });
            }
        });


    </script>
@endpush
