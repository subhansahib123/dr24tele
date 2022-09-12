@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Edit Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
                            <form action="{{ route('info.store') }}" method="POST">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title">Edit Profile</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputname">Full Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $user->name }}" id="exampleInputname"
                                                    placeholder="Full Name">
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputname1">Last Name</label>
                                        <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Last Name">
                                    </div>
                                </div> --}}

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $user->email }}" id="exampleInputEmail1"
                                                    placeholder="Email address">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputnumber">Contact Number</label>
                                                <input type="number" class="form-control" name="phone_number"
                                                    value="{{ $user->phone_number }}" id="exampleInputnumber"
                                                    placeholder="Contact number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputnumber">Company</label>
                                                <input type="text" class="form-control" name="company_name"
                                                    value="{{ $user->company_name }}" id="exampleInputnumber"
                                                    placeholder="Contact number">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Website</label>
                                                <input class="form-control" placeholder="Enter Website URL"
                                                    name="website" value="{{ $user->website }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">About Me</label>
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                <textarea class="form-control" name="about_me" rows="6">{{ $user->about_me }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-success my-1">Update</button>
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