@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">
                    Add Your Specialization's                    
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
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>
                </div>
            </form>
            

        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection