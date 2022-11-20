@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Add Role </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Role </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('userUserRole.updated')}}" method="POST">
                @csrf
                <input type="hidden" value="{{$user->uuid}}" name="user" id="user">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <div class="row">
                                <label class="form-control" for="user">User</label>
                            </div>
                            <div class="row">
                                <input class="form-control" type="text" disabled value="{{$user->name}}" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="role">Roles</label>
                            <select class="form-control" value="{{old('role')}}" name="role" id="role">
                                @if($roles)
                                @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Add </button>
                    <a href="{{route('mapHospital.user')}}" class="btn btn-info">Cancel</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection