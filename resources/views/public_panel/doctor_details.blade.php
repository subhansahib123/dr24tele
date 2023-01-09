@extends('public_panel.layout.master')
@section('content')
<!-- Promo Section End -->
<!-- Portfolio Details section Start -->
<section class="service-details-wrap mt-100 pt-100 pb-75">
    <div class="container">
        <div class="row gx-5">
            <div class="col-xl-8">
                <div class="service-desc">
                    <div class="row">
                        <div class="col-3 align-self-start"></div>
                        <div class="col-6">
                            <a class="single-service-img" data-fancybox="gallery" href="#">
                                <img src="{{($doctor->user->image)? asset('uploads/organization/department/doctor/'. $doctor->user->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                            </a>
                        </div>
                        <div class="col-3 align-self-end">

                        </div>
                    </div>
                    <h2>Medical Experience and Qualification</h2>
                    <p>Hello ! <br>My name is {{$doctor->user->name}}. I am serving form 4 years and If you are looking for a good doctor, it is important to find one who is certified and has plenty of experience. You should also read reviews to get an idea of what other patients thought of their experience. Lastly, make sure to have a good conversation with the doctor before making any decisions.
                    </p>
                    <h3>History &amp; Way to Success </h3>
                    <p>I am proud to be part of {{$doctor->department->organization->displayname}}, which includes {{$doctor->department->organization->displayname}} – one of the top-ranked hospitals in the nation – as well as other hospitals, clinics, and outpatient facilities throughout the World. Together, we provide comprehensive care for our patients and families, from primary care to specialty care and everything in between.</p>
                    <div class="row align-items-center gx-5">
                        <div class="col-xl-5">
                            <a class="single-service-img" data-fancybox="gallery" href="assets/img/portfolio/portfolio-12.jpg">
                                <img src="{{asset('public_assets/img/about/about-img-12.jpg')}}" alt="Image">
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
                    <div class="cta-btn mb-4">
                        <a href="{{route('load.appointment',[$doctor->id])}}" class="btn style2">Make Appointment</a>
                    </div>
                    <div class="sidebar-widget portfolio-info-widget">
                        <h4>Doctor Brief</h4>

                        <div class="portfolio-info-item-wrap">
                            <div class="portfolio-info-item">
                                <p><i class="ri-calendar-line"></i>Name:</p>
                                <span class="text-capitalize">@if(isset($doctor->prefix))
                                    {{$doctor->prefix}}.
                                    @endif
                                    {{$doctor->user->name}}</span>
                            </div>
                            @if(count($doctor->specialization)>0)
                            <div class="portfolio-info-item" style="font-size:14px ;">
                                <p><i class="ri-user-follow-line"></i>Specialize:</p>
                                <span class="text-capitalize">
                                    @foreach($doctor->specialization as $specialization)
                                    {{$specialization->name}}
                                    @endforeach
                                </span>
                            </div>
                            @endif
                            <div class="portfolio-info-item">
                                <p><i class="ri-hospital-line"></i>Depart:</p>
                                <span class="text-capitalize">{{$doctor->department->display_name}}</span>
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

@endsection
@push('js')

@endpush
