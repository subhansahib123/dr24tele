@extends('patient_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Family Members</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Members List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            @include('admin_panel.frontend.includes.messages')
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    <div class="container mt-4">
                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                                <th scope="col" width="1%">Relation</th>
                                               <th scope="col" width="1%"></th>
                                               <th scope="col" width="1%"></th>
                                            </thead>
                                            @if(isset($all_members))
                                            @foreach($all_members as $all_member)
                                            <tr>
                                                <td>
                                                    {{$all_member->name}}
                                                </td>
                                                <td>
                                                    {{$all_member->relation}}
                                                </td>
                                                
                                                <td>
                                                    <a href="{{route('updateMembers',[$all_member->id])}}" class="btn btn-primary">Update</a>
                                                </td>
                                                <td>
                                                    <a href="{{route('deleteMembers',[$all_member->id])}}" class="btn btn-danger">delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td>
                                                    No Record
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>
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
