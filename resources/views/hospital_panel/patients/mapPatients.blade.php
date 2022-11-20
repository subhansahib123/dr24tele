@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map Patient Under Organization </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map Patient </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('patientMapped')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user">Patient</label>
                            <select class="form-control" value="{{old('user')}}" name="user" id="user">
                                <option value="">Select</option>
                                @if($users)
                                    @foreach ($users as $user)
                                        <option value="{{$user->PersonUuid}}">{{$user->username}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" value="{{$orgId}}" name="organisation" >
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <!-- <label for="role">Roles</label> -->
                            <button type="submit" class="btn btn-primary">Map</button>
                            <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
@endsection
