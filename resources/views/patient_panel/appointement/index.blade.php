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
                                <span class="card-title"><strong>  Appointments List</strong></span>
                            </div>

                            <div class="col-1">
                            <a href="{{route('patient.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Start </th>
                                            <th>End</th>
                                            <th>Comments</th>
                                            <th>Doctor</th>
                                            {{-- <th>Department</th> --}}
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointements as $schedule)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            {{-- <td>{{ $schedule->status ? 'Enabled' : 'Disabled' }}</td> --}}
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->start)) }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->end)) }}</td>
                                            <td>{{ $schedule->comment }}</td>
                                            <td>{{ $schedule->doctor->user->username }}</td>
                                            {{-- <td>{{$schedule->doctor->department->name}}</td> --}}
                                            {{-- <td>

                                                        <a href="{{ route('delete.schedule.doctor', $schedule->id) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                            <a href="{{ route('edit.schedule.doctor', $schedule->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            </td> --}}
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                
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