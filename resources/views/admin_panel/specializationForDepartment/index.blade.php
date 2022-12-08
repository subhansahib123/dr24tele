@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-5">
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
                                    <li class="breadcrumb-item active" aria-current="page">Department Specializations</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                 Specializations List
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('create.departmentSpecialization')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    <div class="mt-4">
                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                                <th scope="col" width="1%">Action</th>
                                            </thead>
                                            @if(isset($specializations))
                                            @foreach($specializations as $specialization)
                                            <tr >
                                                <td>
                                                    {{$specialization->name}}
                                                </td>
                                                <td>
                                                    <a href="{{route('update.departmentSpecialization',[$specialization->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{route('delete.departmentSpecialization',[$specialization->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr >
                                            @endforeach
                                            @else
                                            <tr style="line-height:10px ;">
                                                <td>
                                                    No Record
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
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