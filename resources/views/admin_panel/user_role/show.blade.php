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

                                    <div class="lead">

                                    </div>

                                    <div class="container mt-4">
                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                                <th scope="col" width="20%">Role Name</th>
                                                <th scope="col" width="1%">Created at</th>
                                            </thead>
                                            @foreach($roles as $role)
                                            <tr>
                                                <td>{{$role->name}}</td>

                                                <td>

                                                    {{$role->created_at}}

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
            </div>
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection