@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Doctor Specializations list</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Specializations</li>
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
                                <a href="{{route('hospital.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('admin_panel.frontend.includes.messages')
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatable">
                                    <thead>
                                        <th scope="col">Sr#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </thead>
                                    @foreach($specializations as $specialization)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$specialization->name}}</td>
                                        <td class="text-end">
                                            <a href="{{route('update.specialization',[$specialization->id])}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-edit"></i></button></a>
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