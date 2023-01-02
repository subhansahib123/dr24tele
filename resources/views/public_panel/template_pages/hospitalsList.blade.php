@extends('public_panel.layout.master')
@section('content')


<!-- Content Wrapper Start -->
<div class="content-wrapper">
<!-- Service Section Start -->
@if(count($organizations)>0)
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
                                    <h3 class="text-capitalize"><a href="{{route('home.hospital_details',$organization->id)}}">Name: {{$organization->displayname}}</a></h3>
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
@endif
<!-- Service Section End -->

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
                    <div class="service-info text-center">
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
                    <div class="service-info text-center">
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
                    <div class="service-info text-center">
                        <h3><a href="#">Specialist Advise</a></h3>
                        <p>It is a long established fact that reader will content of page when looks layout.</p>
                        <a href="#" class="link style2">Explore More</a>
                    </div>
                </div>
                <div class="service-card style3" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="800">
                    <div class="service-img">
                        <img src="{{asset('public_assets/img/Vectors/HeartCheckup.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-health-care"></i></span>
                    </div>
                    <div class="service-info text-center">
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
                url: '{{route('hospitalsList')}}'+'?page=' + page + '&query=' + query,
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
