@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid mt-4">
            @include('admin_panel.frontend.includes.messages')

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{ route('passwordUpdated') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Updating</li>
                                    </ol>
                                </div>
                                <div class="col-4">
                                    <span class="card-title"><strong>
                                            Update Password
                                        </strong></span>
                                </div>

                                <div class="col-3 text-end">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">

                                            <label for="currentPassword">Current Password</label>
                                            <input type="text" class="form-control" name="currentPassword" value="" id="currentPassword" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" class="form-control" name="password" required  id="password" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="password">Confirm Password</label>
                                            <input id="password" class="form-control" type="password" name="password_confirmation" placeholder="New Password" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success my-1">Update</button>
                                <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>

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