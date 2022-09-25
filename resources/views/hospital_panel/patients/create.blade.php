@extends('hospital_panel.layout.master');

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
                <div class="col-xl-8">
                    <div class="card">
                        <form action="{{route('storeHospital.patients')}}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Create </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <h3>Person</h3>
                                    <div class="form-group">
                                        <label for="userUuid">User</label>
                                        <select class="form-control" value="{{old('user')}}" name="userUuid" id="userUuid">
                                            @if($users)
                                            @foreach ($users as $user)
                                            <option value="{{$user->uuid}}">{{$user->username}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" name="orgId" value="{{$orgId}}">
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="Password">Password</label>
                                            <input type="text" class="form-control"  name="password" id="Password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="givenName">Name</label>
                                            <input type="text" class="form-control" value="{{old('givenName')}}" name="givenName" id="givenName" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="middleName">Middle Name</label>
                                            <input class="form-control" id="middleName" placeholder="Enter Middle Name" name="middleName" value="{{old('middleName')}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="prefix">Prefix</label>
                                            <select class="form-control" name="prefix" id="prefix" value="{{old('prefix')}}">
                                                <option value="">Select</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Sir">Sir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="phoneExt">Phone Ext</label>
                                            <input type="text" class="form-control" name="phoneExt" value="{{old('phoneExt')}}" id="phoneExt" placeholder="Phone Ext">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="postOffice">Post Office</label>
                                            <input type="text" class="form-control" name="postOffice" value="{{old('postOffice')}}" id="postOffice" placeholder="Post Office">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputnumber">Contact Number</label>
                                            <input type="number" class="form-control" name="phoneNumber" value="{{old('phoneNumber')}}" id="exampleInputnumber" placeholder="Contact number">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Birth">Date of Birth</label>
                                            <input type="date" class="form-control" id="Birth" value="{{old('dateOfBirth')}}" placeholder="Date of Birth" name="dateOfBirth" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gender">Gender</label>
                                            <select name="genderCode" value="{{old('genderCode')}}" id="gender">
                                                <option value="">Select</option>
                                                <option value="F">
                                                    Female
                                                </option>
                                                <option value="M">
                                                    Male
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="bloodGroup">Blood Group</label>
                                            <select class="form-control" name="bloodGroup" id="bloodGroup" value="{{old('bloodGroup')}}">
                                                <option value="">Select</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="O-">O-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="O-">O-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="maritalStatus">Marital Status</label>
                                            <select class="form-control" name="maritalStatus" id="maritalStatus" value="{{old('maritalStatus')}}">
                                                <option value="">Select</option>
                                                <option value="Married">Married</option>
                                                <option value="Un-Married">Un-Married</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="status">Status</label>
                                            <select name="status" value="{{old('status')}}" id="status">
                                                <option value="">Select</option>
                                                <option value="1">
                                                    Enable
                                                </option>
                                                <option value="0">
                                                    Disable
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success my-1">Create</button>
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