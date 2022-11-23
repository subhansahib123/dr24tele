@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map Doctor </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map Doctor </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('doctor.mapped')}}" method="POST">
                @csrf
                <div class="row">

                    <input type="hidden" value="{{$userUuid}}" name="user">
                    <input type="hidden" value="{{$organization->uuid}}" name="organization">

                    <div class="form-group col-lg-6 col-md-6 col-sm-12" id="depart_p">
                        <label for="organizations">Departments</label>
                        <select class="form-control" name="department" id="departments">
                            <option value="">Select</option>
                            @if($departments)
                            @foreach($departments as $department)
                            <option value="{{$department->uuid}}">{{$department->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Map</button>


                    <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection