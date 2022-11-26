@extends('doctor_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('doctor_panel.frontend.includes.messages')


            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Appointments</li>
                                </ol>
                            </div>
                            <div class="col-3">
                                <span class="card-title"><strong> Appointments List</strong></span>
                            </div>

                            <div class="col-4 text-end">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Start </th>
                                                <th>End</th>
                                                <th>Comments</th>
                                                <th>Patient</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>


                                        @foreach($appointements as $schedule)
                                        <tr>

                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->start)) }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->end)) }}</td>
                                            <td>{{ $schedule->comment }}</td>
                                            <td>{{ $schedule->patient->user->username }}</td>
                                            <td>

                                                <button type="button" onclick="send_notification(`{{$schedule->patient->user->id}}`,'Appointment No.{{$schedule->id}}','please join call now',true,`{{$schedule->doctor->user->id}}`)" class="btn btn-success btn-sm">Call</button>


                                            </td>



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