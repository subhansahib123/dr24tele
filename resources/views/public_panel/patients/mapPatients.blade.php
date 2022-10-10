@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Map User by Organization </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Map User </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            <form action="{{route('patient.mapped')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user">User</label>
                    <select class="form-control" value="{{old('user')}}" name="user" id="user">
                        @if($users)
                        @foreach ($users as $user)
                        <option value="{{$user->PersonId}}">{{$user->username}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="role">Organization</label>
                    <select class="form-control" value="{{old('role')}}" name="organisation" id="role">
                        @if($organizations)
                        @foreach ($organizations as $organization)
                        <option value="{{$organization->uuid}}">{{$organization->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Map User Organization</button>


                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection