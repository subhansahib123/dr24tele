@extends('doctor_panel.layout.master')

@section('content')


<div class="main-content app-content mt-3  ">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card mt-2">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Specialization's</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Add Specializations</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('doctorSpecialized')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="specialization">Specialization Options</label>
                                        <select class="form-control js-example-basic-multiple" name="specialization_id[]" multiple="multiple" id="specialization">
                                            <option value="">Select</option>
                                            @if($specializations)
                                            @foreach ($specializations as $specialization)
                                            <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group text-end">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary">Add</button>


                                    <a href="{{route('doctor.dashboard')}}" class="btn btn-info">Back</a>

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