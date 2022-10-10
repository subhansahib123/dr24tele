@extends('public_panel.layout.master')
@section('content')

<!-- Content Wrapper Start -->
<div class="content-wrapper">

<!-- Error  Section start -->
<div class="error-wrap ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="error-content">
                    <img src="{{asset('public_assets/img/404.png')}}" alt="Iamge">
                    <h2>Oops! Page Not Found</h2>
                    <p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
                    <a href="index.html" class="btn style1">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Error  Section end -->

</div>
<!-- Content wrapper end -->



@endsection