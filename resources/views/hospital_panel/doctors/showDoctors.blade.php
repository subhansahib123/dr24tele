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
                                    <li class="breadcrumb-item active" aria-current="page">Department Doctors</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong> Doctors List</strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('create.doctor',[$uuid])}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('hospital.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>

                            </div>
                        </div>

                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <th scope="col">Sr#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </thead>
                                    @foreach($doctors as $doctor)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$doctor->user->name}}</td>
                                        <td class="text-end">
                                            <a href="{{route('hospital.doctor.delete',[$doctor->user->uuid])}}"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
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

        <!-- CONTAINER CLOSED -->

    </div>
</div>


@endsection
