@extends('hospital_panel.layout.master');
@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
        @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Management User's</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong> Management List</strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('createHospital.user')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('hospital.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>

                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 rounded">
                                    <div class="lead">
                                    </div>
                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th scope="col" width="5%">Sr#</th>
                                            <th scope="col" width="20%">Name</th>
                                            <th scope="col" width="1%">Action</th>
                                        </thead>
                                        @if($users)
                                        @foreach($users as $user)

                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                {{isset($user->name)?$user->name:'' }}
                                            </td>
                                            <td class="text-end">
                                                <a href="{{route('delete.hospitalUser',[$user->uuid])}}"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></a>
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
        <!-- CONTAINER CLOSED -->
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush