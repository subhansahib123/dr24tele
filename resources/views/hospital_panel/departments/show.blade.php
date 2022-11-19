@extends('hospital_panel.layout.master');

@section('content')


    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Departments List</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Departments List</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-6">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-3">
                                    <a href="{{ route('createHospital.department') }}" class="btn btn-sm btn-info">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('admin_panel.frontend.includes.messages')
                                {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                <div class="table-responsive">
                                    <div class="bg-light p-5">
                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                            <th scope="col">Sr#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col" class="text-end">Action</th>
                                            </thead>
                                            @foreach($departments->childlist as $department)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$department->name}}</td>
                                                    <td class="text-end">
                                                        <a href="{{route('updateHospital.department',['uuid'=>$department->uuid])}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-edit"></i></button></a>
                                                        <a href="{{route('hospitalDoctors.list',['uuid'=>$department->uuid])}}"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Doctors"><i class="fa fa-user"></i></button></a>
                                                        @if($department->status == 'Enabled')
                                                            <a href="{{route('delete.organisation',['uuid'=>$department->uuid])}}"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-eye-slash"></i></button></a>
                                                        @else
                                                            <a href="{{route('delete.organisation',['uuid'=>$department->uuid])}}"><button class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Active"><i class="fa fa-eye"></i></button></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        <!-- <a href="" class="btn btn-info">Edit</a> -->
                                        <a href="{{route('hospital.dashboard')}}" class="btn btn-info">Back</a>
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
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endpush
