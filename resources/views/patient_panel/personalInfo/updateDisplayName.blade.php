@extends('patient_panel.layout.master')

@section('content')


<div class="main-content app-content mt-3">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

        @include('admin_panel.frontend.includes.messages')

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <form action="{{ route('display.NameUpdated') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <div class="col-5">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Display Name</li>
                                    </ol>
                                </div>
                                <div class="col-4">
                                    <span class="card-title"><strong>Update Name</strong></span>
                                </div>

                                <div class="col-3 text-end">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">

                                            <label for="currentPassword"> Name</label>
                                            <input type="text" name="name" onkeydown="return /[a-z\ ]/i.test(event.key)" required class="form-control" value="{{$name}}" id="currentPassword">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-success my-1">Update</button>
                                <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!--CONTAINER CLOSED -->

    </div>
</div>
@endsection