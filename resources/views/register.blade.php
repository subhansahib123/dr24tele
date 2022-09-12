<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/brand/favicon.ico')}}" />

    <!-- TITLE -->
    <title>Tool Prime | Register</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/dark-style.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/transparent-style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('assets/colors/color1.css')}}" />
     <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center text-white">
                        <h3>Tool Prime</h3>
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form class="login100-form validate-form"  action="{{route('register.perform')}}" method="POST">
                            <span class="login100-form-title">
									Registration
								</span>

                                @if($errors->any())
                                @foreach ($errors->all() as $error )
                                <h4 style="color:red">{{$error}}</h4>

                                @endforeach
                                @endif
                                @csrf
                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="mdi mdi-account" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" value="{{old('full_name')}}" name="full_name" type="text" placeholder="Full name">

                                @if ($errors->has('full_name'))
                                <span class="text-danger">{{ $errors->first('full_name') }}</span>
                            @endif

                            </div>
                            <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" value="{{old('email')}}" name="email" type="email" placeholder="Email">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            </div>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" value="{{old('password')}}" name="password" type="password" placeholder="Password">
                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                            </div>
                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                    <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                </a>
                                <input class="input100 border-start-0 ms-0 form-control" value="{{old('password_confirmation')}}"  name="password_confirmation" type="password" placeholder="Confirm Password">
                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <strong>ReCaptcha:</strong>
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <label class="custom-control custom-checkbox mt-4">
									<input type="checkbox" class="custom-control-input" required>
									<span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
								</label>
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary">
										Register
									</button>
                            </div>
                            <div class="text-center pt-3">
                                <p class="text-dark mb-0">Already have account?<a href="{{route('login.show')}}" class="text-primary ms-1">Sign In</a></p>
                            </div>
                            <label class="login-social-icon"><span>Register with Social</span></label>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('login.google') }}">
                                    <div class="social-login me-4 text-center">
                                        <i class="fa fa-google"></i>
                                    </div>
                                </a>
                                <a href="{{ route('login.facebook') }}">
                                    <div class="social-login me-4 text-center">
                                        <i class="fa fa-facebook"></i>
                                    </div>
                                </a>
                                <a href="{{ route('login.linkedin') }}">
                                    <div class="social-login text-center">
                                        <i class="fa fa-linkedin"></i>
                                    </div>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- END PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- BOOTSTRAP JS -->
    <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="{{asset('assets/js/show-password.min.js')}}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

    <!-- Color Theme js -->
    <script src="{{asset('assets/js/themeColors.js')}}"></script>

    <!-- CUSTOM JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>


</body>

</html>
