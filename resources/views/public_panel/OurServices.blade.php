@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section End -->


<!-- Service Section Start -->
<section class="service-wrap style3 mt-100 ptb-100 bg-athens">
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
                    <div class="service-info">
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
                        <img src="{{asset('public_assets/img/Vectors/HeartCheckup.jpg')}}" alt="Image">
                        <span class="service-icon"><i class="flaticon-health-care"></i></span>
                    </div>
                    <div class="service-info">
                        <h3><a href="#">Heart Checkup</a></h3>
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