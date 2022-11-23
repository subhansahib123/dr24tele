@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Update Phone Number</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Phone Number</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                    @include('admin_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <form action="{{ route('phoneNumberVerified') }}" id="login_form" method="POST">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Verifying Phone Number</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="role" value="doctor" />

                                    <div class="col-lg-12 col-md-12" id="numbercon">
                                        <div class="form-group row">
                                            <div class="col-6 px-1">
                                                <label for="currentPhoneNumber"><strong> Enter Current Number</strong> </label>
                                            </div>
                                            <div class="col-6 px-0">
                                                <input type="text" id="txtPhone" name="" class="form-control" placeholder="+91 *** ******">
                                                <input type="hidden" class="form-control" id="phoneNumber">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12" style="display: none" class="secondary" id="verfiycon">
                                        <div class="form-group">

                                            <label for="verification">Enter Code</label>
                                            <input type="number" class="form-control" required="" id="verification" placeholder="code" maxlength="6">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">


                                        <div id="recaptcha-container"></div>


                                    </div>
                                    <div class="col-lg-12 col-md-12" id="sendoptbtn">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary my-1" onclick="sendOTP();">Send Otp</button>
                                            <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" style="display: none" class="secondary" id="verifyoptbtn">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary my-1" onclick="verify();">Verify Code</button>
                                            <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="newPhoneNumber">New Phone Number</label>
                                            <input type="text" id="txtPhoneNew" class="form-control" placeholder="New Phone Number">
                                            <input type="hidden" class="form-control" id="newPhoneNumber">
                                        </div>
                                    </div> -->
                                </div>

                            </div>
                            <!-- <div class="card-footer text-start">
                                <button type="submit" class="btn btn-success my-1">Update</button>
                                <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                                {{-- <a href="javascript:void(0)" class="btn btn-danger my-1">Cancel</a> --}}
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!--CONTAINER CLOSED -->

    </div>
</div>
@endsection