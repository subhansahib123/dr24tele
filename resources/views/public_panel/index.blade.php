@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section Start -->
<section class="hero-wrap style3 bg-f">
    <img src="{{asset('public_assets/img/hero/hero-shape-5.png')}}" alt="Image" class="hero-shape-one bounce">
    <img src="{{asset('public_assets/img/hero/hero-shape-6.png')}}" alt="Image" class="hero-shape-two animationFramesTwo">
    <div class="hero-slider-two owl-carousel">
        <div class="hero-slide-item">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-speed="0.10" data-revert="true">
                            <h1>Bringing healthcare to your doorstep</h1>
                            <p>Dr.Tele is an innovative telemedicine program that allows you to get the best care possible without having to travel to see a doctor in person. We save you time and money by eliminating unnecessary trips and waiting rooms. Just by scheduling an appointment with our physicians online. </p>
                            <div class="hero-btn">
                                <a href="#" class="btn style1">Find Out More</a>
                                <a class="play-video" data-fancybox="" href="#">
                                    <span class="video-icon">
                                        <i class="ri-play-fill"></i>
                                    </span>
                                    <span> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-img-wrap bg-f hero-bg-one">
                            <img src="{{asset('public_assets/img/hero/hero-shape-7.png')}}" alt="Image" class="hero-shape-three">
                            <div class="hero-promo-box">
                                <span class="promo-icon"><i class="flaticon-blood-test"></i></span>
                                <h2>700+ <span>Labratory Experts</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slide-item">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-speed="0.10" data-revert="true">
                            <h1>Stay connected with your doctor wherever you are in the world!</h1>
                            <p>We are dedicated to make life easier for people who live outside the major cities. It allows patients to consult a doctor online whenever they need, be it for a visit or even to have a consultation before going out of country. </p>
                            <div class="hero-btn">
                                <a href="#" class="btn style1">Find Out More</a>
                                <a class="play-video" data-fancybox="" href="#">
                                    <span class="video-icon">
                                        <i class="ri-play-fill"></i>
                                    </span>
                                    <span> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-img-wrap bg-f hero-bg-two">
                            <img src="{{asset('public_assets/img/hero/hero-shape-7.png')}}" alt="Image" class="hero-shape-three">
                            <div class="hero-promo-box">
                                <span class="promo-icon"><i class="flaticon-support"></i></span>
                                <h2>24/7 <span>Service Available</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-slide-item">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content" data-speed="0.10" data-revert="true">
                            <h1>Quick-Secure communication between patients and doctors!</h1>
                            <p>Easy and secure way to see a doctor that truly understand every individual patient. DR.TELE has invested in a complete platform to help patients share their health information with doctors, medical services and pharmaceutical companies.</p>
                            <div class="hero-btn">
                                <a href="#" class="btn style1">Find Out More</a>
                                <a class="play-video" data-fancybox="" href="#">
                                    <span class="video-icon">
                                        <i class="ri-play-fill"></i>
                                    </span>
                                    <span> Watch Video</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-img-wrap bg-f hero-bg-three">
                            <img src="{{asset('public_assets/img/hero/hero-shape-7.png')}}" alt="Image" class="hero-shape-three">
                            <div class="hero-promo-box">
                                <span class="promo-icon"><i class="flaticon-user-2"></i></span>
                                <h2>700+ <span>Happy Clients</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- About Section Start -->
