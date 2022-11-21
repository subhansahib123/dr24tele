@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Specializations list</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Specializations</li>
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
                                <a href="{{url()->previous()}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                                <a href="{{route('createSpecialization')}}" class="btn btn-sm btn-success" data-toggle="Add">Add <i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('admin_panel.frontend.includes.messages')
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    <div class="mt-4">
                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                                <th scope="col" width="20%">Name</th>
                                               <th scope="col" width="1%">Action</th>
                                            </thead>
                                            @if(isset($specializations))
                                            @foreach($specializations as $specialization)
                                            <tr>
                                                <td>
                                                    {{$specialization->name}}
                                                </td>
                                                <td>
                                                    <a href="{{route('updateSpecialization',[$specialization->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
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
@push('js')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endpush
