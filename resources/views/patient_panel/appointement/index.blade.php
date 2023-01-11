@extends('patient_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            @include('patient_panel.frontend.includes.messages')
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Appointment's</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Appointments List</strong></span>
                            </div>

                            <div class="col-1">
                                <a href="{{route('patient.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th scope="col">Sr</th>
                                            <th scope="col">Start</th>
                                            <th scope="col">End</th>
                                            <th scope="col">Doctor</th>
                                             <th scope="col">Call Status</th>
                                            <th scope="col">Details</th>

                                        </thead>


                                        @foreach($appointements as $schedule)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date(' H:i A', strtotime($schedule->start)) }}</td>
                                            <td>{{ date(' H:i A', strtotime($schedule->end)) }}</td>
                                            <td>{{ $schedule->doctor->user->name }}</td>
                                            @if($schedule->Call_Status == 1)
                                            <td><a href="{{$schedule->appointment_link}}" class="btn btn-primary ">Call</a></td>
                                            @else
                                            <td><a href="#" class="btn btn-danger">Wait</a></td>
                                            @endif
                                            <td><a href="{{route('appointmentDetails',[$schedule->id])}}" class="btn btn-info">Check</a></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
@endsection
