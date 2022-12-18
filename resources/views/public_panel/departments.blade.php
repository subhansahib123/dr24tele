@extends('public_panel.layout.master')
@section('content')
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-2">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Services</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{route('home.page')}}">Home </a></li>
                    <li>Departments</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Service Section Start -->
    <section class="service-wrap ptb-100">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($departments as $department )


                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="service-card style1">
                        <div class="service-img">
                            <img src="{{asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                            <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                        </div>
                        <div class="service-info">
                            <h3><a href="service-details.html">{{$department->name}}</a></h3>
                            <p>It is a long established fact that reader will content of page when looks layout.</p>
                            <a href="{{route('doctors.of.department',$department->id)}}" class="link style2">Find Doctors</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <ul class="page-nav list-style">
                <li><a href="service-one.html"><i class="ri-arrow-left-s-line"></i></a></li>
                <li><a class="active" href="service-one.html">1</a></li>
                <li><a href="service-one.html">2</a></li>
                <li><a href="service-one.html">3</a></li>
                <li><a href="service-one.html"><i class="ri-arrow-right-s-line"></i></a></li>
            </ul>
        </div>
    </section>
    <!-- Service Section End -->

</div>

@endsection