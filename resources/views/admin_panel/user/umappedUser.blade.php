@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">All Unmapped Users</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Unmapped Users List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-3">
                                <span class="card-title">Unmapped Users</span>

                            </div>
                            <div class="col-7 align-self-center"></div>
                            <div class="col-2">
                                <a href="{{route('mappingRole')}}"><button class="btn btn-primary">Map Users</button></a>

                            </div>
                            {{--<span class="card-title "><a href="#"> Add New Patient</a></span>--}}
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 rounded">
                                    <div class="lead">

                                    </div>

                                    <div class="container mt-4">



                                        <table class="table table-striped">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                                 <th scope="col" width="20%">Username</th>
                                               <th scope="col" width="1%">Action</th>
                                            </thead>
                                            @if(isset($all_patients) && count($all_patients)>0 && $all_patients->Users)
                                            @foreach($all_patients->Users as $all_patient)


                                            <tr>

                                                <td>


                                                    {{isset($all_patient->name)?$all_patient->name:'' }}



                                                </td>
                                                <td>


                                                    {{isset($all_patient->username)?$all_patient->username:'' }}



                                                </td>
                                                <td>
                                                    <a href="{{route('user.delete',[$all_patient->uuid])}}" class="btn btn-danger">Delete</a>
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
