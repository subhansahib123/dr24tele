<!-- Back-to-top button Start -->
<a href="javascript:void(0)" class="back-to-top bounce"><i class="ri-arrow-up-s-line"></i></a>
<!-- Back-to-top button End -->

<!-- Link of JS files -->


@if (Route::is('conference'))
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src='{{ asset('public_assets/js/AgoraRTCSDK.min.js') }}'></script>
<script src='{{ asset('public_assets/js/agora-interface.js') }}'></script>
<script src="{{asset('public_assets/js/custom-Agora.js')}}"></script>

<script src="{{asset('public_assets/js/form-validator.min.js')}}"></script>
<script src="{{asset('public_assets/js/contact-form-script.js')}}"></script>
<script src="{{asset('public_assets/js/aos.js')}}"></script>
<script src="{{asset('public_assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public_assets/js/odometer.min.js')}}"></script>
<script src="{{asset('public_assets/js/fancybox.js')}}"></script>
<script src="{{asset('public_assets/js/jquery.appear.js')}}"></script>
<script src="{{asset('public_assets/js/tweenmax.min.js')}}"></script>
<script src="{{asset('public_assets/js/main.js')}}"></script>


@else
<script src="{{asset('public_assets/js/jquery.min.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public_assets/js/form-validator.min.js')}}"></script>
<script src="{{asset('public_assets/js/contact-form-script.js')}}"></script>
<script src="{{asset('public_assets/js/aos.js')}}"></script>
<script src="{{asset('public_assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public_assets/js/odometer.min.js')}}"></script>
<script src="{{asset('public_assets/js/fancybox.js')}}"></script>
<script src="{{asset('public_assets/js/jquery.appear.js')}}"></script>
<script src="{{asset('public_assets/js/tweenmax.min.js')}}"></script>
<script src="{{asset('public_assets/js/main.js')}}"></script>


<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
var loggedIn = {{ auth()->check() ? 1 : 0 }};
var user_id='';
@auth
    if(loggedIn==1){
    var user_id={{auth()->user()->id}};
    }
@endauth
</script>
<script src="{{asset('public_assets/js/firebase.js')}}"></script>
@endif
</body>

</html>
