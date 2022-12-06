@extends('patient_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                    @include('admin_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <form action="{{ route('phone.numberVerified') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Phone Number</li>
                                    </ol>
                                </div>
                                <div class="col-4">
                                    <span class="card-title"><strong>Verify Number</strong></span>
                                </div>

                                <div class="col-3 text-end">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-lg-12 col-md-12" id="numbercon">
                                        <div class="form-group row">
                                            <div class="col-6 px-1">
                                                <label for="currentPhoneNumber"><strong> Current Number</strong> </label>
                                            </div>
                                            <div class="col-6 px-0">
                                                <input type="text" id="txtPhone" name="phoneNumberNew" class="form-control" value="{{auth()->user()->phone_number}}" placeholder="+91 *** ******">
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
                                    <div class="card-footer col-lg-12 col-md-12 text-end" id="sendoptbtn">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary my-1" onclick="sendOTP();">Send Otp</button>
                                            <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>

                                    <div class=" card-footer col-lg-12 col-md-12 text-end" style="display: none" class="secondary" id="verifyoptbtn">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary my-1" onclick="verify();">Verify Code</button>
                                            <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
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
