@extends('public_panel.layout.master')
@section('content')

<!-- Service Section Start -->
<section class="service-wrap style2 ptb-100">
    <div class="container ptb-100">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <span>{{$hospital->displayname}}</span>
                    <h2>Our Departments</h2>
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
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <h3><a href="{{route('home.department_details',$department->id)}}">{{strtoupper($department->display_name)}}</a></h3>
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