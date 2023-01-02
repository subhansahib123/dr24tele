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
                                    <li class="breadcrumb-item active" aria-current="page">Management</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Mapping Management</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form action="{{route('role.mapped')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1">
                                        <label for="user">User</label>
                                        <input class="form-control" type="text" disabled value="{{$user->name}}">
                                        <input type="hidden" value="{{$user->uuid}}" name="user" id="user">
                                    </div>
                                    <input type="hidden" name="orgId" value="{{$orgId}}">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12  my-1">
                                        <label for="role">Roles</label>
                                        <select class="form-control" value="{{old('role')}}" name="role" id="role">
                                        <option value='' selected>Select Role</option>
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

