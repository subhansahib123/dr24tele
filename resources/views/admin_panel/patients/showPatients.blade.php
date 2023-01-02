@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row mt-3">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Hospital Patients</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Patients List
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('create.patients',$organization->uuid)}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">



                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                        <th scope="col" width="3%">Sr#</th>

                                            <th scope="col" width="30%">Name</th>
                                            <th class="col text-end">Action</th>
                                        </thead>


                                        @foreach($patients as $patient)
                                        @if(isset($patient->user->user_organization->id))
                                        @if($patient->user->user_organization->organization->id == $organization->id)

                                        <tr>

                                                <td>{{$loop->index+1}}</td>
                                    
                                            <td>

                                                {{$patient->user->name}}

                                            </td>

                                            <td class="text-end">
                                                <a href="{{route('patient.delete',[$patient->user->uuid])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endif
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
@push('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush