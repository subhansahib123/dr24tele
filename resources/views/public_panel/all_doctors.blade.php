@extends('public_panel.layout.master')
@section('content')



<!-- Hero Section End -->


<!-- Service Section Start -->
<section class="service-wrap style2  ptb-100">
    <div class="container ptb-100">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <div class="section-title style2 text-center mb-40">
                    <span>{{$doctors->name}}</span>
                    <h2>Doctors we have</h2>
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
                                    <a href="{{route('load.appointment',$doctor->id)}}"> <img src="{{($doctor->user->image)? asset('uploads/organization/department/doctor/'. $doctor->user->image) : asset('public_assets/img/services/service-9.jpg')}}" alt="Image"></a>
                                    <span class="service-icon"><i class="flaticon-hospital-ward"></i></span>
                                </div>
                                <div class="service-info">
                                    <a href="{{route('load.appointment',$doctor->id)}}">
                                        <h3>{{strtoupper($doctor->user->username)}}</h3>
                                    </a>
                                    {{-- <h3>{{strtoupper($doctor->user->phone_number)}}</h3> --}}
                                    <h5>Department : {{strtoupper($doctor->department->display_name)}}</h5>
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