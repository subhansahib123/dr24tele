@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Update User</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                        <form action="{{route('userUpdated')}}" method="POST">
                            @csrf
                            <!-- <div class="card-header">
                                <h3 class="card-title">Update</h3>
                            </div> -->
                            <div class="card-body">
                                <div class="row">
                                    <h3>User</h3>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">

                                            <label for="Username">Username</label>
                                            <input type="text" class="form-control" value="{{$username}}" name="username" value="" id="Username" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="Password">Password</label>
                                            <input type="text" class="form-control" name="password" id="Password" placeholder="Password">
                                        </div>
                                    </div>
                                    <h3>Person</h3>
                                    
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="Name">Name</label>
                                            <input type="hidden" value="{{$uuid}}" name="userUuid">
                                            <input type="text" class="form-control" value="{{$name}}" name="name" value="" id="Name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="middleName">Middle Name</label>
                                            <input class="form-control" id="middleName" placeholder="Enter Middle Name" name="middlename" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" value="" id="exampleInputEmail1" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputnumber">Contact Number</label>
                                            <input type="number" class="form-control" name="phoneNumber" value="" id="exampleInputnumber" placeholder="Contact number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Birth">Date of Birth</label>
                                            <input type="date" class="form-control" id="Birth" placeholder="Date of Birth" name="dateOfBirth" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="gender">Gender</label>
                                            <select name="gender_code" id="gender">
                                                <option value="F">
                                                    Female
                                                </option>
                                                <option value="M">
                                                    Male
                                                </option>
                                            </select>

                                            <!-- <input type="text" class="form-control" name="" id="gender" value=""> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary my-1">Update</button>
                                <span><a href="{{route('dashboard')}}" class="btn btn-info  ">Cancel</a></span>                             
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