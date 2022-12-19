@extends('public_panel.layout.master')
@section('content')


<!-- Portfolio Details section Start -->
<section class="service-details-wrap mt-100 pt-100 pb-75">
    <div class="container">
        <div class="row gx-5">
            <div class="col-xl-8">
                <div class="service-desc">
                    <a class="single-service-img" data-fancybox="gallery" href="assets/img/portfolio/single-portfolio-1.jpg">
                    <img src="{{($hospital->image)? asset('uploads/organization/'. $hospital->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                    </a>
                    <h2>Health Care For Your Family</h2>
                    <p>Our mission is to provide quality health care for your family. We are dedicated to providing the best possible care for our patients and their families. We strive to provide a safe and caring environment for our employees and our patients. We are committed to providing the highest quality of care possible.</p>
                    <h3>Our Treatment Plan &amp; Strategies</h3>
                    <p>Our mission is to provide the highest quality medical care and services to our patients and their families. We are dedicated to continuous improvement in all that we do, and we strive to be a leader in the healthcare industry. We are committed to providing a healing environment for our patients and staff, and we pledge to always put our patients first.</p>
                    <div class="row align-items-center gx-5">
                        <div class="col-xl-5">
                            <a class="single-service-img" data-fancybox="gallery" href="assets/img/portfolio/portfolio-12.jpg">
                                <img src="{{asset('public_assets/img/about/about-img-16.webp')}}" alt="Image">
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
                        <h4>Hospital Brief</h4>

                        <div class="portfolio-info-item-wrap">
                            <div class="portfolio-info-item">
                                <p><i class="ri-calendar-line"></i>Name:</p>
                                <span class="text-capitalize">{{$hospital->name}}</span>
                            </div>
                            <div class="portfolio-info-item">
                                <p><i class="ri-user-follow-line"></i>Email:</p>
                                <span>{{$hospital->email}}</span>
                            </div>
                            <div class="portfolio-info-item">
                                <p><i class="ri-map-pin-line"></i>Location:</p>
                                <span>{{ ($hospital->country && $stateName && $cityName) ? $cityName .', '. $stateName .', '.  $hospital->country : '---'}}</span>
                            </div>
                            <div class="portfolio-info-item">
                                <p><i class="ri-mail-line"></i>Phone:</p>
                                <span>{{$hospital->postalCode}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-widget categories">
                        <h4>Department Specialization</h4>
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
                    <div class="sidebar-widget tags">
                        <h4>Department Specialization </h4>
                        <div class="tag-list">
                            <ul class="list-style">
                                @foreach($doctorSpecializations as $doctorSpecialization)
                                <li><a class="text-capitalize" href="{{route('home.allDoctors',$doctorSpecialization->id)}}">{{$doctorSpecialization->name}}</a></li>
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
<section class="service-wrap style2 mb-100 pb-0">
    <div class="container ptb-50">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <h2>Our Well Trusted Departments</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div id="get-hospitals">
                    <div class="row">
                        @foreach ($hospital->department as $department)
                        @if(count($department->doctor)>0)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <img src="{{($department->image)? asset('uploads/organization/department/'. $department->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                </div>
                                <div class="service-info">
                                    <h3 class="text-capitalize"><a href="{{route('home.department_details',$department->id)}}">Name: {{$department->display_name}}</a></h3>
                                    <h5>Total Doctors: {{count($department->doctor)}} </h5>
                                    {{-- <h5>Best Doctor: {{isset($department->doctor[0]->user->name)?$department->doctor[0]->user->name:''}}</h5>--}}
                                    <a href="{{route('home.department_details',$department->id)}}" class="link style2">Explore More</a>
                                </div>
                            </div>
                        </div>
                        @endif
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