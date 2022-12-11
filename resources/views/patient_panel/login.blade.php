@extends('public_panel.layout.master')
@section('content')
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Patient Login</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="index.html">Home </a></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Account Section start -->
    <section class="Login-wrap pt-100 pb-75">
        <div class="container">
            <div class="row gx-5">
                <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="login-form-wrap">
                        <div class="login-header">
                            <h3>Login</h3>
                            @include('admin_panel.frontend.includes.messages')
                            <div class="alert alert-danger" id="error" style="display: none;"></div>

                            <div class="alert alert-success" id="successAuth" style="display: none;"></div>
                        </div>
                        <form class="login-form" id="login_form" method="POST" action="{{route('patient.loggedin')}}">
                            @csrf
                            <input type="hidden" name="role" value="patient" />
                            <div class="row">
                                <div class="col-lg-12" id="numbercon">
                                    <div class="form-group">
                                        {{-- <input id="text" name="fname" type="text" placeholder="Username Or Email Address" required=""> --}}
                                        <input type="text" id="txtPhone" value="+9113231" class="form-control" placeholder="+91 *** ******">
                                        <input type="hidden" class="form-control" id="phoneNumber">
                                    </div>
                                </div>
                                <div class="col-lg-12" style="display: none" id="verfiycon">
                                    <div class="form-group">
                                        {{-- <input id="text" name="fname" type="text" placeholder="Username Or Email Address" required=""> --}}
                                        <input type="text" id="verification" class="form-control" placeholder="Enter your code">
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input id="pwd" name="pwd" placeholder="Password" type="password">
                                                </div>
                                            </div> --}}
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">


                                    <div id="recaptcha-container"></div>


                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <div class="checkbox style3">
                                        <input type="checkbox" id="test_1">
                                        <label for="test_1">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end mb-20">
                                    <a href="recover-password.html" class="link style1">Forgot Password?</a>
                                </div>

                                <div class="col-lg-12" id="sendoptbtn">
                                    <div class="form-group">
                                        <button type="button" class="btn style1 w-100 d-block" onclick="sendOTP();">
                                            Send OTP
                                        </button>

                                    </div>
                                </div>
                                <div class="col-lg-12" id="verifyoptbtn" style="display: none">
                                    <div class="form-group">
                                        <button type="button" class="btn style1 w-100 d-block" onclick="verify();">
                                            Verify code
                                        </button>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-0">Don't have an Account? <a class="link style1" href="{{route('patient.register')}}">Create One</a></p>
                                </div>
                                <!-- <div class="col-lg-12">
                                    <div class="form-group"> <button type="submit" class="btn style1 w-100 d-block">Login </button>

                                    </div>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Account Section end -->

</div>

@endsection