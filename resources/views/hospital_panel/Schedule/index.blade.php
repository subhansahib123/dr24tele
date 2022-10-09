@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Schedules</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Schedules List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">

                            <div class="row card-header">
                                <div class="col-md-3 p-3 px-3 text-center"><span class="card-title">Schedules List</span></div>
                                <div class="col-md-7 algn-self-center"></div>
                                <div class="col-md-2 p-3 px-3 text-center"><span class=""><a class="btn btn-primary" href="{{route('create.schedule')}}"><i class="angle fe fe-plus"></i> </a></span></div>

                            </div>
                            <div class="card-body">

                                @include('admin_panel.frontend.includes.messages')
                                {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                <div class="table-responsive">
                                    <table class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Start </th>
                                                <th>End</th>
                                                <th>Comments</th>
                                                <th>Doctor</th>
                                                {{-- <th>Department</th> --}}
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schedules as $schedule )
                                            <tr>
                                                <td>{{ $loop->index +1}}</td>
                                                <td>{{$schedule->status?'Enabled':'Disabled'}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($schedule->start));}}</td>
                                                <td>{{date('d-m-Y H:i A', strtotime($schedule->end));}}</td>
                                                <td>{{$schedule->comment}}</td>
                                                <td>{{$schedule->doctor->user->username}}</td>
                                                 {{-- <td>{{$schedule->doctor->department->name}}</td> --}}
                                                <td>

                                                    <a href="{{route('delete.schedule',$schedule->id)}}" class="btn btn-danger btn-sm">Delete</a>

                                                </td>
                                            </tr>

                                            @endforeach


                                        </tbody>
                                    </table>
                                    <div class="d-flex">

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
