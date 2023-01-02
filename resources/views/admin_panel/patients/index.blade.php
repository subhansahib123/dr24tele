@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- Row -->
            @include('admin_panel.frontend.includes.messages')
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ALL Patients</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Patients List
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('create.patients',['uuid'=>'c6bc6265-e876-414a-9672-a85e09280059']   )}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">
                                    <div class="lead">

                                    </div>

                                    <div class="mt-4">



                                        <table class="table table-striped" id="datatable">
                                            <thead>
                                            <th scope="col" width="3%">Sr#</th>
                                                <th scope="col" width="20%">Name</th>
                                                <th class="text-end" scope="col" width="1%">Action</th>
                                            </thead>
                                            @if($all_patients)
                                            @foreach($all_patients as $all_patient)
                                            @if(isset($all_patient->user->user_organization->id))
                                            @if($all_patient->user->user_organization->organization->id == auth()->user()->user_organization->organization->id)


                                            <tr style="line-height:10px ;">

                                            <td>{{$loop->index+1}}</td>
                                                <td>

                                                    {{$all_patient->user->name}}


                                                </td>
                                                <td class="text-end">

                                                    <a href="{{route('patient.delete',['uuid'=>$all_patient->user->uuid])}}"><button class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i></button></a>


                                                </td>



                                            </tr>

                                            @endif
                                            @endif
                                            @endforeach
                                            @else
                                            <tr>

                                                <td>

                                                    Record No Record


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