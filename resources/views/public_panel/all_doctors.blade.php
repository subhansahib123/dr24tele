@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section End -->


<!-- Service Section Start -->
<section class="service-wrap style2  pt-100 pb-40">
    <div class="container pt-100">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <h2>Our Specialized Doctors </h2>
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
                        @foreach ($doctors->specializedDoctor as $doctor)
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <a href="{{route('home.doctor_details',$doctor->id)}}"> <img src="{{($doctor->user->image)? asset('uploads/organization/department/doctor/'. $doctor->user->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image"></a>
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <a href="{{route('home.doctor_details',$doctor->id)}}">
                                        <h5 class="text-capitalize link style2">Name: {{$doctor->user->name}}</h5>
                                    </a>
                                    {{-- <h3>{{strtoupper($doctor->user->phone_number)}}</h3> --}}
                                    <h5 class="text-capitalize">Department: {{$doctor->department->display_name}}</h5>
                                    <a href="{{route('home.doctor_details',$doctor->id)}}" class="link style2">Explore More</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="d-flex justify-content-center">
                                {!! $doctors->render() !!}
                            </div> --}}
                    </div>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service Section End -->
<!-- Counter Section Start -->
<div class="counter-wrap pt-100 pb-25  bg-blue">
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
</div>
<!-- Testimonial Section Start -->

<section class="style1 mtb-100 ">
    <div class="container">
        <div class="cta-wrap ">
            <div class="row gx-5 align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="cta-content">
                        <div class="cta-logo">
                            <img src="{{asset('public_assets/img/logo.png')}}" width="100px" alt="Image">
                        </div>
                        <div class="content-title">
                            <h2>Don't Hesitate To Contact us</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto inventore voluptatem possimus quibusdam veritatis. Accusamus ipsum saepe quas.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="cta-btn">
                        <a href="appointment.html" class="btn style1">Make Appointment</a>
                        <a href="contact.html" class="btn style2">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section End -->
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