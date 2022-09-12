@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Roles Permissions</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Roles Permissions List</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-6">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="card-title">Roles Permissions List</span>
                                        {{-- <span class="card-title "><a href="{{route('roles.create')}}"> Add New Permission</a></span> --}}
                                    </div>
                                    <div class="card-body">

                                        @include('admin_panel.frontend.includes.messages')
                                        {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                        <div class="table-responsive">
                                            <div class="bg-light p-4 rounded">
                                                <h1>{{ ucfirst($role->name) }} Role</h1>
                                                <div class="lead">

                                                </div>

                                                <div class="container mt-4">

                                                    <h3>Assigned permissions</h3>

                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th scope="col" width="20%">Name</th>
                                                            <th scope="col" width="1%">Guard</th>
                                                        </thead>

                                                        @foreach($rolePermissions as $permission)
                                                            <tr>
                                                                <td>{{ $permission->name }}</td>
                                                                <td>{{ $permission->guard_name }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="mt-4">
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
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

