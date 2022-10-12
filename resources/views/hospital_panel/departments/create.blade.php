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
                            <h4 class=""> New Department
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
                                    <label for="email" class="col-md-3 form-label"> Contact Person Designation</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('contactperson')}}" name="contactperson" id="contactperson" placeholder="Contact Person Designation" autocomplete="contactperson">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="phone" class="col-md-3 form-label"> Phone Number</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{old('phone')}}" name="phone" id="phone" placeholder="Phone Number" autocomplete="contactperson">
                                    </div>
                                    @if ($errors->has('contactperson'))
                                    <span class="text-danger text-left">{{ $errors->first('contactperson') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" autocomplete="username">
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="building" class="col-md-3 form-label">Building</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('building')}}" id="building" name="building" placeholder="Building Address">
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="district" class="col-md-3 form-label">District</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('district')}}" id="district" name="district" placeholder="District">
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="postalCode" class="col-md-3 form-label">Postal Code</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" value="{{old('postalCode')}}" id="postalCode" name="postalCode" placeholder="Postal Code">
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