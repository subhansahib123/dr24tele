@extends('hospital_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Schedule</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Schedule List
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">

                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <table class="table text-nowrap text-md-nowrap table-striped mb-0" id="datatable">
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
                                        @foreach ($schedules as $schedule)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $schedule->status ? 'Enabled' : 'Disabled' }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->start)) }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->end)) }}</td>
                                            <td>{{ $schedule->comment }}</td>
                                            <td>{{ $schedule->doctor->user->username }}</td>
                                            {{-- <td>{{$schedule->doctor->department->name}}</td> --}}
                                            <td>
                                                <a href="{{ route('edit.schedule', $schedule->id) }}" class="btn btn-primary btn-sm" data-toggle="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('delete.schedule', $schedule->id) }}" class="btn btn-danger btn-sm" data-toggle="Delete"><i class="fa fa-trash"></i></a>

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
@push('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush