@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">All Dr-Tele Users</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users List</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-3">
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    <div class="lead">

                                    </div>

                                    <div class="mt-4">



                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                                 <th scope="col" width="18%">Username</th>
                                               <th scope="col" width="2%">Action</th>
                                            </thead>
                                            @if(isset($all_patients) && $all_patients->Users)
                                            @foreach($all_patients->Users as $all_patient)


                                            <tr>

                                                <td>


                                                    {{isset($all_patient->name)?$all_patient->name:'' }}



                                                </td>
                                                <td>


                                                    {{isset($all_patient->username)?$all_patient->username:'' }}



                                                </td>
                                                <td>
                                                    <a href="{{route('user.delete',[$all_patient->uuid])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
@push('js')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endpush
