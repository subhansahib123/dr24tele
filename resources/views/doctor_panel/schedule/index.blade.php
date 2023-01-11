@extends('doctor_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            @include('doctor_panel.frontend.includes.messages')
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Schedules</li>
                                </ol>
                            </div>
                            <div class="col-3">
                                <span class="card-title"><strong> Schedules List</strong></span>
                            </div>

                            <div class="col-4 text-end">
                                <a href="{{route('create.schedule.doctor')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('doctor.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th >ID</th>
                                            <th >Status</th>
                                            <th >Start </th>
                                            <th >End</th>
                                            <th >Action</th>
                                        </thead>


                                        @foreach($schedules as $schedule)
                                        <tr>

                                            <td >{{ $loop->index + 1 }}</td>
                                            <td>{{ $schedule->status ? 'Enabled' : 'Disabled' }}</td>
                                            <td>{{ date('h:i A', strtotime($schedule->start)) }}</td>
                                            <td>{{ date('h:i A', strtotime($schedule->end)) }}</td>
                                            <td class="text-end">
                                                <a href="{{route('delete.schedule.doctor', $schedule->id)}}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
