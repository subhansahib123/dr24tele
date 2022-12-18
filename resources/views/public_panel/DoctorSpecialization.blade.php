@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section End -->


<!-- Service Section Start -->
<section class="service-wrap style2 mt-100 pt-100" 
@if(count($doctorSpecializations)>3)
    style="padding-bottom: 110px"
@else 
    style="padding-bottom:260px"
@endif>
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title style2 text-center mb-40">
                        <span></span>
                        <h2>Doctor Specializations that we offer</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="d-flex justify-content-end">
                        <div class="mb-3 w-25">
                            <input type="text" class="form-control" id="search-doctor" placeholder="Search ..." name="search" value="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div id="get-hospitals">
                        <div class="row">
                            @foreach ($doctorSpecializations as $doctorSpecialization)
                            <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                <div class="service-card style1 h-100">
                                    <div class="service-info">
                                        <a href="{{route('home.allDoctors',$doctorSpecialization->id)}}">
                                            <h4 class="text-capitalize">Name: {{$doctorSpecialization->name}}</h4>
                                        </a>
                                        {{-- <h3>{{strtoupper($doctor->user->phone_number)}}</h3>--}}
                                        <h5> Doctors: {{count($doctorSpecialization->specializedDoctor)}}</h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Service Section End -->
<!-- Promo Section Start -->
<div class="promo-wrap style3 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <div class="promo-card style3">
                    <div class="promo-icon">
                        <i class="flaticon-admision-form"></i>
                    </div>
                    <div class="promo-info">
                        <h3>Contact Our Doctor</h3>
                        <p>There are many variations of passages of words are valid.</p>
                        <a href="#" class="link style2">View All Services <i class="flaticon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                <div class="promo-card style3">
                    <div class="promo-icon">
                        <i class="flaticon-aid-man"></i>
                    </div>
                    <div class="promo-info">
                        <h3>Need Family Health</h3>
                        <p>There are many variations of passages of words are valid.</p>
                        <a href="#" class="link style2">Book Appointment <i class="flaticon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                <div class="promo-card style3">
                    <div class="promo-icon">
                        <i class="flaticon-support"></i>
                    </div>
                    <div class="promo-info">
                        <h3>24 Hours Service</h3>
                        <p>There are many variations of passages of words are valid.</p>
                        <a href="#" class="link style2">Provide Registration<i class="flaticon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="cta-wrap pt-75">
            <div class="row gx-5 align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="cta-content">
                        <div class="cta-logo">
                            <img src="{{asset('public_assets/img/logo.png')}}" width="100px" alt="Image">
                        </div>
                        <div class="content-title style2">
                            <h2>Don't Hesitate To Contact us</h2>
                            <p>We are 24/7 here for your guidance and support. You can approach us at any time. </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="cta-btn">
                        <a href="#" class="btn style2">Make Appointment</a>
                        <a href="{{route('contactUs')}}" class="btn style8">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Promo Section End -->

<!-- Service Section Start -->
<section class="service-wrap style3 ptb-100 bg-athens">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                <div class="section-title style1 text-center mb-40">
                    <span>Offered Services</span>
                    <h2>Think Hard &amp; Focus On The Patient's Well-Being</h2>
                </div>
            </div>
        </div>
        <div class="service-slider-one style2 owl-carousel">
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
        </div>
    </div>
</section>
<!-- Service Section End -->
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('keypress', '#search-doctor', function(event) {
            if (event.which == 13) {
                event.preventDefault();
                var query = $('#search-doctor').val();
                var page = $('#hidden_page').val()
                getData(page, query);
            }
        });
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var page = $(this).attr('href').split('page=')[1];
            var query = $('#search-doctor').val();
            getData(page, query);
        });

        function getData(page, query) {
            $.ajax({
                url: '/getAllDoctors?page=' + page + '&query=' + query,
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