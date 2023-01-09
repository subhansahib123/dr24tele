@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

        @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Department Specialization</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Update Specializations</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('department.specializationUpdated')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$specialization->id}}" name="id">
                                <div class=" row mb-4">
                                    <label for="newName" class="col-md-3 form-label"> New Name *</label>
                                    <input type="text" class="form-control" value="{{$specialization->name}}" name="newName" onkeydown="return /[a-z\ ]/i.test(event.key)" id="newName" placeholder="Enter Name">
                                    @if ($errors->has('newName'))
                                    <span class="text-danger text-left">{{ $errors->first('newName') }}</span>
                                    @endif
                                </div>
                                <div class="form-group px-0 text-end card-footer">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>

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