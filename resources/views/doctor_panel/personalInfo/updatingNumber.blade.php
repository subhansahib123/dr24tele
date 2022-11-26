@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-5">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('admin_panel.frontend.includes.messages')

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{ route('phoneNumberUpdated') }}" id="login_form" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Phone Number</li>
                                    </ol>
                                </div>
                                <div class="col-3">
                                    <span class="card-title"><strong> Update Number</strong></span>
                                </div>

                                <div class="col-4 text-end">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group row">
                                            <div class="col-6 px-2">
                                                <label for="txtPhoneNew"><strong>New  Number</strong></label>
                                            </div>
                                            <div class="col-6 px-0">

                                                <input type="text" id="txtPhoneNew" class="form-control" placeholder="Number">
                                                <input type="hidden" class="form-control" id="phoneNumberNew">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success my-1">Update</button>
                                <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                                {{-- <a href="javascript:void(0)" class="btn btn-danger my-1">Cancel</a> --}}
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