@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Update Password</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Password</li>
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
                        <form action="{{ route('passwordUpdated') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h3>User</h3>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">

                                            <label for="currentPassword">Current Password</label>
                                            <input type="text" class="form-control" name="currentpassword" value="" id="currentPassword" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="newPassword">New Password</label>
                                            <input type="text" class="form-control" name="newpassword" id="newPassword" placeholder="New Password">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-start">
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