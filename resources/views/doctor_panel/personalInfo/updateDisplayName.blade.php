@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-5">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- ROW-1 OPEN -->
            @include('admin_panel.frontend.includes.messages')

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{ route('displayNameUpdated') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Display Name</li>
                                    </ol>
                                </div>
                                <div class="col-3">
                                    <span class="card-title"><strong> Update Name</strong></span>
                                </div>

                                <div class="col-4 text-end">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="CurrentDisplayName">Current  Name</label>
                                            <input type="text" class="form-control" value="{{$displayName}}" disabled name="CurrentDisplayName" id="CurrentDisplayName">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">

                                            <label for="displayName"> New Name</label>
                                            <input type="text" class="form-control" name="displayName" placeholder="Enter Name" id="displayName">
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