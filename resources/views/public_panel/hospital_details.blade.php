@extends('public_panel.layout.master')
@section('content')
    <!-- Promo Section End -->

    <!-- Service Section Start -->
    <section class="service-wrap style2 ptb-100">
        <div class="container ptb-100">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title style2 text-center mb-40">
                        <span>Hospital Name</span>
                        <h2>{{$hospital->name}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div id="get-hospitals">
                        <div class="row">
                            @foreach ($hospital->department as $department)
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="service-card style1 h-100">
                                        <div class="service-img">
                                            <img src="{{asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                            <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                        </div>
                                        <div class="service-info">
                                            <h3><a href="{{route('home.department_details',$department->slug)}}">{{strtoupper($department->name)}}</a></h3>
                                            <h4>Best Doctor: {{isset($department->doctor[0]->user->username)?$department->doctor[0]->user->username:''}}</h4>
                                            <h4>Total Doctors: {{count($department->doctor)}}</h4>
                                            <a href="{{route('home.department_details',$department->slug)}}" class="link style2">Explore More</a>
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
