@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section End -->


<!-- Service Section Start -->
<section class="service-wrap style2 mt-100 ptb-100">
    <div class="container">
        <div class="row">

            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <span>Our Services</span>
                    <h2>We're Providing Best Services</h2>
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
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <img src="{{asset('public_assets/img/services/Pathology.jpg')}}" alt="Image">
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <a href="#">
                                        <h3>Pathology</h3>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit sint, corporis delectus numquam.</p>
                                    <a href="#" class="link style2">Explore More</a>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <img src="{{asset('public_assets/img/services/SpecialistAdvise.jpg')}}" alt="Image">
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <a href="#">
                                        <h3>Specialist Advise</h3>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit sint, corporis delectus numquam.</p>
                                    <a href="#" class="link style2">Explore More</a>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-3">
                            <div class="service-card style1 h-100">
                                <div class="service-img text-center">
                                    <img src="{{asset('public_assets/img/services/PatientOnboarding.jpg')}}" alt="Image">
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <a href="#">
                                        <h3>Patient Onboarding</h3>
                                    </a>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit sint, corporis delectus numquam.</p>
                                    <a href="#" class="link style2">Explore More</a>

                                </div>
                            </div>
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