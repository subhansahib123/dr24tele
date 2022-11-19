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
                            <div class="col-3"><span class="card-title">List</span></div>
                            <div class="col-7 align-self-center"></div>
               
                            <div class="col-2">
                                <a href="{{route('create.newDepartment')}}"><button class="btn btn-primary">ADD Departments</button></a>
                            </div>

                            {{-- <span class="card-title "><a href="{{route('roles.create')}}"> Add New Permission</a></span> --}}
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">






                                    <h3></h3>

                                    <table class="table table-striped">
                                        <thead>
                                            <th scope="col"  width="29%">Name</th>
                                            <th scope="col" class="text-center" width="3%"></th>
                                            <th scope="col" class="text-center" width="3%"></th>
                                            <th scope="col" class="text-center" width="3%"></th>
                                            <th scope="col" class="text-center" width="3%"></th>
                                            <th scope="col" class="text-center" width="3%"></th>
                                        </thead>


                                        @foreach($organizations->childlist as $organization)
                                        <tr>

                                            <td>

                                                {{$organization->name}}


                                            </td>
                                            <td>
                                                <a href="{{route('single.organization',['uuid'=>$organization->uuid])}}"><button class="btn btn-info">Update</button></a>

                                            </td>
                                            <td>
                                                <a href="{{route('users.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-primary">Users</button></a>

                                            </td>
                                            <td>
                                                <a href="{{route('patients.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-primary">Patients</button></a>

                                            </td>
                                            <td>
                                                <a href="{{route('departments.list',['uuid'=>$organization->uuid])}}"><button class="btn btn-primary">Departments</button></a>

                                            </td>
                                            @if($organization->status == 'Enabled')
                                            <td>

                                                <a href="{{route('delete.organisation',['uuid'=>$organization->uuid])}}"><button class="btn btn-danger">Inactive</button></a>

                                            </td>
                                            @else
                                            <td>
                                                <a href="{{route('delete.organisation',['uuid'=>$organization->uuid])}}"><button class="btn btn-info"> Active</button></a>

                                            </td>
                                            
                                            @endif
                                        </tr>
                                        @endforeach

                                    </table>


                                </div>
                                <div class="mt-4">
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