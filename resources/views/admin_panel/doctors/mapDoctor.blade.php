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
                                        <label for="organizations">Organisation</label>
                                        <select class="form-control" name="organization" id="organization">
                                            @if($organizations)
                                            @foreach ($organizations as $organization)
                                            <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12" id="depart_p">
                                        <label for="organizations">Departments</label>
                                        <select class="form-control" name="department" id="departments">
                                            <option value='' selected>Select Department</option>
                                        </select>
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