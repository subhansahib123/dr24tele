@extends('public_panel.layout.master')
@section('content')
<!-- Promo Section End -->
<!-- Portfolio Details section Start -->
<section class="service-details-wrap mt-100 pt-100 pb-75">
    <div class="container">
        <div class="row gx-5">
            <div class="col-xl-8">
                <div class="service-desc">
                    <a class="single-service-img" data-fancybox="gallery"
                    ="assets/img/portfolio/single-portfolio-1.jpg">
                        <img src="{{($department->image)? asset('uploads/organization/department/'. $department->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                    </a>
                    <h2>Medical Specialties</h2>
                    <p>This Department was developed with the intention to make the "best possible decisions" for patients. They work on complex cases in order to be able to answer the most important diagnostic questions, such as when a person is acutely unwell, what specific infection they might have and if they need surgery.</p>
                    <h3>Our history &amp; Way to Success </h3>
                    <p>We are proud to be part of {{$department->organization->name}}, which includes {{$department->organization->name}} – one of the top-ranked hospitals in the nation – as well as other hospitals, clinics, and outpatient facilities throughout {{ ($department->organization->country && $stateName && $cityName) ? $cityName .' '. $stateName .', '.  $department->organization->country : '---'}}. Together, we provide comprehensive care for our patients and families, from primary care to specialty care and everything in between.</p>
                    <div class="row align-items-center gx-5">
                        <div class="col-xl-5">
                            <a class="single-service-img" data-fancybox="gallery" href="assets/img/portfolio/portfolio-12.jpg">
                                <img src="{{asset('public_assets/img/about/about-img-14.jpg')}}" alt="Image">
                            </a>
                        </div>
                        <div class="col-xl-7">
                            <ul class="content-feature-list  list-style my-0">
                                <li><i class="ri-checkbox-circle-line"></i>To save lives and end suffering by providing the best quality care possible to every patient </li>
                                <li><i class="ri-checkbox-circle-line"></i>Healthy food and fresh fruit eating engrave your fitness.</li>
                                <li><i class="ri-checkbox-circle-line"></i>You will always be able to work and do what you want.</li>
                                <li><i class="ri-checkbox-circle-line"></i>Work in Day time instead of night.</li>
                                <li><i class="ri-checkbox-circle-line"></i>Take Proper Vitamins and Do Exercise Regularly .</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="sidebar">
                    <div class="sidebar-widget portfolio-info-widget">
                        <h4>Department Brief</h4>

                        <div class="portfolio-info-item-wrap">
                            <div class="portfolio-info-item">
                                <p><i class="ri-calendar-line"></i>Name:</p>
                                <span>{{$department->display_name}}</span>
                            </div>
                            @if(count($department->specialization)>0)
                            <div class="portfolio-info-item">
                                <p style="font-size: 15px;"><i class="ri-database-line"></i>Specialize:</p>
                                <span>
                                    @foreach($department->specialization as $specialization)
                                    {{$specialization->name .', '}}
                                    @endforeach
                                </span>
                            </div>
                            @endif
                            <div class="portfolio-info-item">
                                <p><i class="ri-user-follow-line"></i>Doctors:</p>
                                <span>{{count($department->doctor)}}</span>
                            </div>
                            <div class="portfolio-info-item">
                                <p><i class="ri-hospital-line"></i>Hospital:</p>
                                <span class="text-capitalize">{{$department->organization->name}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget categories">
                        <h4> Specializations </h4>
                        <div class="category-box">
                            <ul class="list-style">
                                @foreach($departmentSpecializations as $departmentSpecialization)
                                <li>
                                    <a class="text-capitalize" href="{{route('home.allDepartments',$departmentSpecialization->id)}}">
                                        {{$departmentSpecialization->name}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Details section End -->
<!-- Service Section Start -->
<section class="service-wrap style2 ptb-50">
    <div class="container ">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <h2>Our Well Qualified Doctors</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div id="get-hospitals">
                    <div class="row">
                        @foreach ($department->doctor as $doctor)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <a href="{{route('home.doctor_details',$doctor->id)}}"><img src="{{($doctor->user->image)? asset('uploads/organization/department/doctor/'. $doctor->user->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                    </a>
                                </div>
                                <div class="service-info">

                                    <h5 class="text-capitalize"><a href="{{route('home.doctor_details',$doctor->id)}}">Name: {{$doctor->user->name}}</a></h5>

                                    <a href="{{route('home.doctor_details',$doctor->id)}}" class="link style2">Explore More</a>
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
@endsection
@push('js')

@endpush
