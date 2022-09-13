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
                                        <span class="card-title">Profession Permissions List</span>
                                        {{-- <span class="card-title "><a href="{{route('roles.create')}}"> Add New Permission</a></span> --}}
                                    </div>
                                    <div class="card-body">

                                        @include('admin_panel.frontend.includes.messages')
                                        {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                                        <div class="table-responsive">
                                            <div class="bg-light p-4 rounded">
                                            @foreach($professions as $profession)
                                            <h1>{{ $profession->profession }} </h1>
                                                <div class="lead">

                                                </div>

                                                <div class="container mt-4">

                                                    <h3>Assigned permissions</h3>

                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th scope="col" width="20%">Name</th>
                                                            <th scope="col" width="1%">Guard</th>
                                                        </thead>

                                                        @if($profession->optcrud)
                                                                @foreach($profession->optcrud as $permission)
                                                            <tr>
                                                               
                                                                <td>

                                                                {{$permission->opt}}


                                                                </td>
                                                                <td>
                                                                    
                                                                {{$permission->authCrud}} 
                                                                </td>
                                                               
                                                               
                                                            </tr>
                                                            @endforeach
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

