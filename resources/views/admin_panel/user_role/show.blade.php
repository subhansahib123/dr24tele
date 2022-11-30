@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Permissions List</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong>
                                        Roles List
                                    </strong></span>
                            </div>

                            <div class="col-1">
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4  ed">
                                    @foreach($roles as $role)
                                    <h1>{{ $role->authority }} Role</h1>
                                    <div class="lead">

                                    </div>

                                    <div class="container mt-4">

                                        <h3>Assigned permissions</h3>

                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                                <th scope="col" width="1%">Guard</th>
                                            </thead>

                                            @if($role->authPermissions)
                                            @foreach($role->authPermissions as $permission)
                                            <tr>
                                                <td>{{$permission->string}}</td>

                                                <td>

                                                    {{$permission->authCRUD}}

                                                </td>


                                            </tr>
                                            @endforeach
                                            @endif

                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 card-footer text-end">
                                    <!-- <a href="" class="btn btn-info">Edit</a> -->
                                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

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