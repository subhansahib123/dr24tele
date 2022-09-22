@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Departments List</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Departments List</li>
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
                            <!-- <div class="col-2">
                                <a href="{{route('create.organization')}}"><button class="btn btn-primary">ADD Organizations</button></a>

                            </div> -->

                            {{-- <span class="card-title "><a href="{{route('roles.create')}}"> Add New Permission</a></span> --}}
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 rounded">


                                



                                    <h3></h3>

                                    <table class="table table-striped">
                                        <thead>
                                            <th scope="col" width="40%">Name</th>
                                             <th scope="col" width="1%">List</th> 
                                        </thead>


                                        @foreach($departments->childlist as $department)
                                        <tr>

                                            <td>

                                                {{$department->name}}


                                            </td>
                                            <td>

                                                <a href="{{route('doctors.list',['uuid'=>$department->uuid])}}"><button class="btn btn-primary">Doctors</button></a>


                                            </td>

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