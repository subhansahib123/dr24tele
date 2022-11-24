@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Organizations List</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Organizations List</li>
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
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                                <a href="{{route('create.organization')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>

                            
                            <div class="col-7 align-self-center"></div>
               
                            <div class="col-2 align-self-center">

                            </div>
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th scope="col">Name</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </thead>
                                        @foreach($organizations->childlist as $organization)
                                        <tr>
                                            <td>
                                                {{$organization->name}}
                                            </td>
                                            <td class="text-end">
                                                <a href="{{route('single.organization',['uuid'=>$organization->uuid])}}"><button class="btn btn-info" title="Update"><i class="fa fa-edit"></i></button></a>

                                                <a href="{{route('users.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-primary" title="Users"><i class="fa fa-users"></i></button></a>

                                                <a href="{{route('patients.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-warning" title="Patients"><i class="fa fa-user-plus"></i></button></a>

                                                <a href="{{route('departments.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-success" title="Departments"><i class="fa fa-building"></i></button></a>

                                            @if($organization->status == 'Enabled')

                                                <a href="{{route('delete.organisation',['uuid'=>$organization->uuid])}}"><button class="btn btn-danger" title="Inactive"><i class="fa fa-eye-slash"></i></button></a>

                                            @else
                                                <a href="{{route('delete.organisation',['uuid'=>$organization->uuid])}}"><button class="btn btn-info" title="Active"><i class="fa fa-eye"></i></button></a>

                                            </td>

                                            @endif
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
@push('js')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endpush
