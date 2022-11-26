@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card mt-5">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Management</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Updating Role</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('role.updated')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" value="{{$uuid}}" name="uuid">
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 ">
                                            <div class="row">
                                                <label  for="user">Name</label>
                                            </div>
                                            <div class="row">
                                                <input class="form-control" type="text" disabled value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$user->uuid}}" name="user" id="user">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label for="role">Roles</label>
                                            <select class="form-control" value="{{old('role')}}" name="role" id="role">
                                            @if($roles)
                                            @foreach ($roles as $role)
                                            @if($role->name=='Practitioner')
                                            <option style="display:none" value=""></option>
                                            @elseif($role->name!='Practitioner')
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group text-end">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary">Update</button>


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