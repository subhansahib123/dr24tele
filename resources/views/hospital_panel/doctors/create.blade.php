@extends('hospital_panel.layout.master');

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
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{route('doctor.created')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create Doctor</li>
                                    </ol>
                                </div>
                                <div class="col-6">
                                    <span class="card-title"><strong>  Doctor Details</strong></span>
                                </div>

                                <div class="col-1">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="Name">First Name *</label>
                                            <input type="text" class="form-control" onkeydown="return /[a-z]/i.test(event.key)" name="name" value="" id="Name" placeholder="Enter First Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="middleName">Last Name</label>
                                            <input class="form-control" id="middleName" placeholder="Enter Last Name" onkeydown="return /[a-z]/i.test(event.key)" name="middlename" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address *</label>
                                            <input type="email" class="form-control" name="email" value="" id="exampleInputEmail1"  placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="row ">
                                                <label for="exampleInputnumber">Contact Number *</label>
                                            </div>
                                            <div class="row ">
                                                <input type="text" id="txtPhone" name="" onkeydown="return /[0-9]/i.test(event.key)" class="form-control">
                                                <input type="hidden" class="form-control" id="phoneNumber">
                                            </div>



                                        </div>
                                    </div>
                                    <input type="hidden" name="uuid" value="{{$uuid}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="Birth">Date of Birth</label>
                                            <input type="date" class="form-control" id="Birth" placeholder="Date of Birth" name="dateOfBirth" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-select" name="gender_code" id="gender">
                                                <option value="">
                                                    Select Gender
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
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="Birth">Profile Image <strong> 300*350</strong> *</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end ">
                                <button type="submit" class="btn btn-primary my-1">Create</button>
                                <span><a href="{{route('hospital.dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>
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