<section class="about-wrap style2 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 aos-init" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                <div class="section-title style1 text-center mb-40">
                    <span>About Us</span>
                    <h2>Empowering doctors to be where their patients are</h2>
                </div>
            </div>
        </div>
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6 aos-init" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <div class="about-img-wrap">
                    <img src="{{asset('public_assets/img/about/about-img-06.jpg')}}" alt="Image" class="about-img-one">
                    <img src="{{asset('public_assets/img/about/about-img-07.jpg')}}" alt="Image" class="about-img-two">
                    <div class="about-promo-box">
                        <span class="promo-icon"><i class="flaticon-medical-operation"></i></span>
                        <h2>700+ <span>Labratory Experts</span></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 aos-init" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                <div class="about-content">
                    <div class="content-title style1">
                        <p>As a telemedicine platform provider, we strive to provide our customers with the best service possible.

                            We let you meet patients where they are and delivers the right care in the right place, saving time and money.
                        </p>
                    </div>
                    <div class="feature-item-wrap">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="flaticon-pulse"></i>
                            </div>
                            <div class="feature-text">
                                <h3>Faster and more reliable service to patients</h3>
                                <p>DR.TELE will allow patients to have access to their doctors 24/7, which will allow them to be treated faster and more effectively. </p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="flaticon-pills"></i>
                            </div>
                            <div class="feature-text">
                                <h3>Wide range of solutions from basic consultations to full-blown virtual clinics</h3>
                                <p>Like a traditional doctor's office or hospital setting, We do allow doctors to visit their remote patient, perform their medical exam, diagnose and treat the patient remotely using Dr. Tele’s medical apps.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="flaticon-sterile-mask"></i>
                            </div>
                            <div class="feature-text">
                                <h3>An affordable and easy-to-use platform for healthcare providers and patients alike</h3>
                                <p>Our goal is to help you improve your practice by streamlining processes and providing a reliable, secure way of connecting with patients across the country or around the world. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<!-- Service Section Start -->
<section class="service-wrap style2 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <span>Our Hospitals</span>
                    <h2>Think Hard &amp; Focus On The Patient's Well-Being</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="d-flex justify-content-end">
                    <div class="mb-3 w-25">
                        <input type="text" class="form-control" id="search-hospital" placeholder="Search ..." name="search" value="">
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div id="get-hospitals">
                    <div class="row">
                        @foreach ($organizations as $organization )
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <img src="{{($organization->image)? asset('uploads/organization/'. $organization->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                </div>
                                <div class="service-info">
                                    <h3 class="text-capitalize"><a href="{{route('home.hospital_details',$organization->id)}}">Name: {{$organization->name}}</a></h3>
                                    <h5>Total Departments: {{count($organization->department)}}</h5>
                                    {{-- <h5>Best Department : {{$organization->department[0]->display_name}}</h5>
                                    <a href="{{route('departments.of.hospital',$organization->id)}}" class="link style2">Explore More</a>--}}
                                    <a href="{{route('home.hospital_details',$organization->id)}}" class="link style2">Explore More</a>
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


<!-- Appointment Section Start -->
<section class="appointment-wrap style2 bg-blue pb-100">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6">
                <div class="appointment-content pt-100">
                    <div class="content-title style2">
                        <span>Best Solutions</span>
                        <h2>Awesome Smart Health Can Make Your Life Easier</h2>
                        <p>There's no need to go through your day with a headache, or to stress yourself out over what you're going to eat—and if you're not feeling well, there's no reason why you shouldn't be able to get back on track quickly.</p>
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
                    <a class="play-now" data-fancybox="" href="#">
                        <i class="ri-play-fill"></i>
                        <span class="ripple"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Appointment Section End -->
<!-- Service Section Start -->
<section class="service-wrap style3 ptb-100 bg-athens" >
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
                    <h3><a href="#">Orthopedic Solution</a></h3>
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











@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('keypress', '#search-hospital', function(event) {
            if (event.which == 13) {
                event.preventDefault();
                var query = $('#search-hospital').val();
                var page = $('#hidden_page').val()
                getData(page, query);
            }
        });
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var page = $(this).attr('href').split('page=')[1];
            var query = $('#search-hospital').val();
            getData(page, query);
        });

        function getData(page, query) {
            $.ajax({
                url: '/allHospitals?page=' + page + '&query=' + query,
                type: "get",
                success: function(data) {
                    if (data.length > 0) {
                        $('body').empty().html(data)
                    }
                }
            });
        }
    });
</script>
@endpush