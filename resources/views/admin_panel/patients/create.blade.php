@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Create Patient</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Patient</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                    @include('admin_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{route('store.patients')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Create Patient </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h3>User</h3>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">

                                            <label for="Username">Username</label>
                                            <input type="text" class="form-control" name="username" value="" id="Username" placeholder="Username">
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
                                            <input type="text" class="form-control" name="name" value="" id="Name" placeholder="Enter Name">
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
                                            <br>

                                            <input type="text" id="txtPhone" name="" class="form-control">
                                               <input type="hidden" class="form-control" id="phoneNumber" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Birth">Date of Birth</label>
                                            <input type="date" class="form-control" id="Birth" placeholder="Date of Birth" name="dateOfBirth" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gender">Gender</label>
                                            <select class="form-select" name="gender_code" id="gender">
                                                <option value="">
                                                    Select
                                                </option>
                                                <option value="F">
                                                    Female
                                                </option>
                                                <option value="M">
                                                    Male
                                                </option>
                                                <option value="IND">
                                                Indeterminate Sex
                                                </option>
                                                <option value="TRA">
                                                Transsexual
                                                </option>
                                                <option value="O">
                                                Others
                                                </option>
                                            </select>

                                            <!-- <input type="text" class="form-control" name="" id="gender" value=""> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary my-1">Create</button>
                                <span><a href="{{route('dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>

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
