@extends('patient_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            @include('patient_panel.frontend.includes.messages')
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Documents</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong> Documents List</strong></span>
                            </div>

                            <div class="col-3 mx-0 px-0 text-end">
                            <a href="{{route('document.create')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('patient.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th scope="col">Sr No.</th>
                                            <th>Title</th>
                                            <th>View</th>
                                        </thead>


                                        @foreach($documents as $document)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $document->title }}</td>
                                            <td><a target="_blank" href="{{ asset('uploads/patient/document/'. $document->doc_file) }}"><i class="fa fa-eye"></i></a></td>
                                            <td>
                                                <form action="{{ route('document.delete', $document->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                   <button class="btn btn-danger" onclick="return confirm('Are You Sure')"><i class="fa fa-trash"></i></button>
                                                </form>
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
        <!-- CONTAINER CLOSED -->

    </div>
</div>
@endsection
