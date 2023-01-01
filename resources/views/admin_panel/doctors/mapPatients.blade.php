@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map Doctor Under Department </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map Doctor </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('patientMapped')}}" method="POST">
                @csrf
                <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="form-control" for="user">Doctor Name</label>
                            <input class="form-control" type="text" disabled value="{{$user->username}}">
                            <input type="hidden" value="{{$user->id}}" name="userId">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="role"> Hospital</label>
                            <select class="form-control" value="{{old('role')}}" name="organisation" id="role">
                                <option value="">Select</option>
                                @if($organizations)
                                @foreach ($organizations as $organization)
                                <option value="{{$organization->uuid}}">{{$organization->name}}</option>
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