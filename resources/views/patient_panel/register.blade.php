@extends('public_panel.layout.master')
@section('content')
<div class="content-wrapper">

    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap bg-f br-1">
        <div class="container">
            <div class="breadcrumb-title">
                <h2>Patient Register</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="{{route('home.page')}}">Home </a></li>

                    <li>Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Account Section start -->
    <section class="Login-wrap pt-100 pb-75">
        <div class="container">
            <div class="row ">
                <div class="col-xl-10 offset-xl-1 col-md-10 offset-md-1 col-sm-12">
                    <div class="login-form-wrap">
                        <div class="login-header">
                            <h3 class="text-center">Register</h3>
                            @include('admin_panel.frontend.includes.messages')

                        </div>
                        <form class="login-form" id="login_form" method="POST" enctype="multipart/form-data" action="{{route('patient.registered')}}">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Name *</label>

                                        <input type="text" value="{{old('givenName')}}" required name="givenName" name="username" onkeydown="return /[a-z\ ]/i.test(event.key)" class="form-control" placeholder="Enter Name">
                                        @if ($errors->has('givenName'))
                                        <span class="text-danger text-left">{{ $errors->first('givenName') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email *</label>

                                        <input type="email" value="{{old('email')}}" required  onkeydown="return /[a-z,0-9\@\.]/i.test(event.key)" name="email" class="form-control" placeholder="Enter Email">
                                        @if ($errors->has('email'))
                                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Gender *</label>

                                        <select name="gender_code" required class="form-select form-select-lg mb-3">
                                                <option  value="">Select </option>
                                                 <option {{old('gender_code')=='F'?'selected':''}} value=" F">Female</option>
                                            <option {{old('gender_code')=='M'?'selected':''}} value="M">Male</option>
                                            <option {{old('gender_code')=='IND'?'selected':''}} value="IND">Indeterminate sex</option>
                                            <option {{old('gender_code')=='TRA'?'selected':''}} value="TRA">Transsexual</option>
                                            <option {{old('gender_code')=='O'?'selected':''}} value="O">Others</option>

                                        </select>
                                        @if ($errors->has('gender_code'))
                                        <span class="text-danger text-left">{{ $errors->first('gender_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Date of Birth </label>

                                        <input type="date" id="number" value="{{old('dateOfBirth')}}" name="dateOfBirth" class="form-control" placeholder="Enter Date of Birth*">
                                        @if ($errors->has('dateOfBirth'))
                                        <span class="text-danger text-left">{{ $errors->first('dateOfBirth') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Phone Number *</label>

                                        <input type="text" id="txtPhone" required maxlength="10" class="form-control" placeholder="+91 *** ******">
                                        <input type="hidden" class="form-control" id="phoneNumber">
                                        @if ($errors->has('phoneNumber'))
                                        <span class="text-danger text-left">{{ $errors->first('phoneNumber') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class=" col-lg-6 col-md-8 col-sm-12 mb-3">
                                    <label for="image" class="col-md-3 form-label">Picture </label>
                                    <div class="col-md-9">
                                        <input class="form-control  mt-3" type="file" name="image" id="image">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6   col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label> Organisation *</label>

                                        <select name="orguuid" class="form-select form-select-lg mb-3">
                                            <option value="">Select </option>
                                            @foreach ($organizations as $organization )
                                            <option value="{{$organization->uuid}}" {{old('orguuid')==$organization->uuid?'selected':''}}>{{$organization->name}}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('orguuid'))
                                        <span class="text-danger text-left">{{ $errors->first('orguuid') }}</span>
                                        @endif
                                    </div>
                                </div> -->

                                <!-- <div class="col-lg-12 col-12 col-md-12 col-sm-12" id="organization">
                                    <div class="form-group row">
                                        <div class="col-8 mt-3">
                                            <p><strong> Already Registered with Organization</strong></p>
                                        </div>
                                        <div class="col-1 mt-0">
                                            <input type="checkbox" id="reg_Organization">
                                        </div>
                                        <div class="col-3 align-self-right"></div>
                                    </div>
                                </div>


                                <div class="col-lg-6 col-6 col-md-6 col-sm-12" style="display:none" id="reg_img">
                                    <div class="form-group">
                                        <label>Reg. Card *</label>

                                        <input type="file" name="reg_img" class="form-control">
                                        @if ($errors->has('reg_img'))
                                        <span class="text-danger text-left">{{ $errors->first('reg_img') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 col-md-12 col-sm-12" style="display:none" id="card">
                                    <div class="form-group row">
                                        <div class="col-8 mt-3">
                                            <p><strong> Don't have Registration Card</strong></p>
                                        </div>
                                        <div class="col-1 mt-0">
                                            <input type="checkbox" id="pay_by_atmCard">
                                        </div>
                                        <div class="col-3 align-self-right"></div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 col-md-12 col-sm-12" style="display:none" id="atm_card">
                                    <div class="form-group">
                                        <label>Pay Fee by your Atm Card *</label>

                                        <input type="number" name="atm_card" placeholder="Card Number" class="form-control">

                                    </div>
                                </div> -->


                                {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">


                                        <div id="recaptcha-container"></div>


                                    </div> --}}
                                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                        <div class="checkbox style3">
                                            <input type="checkbox" id="test_1">
                                            <label for="test_1">
                                                Remember Me
                                             *</label>
                                        </div>
                                    </div> --}}
                                {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end mb-20">
                                        <a href="#" class="link style1">Forgot Password?</a>
                                    </div> --}}
                                <div class="row  gx-0">
                                    <div class="col-lg-3  offset-lg-0  col-md-4 offset-md-0 col-sm-10 offset-sm-1  mt-5 text-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn style1 w-100 d-block">
                                                Register
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <p class="mb-0">Already have an Account? <a class="link style1" href="{{route('patient.login')}}">Login</a></p>
                                </div>
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