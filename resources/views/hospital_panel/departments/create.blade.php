@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Create Department</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Department</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="">  Department Details
                            </h4>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('hospitalDepartment.created')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('displayname')}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="username" class="col-md-3 form-label"> User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control"  name="email" placeholder="Email" >
                                    </div>
                                </div>
                                
                                <div class=" row mb-4">
                                    <label for="country" class="col-md-3 form-label"> Select Status </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{old("status")=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled    " {{old("status")=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0 mt-4 row justify-content-end">
                                    <div class="col">

                                        <button class="btn btn-primary" type="submit">Create</button>
                                        <span><a href="{{route('hospital.dashboard')}}" class="btn btn-info  ">Cancel</a></span>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>