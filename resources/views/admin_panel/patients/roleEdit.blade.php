@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map User by Role </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map User </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('role.mapped')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user">User</label>
                    <select class="form-control" value="{{old('user')}}" name="user" id="user">
                        @if($users)
                        @foreach ($users as $user)
                        <option value="{{$user->uuid}}">{{$user->username}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
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
                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Map User Role</button>


                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection