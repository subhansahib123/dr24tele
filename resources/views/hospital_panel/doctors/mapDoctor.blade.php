@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            @include('admin_panel.frontend.includes.messages')
            <div class="row">
                <div class="form-group">
                    @include('admin_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{route('doctor.mapped')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Mapping</li>
                                    </ol>
                                </div>
                                <div class="col-6">
                                    <span class="card-title"><strong> Map Doctor </strong></span>
                                </div>

                                <div class="col-1">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" value="{{$userUuid}}" name="user">
                                    <input type="hidden" value="{{$organization->uuid}}" name="organization">

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12" id="depart_p">
                                        <label for="organizations">Departments</label>
                                        <select class="form-control" name="department" id="departments">
                                            <option value="">Select</option>
                                            @if($departments)
                                            @foreach($departments as $department)
                                            <option value="{{$department->uuid}}">{{$department->display_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
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

                            </div>
                            <div class="card-footer text-end ">
                                <button type="submit" class="btn btn-primary my-1">Map</button>
                                <span><a href="{{route('hospital.dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection