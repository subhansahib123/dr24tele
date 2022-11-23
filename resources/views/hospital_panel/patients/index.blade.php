@extends('hospital_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">ALL Users </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ALL Users </li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <span class="card-title">Mapped and Unmapped Users</span>
                            </div>
                            <div class="col-5 align-self-center"></div>
                            <div class="col-2">
                            </div>
                            {{--<span class="card-title "><a href="#"> Add New use</a></span>--}}
                        </div>
                        <div class="card-body">
                            <div class="card-header row">
                                <div class="col-3">
                                    <a href="{{route('hospital.dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                                </div>
                            </div>
                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4">
                                    <div class="lead">
                                    </div>
                                    <div class="mt-4">
                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                                <th scope="col" width="3%">Sr#</th>
                                                <th scope="col" width="20%">Name</th>
                                            </thead>
                                            @if($all_patients->person)
                                            @foreach($all_patients->person as $all_patient)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    {{isset($all_patient->givenName)?$all_patient->givenName:'' }}
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
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush