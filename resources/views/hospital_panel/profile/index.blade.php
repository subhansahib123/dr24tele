@extends('admin_panel.layout.master')

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
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Password</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.changePassword') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Current Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" required type="password"
                                            name="current-password" value="{{ old('current-password') }}"
                                            placeholder="Current Password" autocomplete="current-password">
                                    </div>
                                    @if ($errors->has('current-password'))
                                        <span
                                            class="text-danger text-left">{{ $errors->first('current-password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">New Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" required type="password"
                                            value="{{ old('new-password') }}" name="new-password" placeholder="New Password"
                                            autocomplete="new-password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger text-left">{{ $errors->first('new-password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 form-control" required type="password"
                                            value="{{ old('password_confirmation') }}" name="new-password_confirmation"
                                            placeholder="Confirm Password" autocomplete="new-password">
                                    </div>
                                    @if ($errors->has('new-password_confirmation'))
                                        <span
                                            class="text-danger text-left">{{ $errors->first('new-password_confirmation') }}</span>
                                    @endif
                                </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type='submit' class="btn btn-primary">Update</button>
                            <a href="javascript:void(0)" class="btn btn-danger">Cancel</a>
                        </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Profile Image</div>
                        </div>
                        <form action="{{ route('admin.updateProfileImage') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="text-center chat-image mb-5">
                                    @if ($user->image)
                                    <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                       <img src="{{$user->image}}"  alt="">
                                    </div>
                                    @else
                                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                                            <a class="" href="profile.html"><img alt="avatar"
                                                    src="../assets/images/users/7.jpg" class="brround"></a>
                                        </div>
                                    @endif

                                    {{-- <div class="main-chat-msg-name">
                                <a href="profile.html">
                                    <h5 class="mb-1 text-dark fw-semibold">Percy Kewshun</h5>
                                </a>
                                <p class="text-muted mt-0 mb-0 pt-0 fs-13">Web Designer</p>
                            </div> --}}
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Change Profile </label>

                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        {{-- <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                    </a> --}}
                                        <input class="input100 form-control" type="file" required name="picture"
                                            autocomplete="current-password">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                {{-- <a href="javascript:void(0)" class="btn btn-danger">Cancel</a> --}}
                            </div>
                        </form>
                    </div>
                    {{-- <div class="card panel-theme">
                        <div class="card-header">
                            <div class="float-start">
                                <h3 class="card-title">Contact</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="card-body no-padding">
                            <ul class="list-group no-margin">
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fe fe-mail"></i></a>
                                    </div>
                                    <a href="javascript:void(0)" class="my-auto">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fe fe-globe"></i></a>
                                    </div>
                                    <a href="javascript:void(0)" class="my-auto">{{ $user->website }}</a>
                                </li>
                                <li class="list-group-item d-flex ps-3">
                                    <div class="social social-profile-buttons me-2">
                                        <a class="social-icon text-primary" href="javascript:void(0)"><i
                                                class="fe fe-phone"></i></a>
                                    </div>
                                    <a href="javascript:void(0)" class="my-auto">{{ $user->phone_number }}</a>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <form action="{{ route('admin.updateProfile') }}" method="POST">
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
                    <div class="row">

                        {{-- <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Account Information</div>
                                </div>
                                <div class="card-body">
                                    <ul class="task-list">
                                        <li class="d-sm-flex">
                                            <div>
                                                <i class="task-icon bg-primary"></i>
                                                <h6 class="fw-semibold">Account Status<span
                                                        class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span>
                                                </h6>
                                                <p class="text-muted fs-12">Adam Berry finished task on<a
                                                        href="javascript:void(0)" class="fw-semibold"> Project
                                                        Management</a></p>
                                            </div>

                                        </li>
                                        <li class="d-sm-flex">
                                            <div>
                                                <i class="task-icon bg-primary"></i>
                                                <h6 class="fw-semibold">Account Type<span
                                                        class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span>
                                                </h6>
                                                <p class="text-muted fs-12">Adam Berry finished task on<a
                                                        href="javascript:void(0)" class="fw-semibold"> Project
                                                        Management</a></p>
                                            </div>

                                        </li>
                                        <li class="d-sm-flex">
                                            <div>
                                                <i class="task-icon bg-primary"></i>
                                                <h6 class="fw-semibold">Api Key<span
                                                        class="text-muted fs-11 mx-2 fw-normal">09 July 2021</span>
                                                </h6>
                                                <p class="text-muted fs-12">Adam Berry finished task on<a
                                                        href="javascript:void(0)" class="fw-semibold"> Project
                                                        Management</a></p>
                                            </div>

                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="card-title">Delete Account</div>
                        </div>
                        {{-- <div class="card-body">
                            <p>Its Advisable for you to request your data to be sent to your Email.</p>
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input" name="example-checkbox1"
                                    value="option1" checked="">
                                <span class="custom-control-label">Yes, Send my data to my Email.</span>
                            </label>
                        </div> --}}
                        {{-- <div class="card-footer text-end">
                            <a href="{{route('user.deactivate.account')}}" class="btn btn-primary my-1">Deactivate</a>
                            <a href="{{route('user.delete.account')}}" class="btn btn-danger my-1">Delete Account</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!--CONTAINER CLOSED -->

    </div>
</div>
@endsection
