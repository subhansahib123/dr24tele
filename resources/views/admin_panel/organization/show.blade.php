@extends('admin_panel.layout.master')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">
            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Organization</h1>
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
                            <div class="card-header">
                                <span class="card-title">Organizations List</span>
                                {{-- <span class="card-title "><a href="{{route('roles.create')}}"> Add New Permission</a></span> --}}
                            </div>
                            <div class="card-body">
                                @include('admin_panel.frontend.includes.messages')
                                {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                <div class="table-responsive">
                                    <div class="bg-light p-4 rounded">
                                        @foreach($organizations as $organization)
                                            <h1>Tenant Id: {{ (isset($organization->tenantid)?$organization->tenantid :'')}}, Name: {{ (isset($organization->name)?$organization->name:'') }}, Status: {{(isset($organization->status)?$organization->status:'')}}, Level: {{ (isset($organization->level)?$organization->level:'') }} </h1>
                                            <div class="lead">
                                            </div>
                                            <div class="container mt-4">
                                                <h3>Parent</h3>
                                                <table class="table table-striped">
                                                    <thead>
                                                    <th scope="col" width="20%">Tenant id</th>
                                                    <th scope="col" width="1%">Name</th>
                                                    <th scope="col" width="1%">UUid</th>
                                                    <th scope="col" width="1%">Status</th>
                                                    <th scope="col" width="1%">Level</th>
                                                    </thead>
                                                    @if(isset($organization->pparent))
                                                        <tr>
                                                            <td>{{(isset($organization->pparent->tenantid)?$organization->pparent->tenantid:'')}}</td>
                                                            <td>{{(isset($organization->pparent->name)?$organization->pparent->name:'')}}</td>
                                                            <td>{{(isset($organization->pparent->uuid)?$organization->pparent->uuid:'')}}</td>
                                                            <td>{{(isset($organization->pparent->status)?$organization->pparent->status:'')}}</td>
                                                            <td>{{(isset($organization->pparent->level)?$organization->pparent->level:'')}}</td>
                                                        </tr>
                                                        <table>
                                                            <thead>
                                                            <th scope="col" width="20%">Tenant id</th>
                                                            <th scope="col" width="1%">Name</th>
                                                            <th scope="col" width="1%">UUid</th>
                                                            <th scope="col" width="1%">Status</th>
                                                            <th scope="col" width="1%">Level</th>
                                                            </thead>
                                                            @if(isset($organization->pparent->pparent))
                                                                <tr>
                                                                    <td>{{(isset($organization->pparent->pparent->tenantid)?$organization->pparent->pparent->tenantid:'')}}</td>
                                                                    <td>{{(isset($organization->pparent->pparent->name)?$organization->pparent->pparent->name:'')}}</td>
                                                                    <td>{{(isset($organization->pparent->pparent->uuid)?$organization->pparent->pparent->uuid:'')}}</td>
                                                                    <td>{{(isset($organization->pparent->pparent->status)?$organization->pparent->pparent->status:'')}}</td>
                                                                    <td>{{(isset($organization->pparent->pparent->level)?$organization->pparent->pparent->level:'')}}</td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    @endif
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-4">
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-default">Back</a>
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

