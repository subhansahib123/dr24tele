@extends('public_panel.layout.master')
@section('content')

    <!-- Hero Section End -->

    <!-- Promo Section Start -->
    <div class="promo-wrap style2 pb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-admision-form"></i>
                        </div>
                        <div class="promo-info">
                            <h3>Contact Our Doctor</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="service-one.html" class="link style2">View All Services <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-aid-man"></i>
                        </div>
                        <div class="promo-info">
                            <h3>Need Family Health</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="appointment.html" class="link style2">Book Appointment <i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="400">
                    <div class="promo-card style2">
                        <div class="promo-icon">
                            <i class="flaticon-support"></i>
                        </div>
                        <div class="promo-info">
                            <h3>24 Hours Service</h3>
                            <p>There are many variations of passages of words are valid.</p>
                            <a href="register.html" class="link style2">Provide Registration<i class="flaticon-right-arrow"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta-wrap style2 pt-75">
                <div class="row gx-5 align-items-center">
                    <div class="col-xl-8 col-lg-7">
                        <div class="cta-content">
                            <div class="cta-logo">
                                <img src="{{asset('public_assets/img/cta-icon-2.png')}}" alt="Image">
                            </div>
                            <div class="content-title style2">
                                <h2>Don't Hesitate To Contact us</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto inventore voluptatem possimus quibusdam veritatis. Accusamus ipsum saepe quas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="cta-btn">
                            <a href="appointment.html" class="btn style2">Make Appointment</a>
                            <a href="contact.html" class="btn style6">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Promo Section End -->

    <!-- Service Section Start -->
    <section class="service-wrap style2 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="section-title style2 text-center mb-40">
                        <span>Our Services</span>
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
                            @foreach ($departments as $department)
                                <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                                    <div class="service-card style1 h-100">
                                        <div class="service-img">
                                            <img src="{{asset('public_assets/img/services/service-9.jpg')}}" alt="Image">
                                            <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                        </div>
                                        <div class="service-info">
                                            <h2><a href="{{route('home.department_details',$department->slug)}}">{{strtoupper($department->name)}}</a></h2>
                                            <h3>Total Doctors: {{count($department->doctor)}}</a></h3>
                                            <a href="{{route('home.department_details',$department->slug)}}" class="link style2">Explore More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center">
                                {!! $departments->render() !!}
                            </div>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('keypress', '#search-hospital', function(event){
                if(event.which == 13) {
                    event.preventDefault();
                    var query = $('#search-hospital').val();
                    var page = $('#hidden_page').val()
                    getData(page, query);
                }
            });
            $(document).on('click', '.pagination a',function(event){
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var page=$(this).attr('href').split('page=')[1];
                var query = $('#search-hospital').val();
                getData(page,query);
            });
            function getData(page,query){
                $.ajax(
                    {
                        url: '/getAllDepartments?page=' + page +'&query='+query,
                        type: "get",
                        success:function (data){
                            if (data.length > 0){
                                $('body').empty().html(data)
                            }
                        }
                    });
            }
        });


    </script>
@endpush
