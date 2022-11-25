@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

      
            <!-- Row -->
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Organization Departments</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Departments List
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                                <a href="{{route('create.newDepartment')}}" class="btn btn-sm btn-success">Add <i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Add New"></i></a>
                                <a href="{{route('dashboard')}}" class="btn btn-sm btn-info" data-toggle="Go Back">Back <i class="fa fa-reply"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            @include('admin_panel.frontend.includes.messages')
                            {{-- <p>Use <code class="highlighter-rouge">.table-striped</code>to add zebra-striping to any table row within the <code class="highlighter-rouge">.tbody</code>.</p> --}}
                            <div class="table-responsive">
                                <div class="bg-light p-4 ">

                                    <table class="table table-striped" id="datatable">
                                        <thead>
                                            <th scope="col">Name</th>
                                            <th class="text-end">Action</th>
                                        </thead>


                                        @if(isset($departments->childlist))
                                        @foreach($departments->childlist as $department)
                                        <tr>

                                            <td>
                                                {{$department->name}}

                                            </td>
                                            <td>
                                                <a href="{{route('single.department',['uuid'=>$department->uuid])}}"><button class="btn btn-info"><i class="fa fa-edit"></i></button></a>
                                                <a href="{{route('doctors.list',['uuid'=>$department->uuid])}}"><button class="btn btn-primary"><i class="fa fa-users"></i></button></a>
                                                @if($department->status == 'Enabled')
                                                <a href="{{route('delete.organisation',['uuid'=>$department->uuid])}}"><button class="btn btn-danger" title="In-Active"><i class="fa fa-eye-slash"></i></button></a>
                                                @else
                                                <a href="{{route('delete.organisation',['uuid'=>$department->uuid])}}"><button class="btn btn-info" title="Active"><i class="fa fa-eye"></i></button></a>
                                                @endif
                                            </td>

                                            

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-end">
                                            <td>
                                                Record Not Found
                                            </td>
                                            <td>
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
