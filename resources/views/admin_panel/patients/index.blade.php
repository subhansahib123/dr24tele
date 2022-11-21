@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">ALL Patients </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ALL Patients </li>
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
                                <a href="{{route('create.patients')}}" class="btn btn-sm btn-success" data-toggle="Add">Add <i class="fa fa-plus"></i></a>
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
                                            </thead>
                                            @if($all_patients->person)
                                            @foreach($all_patients->person as $all_patient)


                                            <tr>

                                                <td>

                                                    {{$all_patient->givenName}}


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
