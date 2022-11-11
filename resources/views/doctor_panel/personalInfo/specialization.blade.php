@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">
                    @if($doctor->specialization_id==0)
                    Doctor's Specialization
                    @else
                    Update Specialization
                    @endif
                </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Specialization Page </li>
                    </ol>
                </div>
            </div>
            @include('admin_panel.frontend.includes.messages')
            <!-- PAGE-HEADER END -->
            @if($doctor->specialization_id==0)
            <form action="{{route('doctorSpecialized')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="specialization">Specialization Options</label>
                    <select class="form-control" value="{{old('specializations')}}" name="specialization" id="specialization">
                        <option value="">Select</option>
                        @if($specializations)
                        @foreach ($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                </div>
            </form>
            @else
            <!-- PAGE-HEADER END -->
            <form action="{{route('doctor.updateSpecialization')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="specialization">Specialization Options</label>
                    <select class="form-control" value="{{old('specializations')}}" name="specialization" id="specialization">
                        <option value="">Select</option>
                        @if($specializations)
                        @foreach ($specializations as $specialization)
                        <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <!-- <label for="role">Roles</label> -->
                    <button type="submit" class="btn btn-success">Update</button>


                    <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>

                </div>
            </form>
            @endif

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection