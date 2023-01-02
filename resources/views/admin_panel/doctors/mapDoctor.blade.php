@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Doctor</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Doctor Mapping</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('doctorMapped')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$userUuid}}" name="user">
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <label for="department"> Departments</label>
                                        <select class="form-control" name="department" id="department">
                                            <option value='' selected>Select Department</option>

                                            @if($departments)
                                            @foreach ($departments as $department)
                                            <option value="{{$department->uuid}}">{{$department->display_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('department'))
                                        <span class="text-danger text-left">{{ $errors->first('department') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="specialization">Specialization</label>
                                            <select class="form-select js-example-basic-multiple" name="specialization_id[]" multiple="multiple" id=" specialization">
                                                @if($specializations)
                                                @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <!-- <input type="text" class="form-control" name="" id="gender" value=""> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" for="prefix">Pre-fix</label>
                                            <select class="form-select" name="prefix" id="prefix">
                                                <option value="">
                                                    Select
                                                </option>
                                                <option value="Dr">
                                                    Dr
                                                </option>
                                            </select>
                                            <!-- <input type="text" class="form-control" name="" id="gender" value=""> -->
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group text-end">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary">Map</button>


                                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

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
@section('foot_script')

@endsection