@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-3">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Department</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Department Details</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('newDepartment.created')}}" method="POST">
                                @csrf
                                <div class=" row  mb-1">
                                    <label for="displayname" class="col-md-3 form-label"> Display Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('displayname')}}" name="displayname" id="displayname" placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1">
                                    <label for="username" class="col-md-3 form-label"> User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="username" placeholder="Username">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class=" row  mb-1">
                                    <label for="inputEmail3" class="col-md-3 form-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class=" row  mb-1">
                                    <label for="specialization" class="col-md-3 form-label"> Select Specialization</label>
                                    <div class="col-md-9">
                                        <select class="form-control js-example-basic-multiple" name="specialization_id[]" multiple="multiple id=" specialization">
                                            @if($specializations)
                                            @foreach($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class=" row  mb-1">
                                    <label for="country" class="col-md-3 form-label"> Select Status </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{old("status")=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled    " {{old("status")=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row  mb-1">
                                    <label for="organization" class="col-md-3 form-label">Organizations</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="organization" id="organization">
                                            <option value="">Select</option>
                                            @if($organizations)
                                            @foreach ($organizations as $organization)
                                            <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class=" row  mb-1">
                                    <label for="image" class="col-md-3 form-label">Picture</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image">
                                    </div>
                                </div>
                                <input type="hidden" name="level" value="Department">
                                <div class="mb-0 mt-4 row text-end">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Create</button>

                                        <span><a href="{{route('dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>
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



@endsection