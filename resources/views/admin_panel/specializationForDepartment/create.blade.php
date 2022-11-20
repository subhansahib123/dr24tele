@extends('admin_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"> Create Specialization</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Specialization</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        @include('admin_panel.frontend.includes.messages')
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('departmentSpecialization.created')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <label for="inputName" class="col-md-3 form-label">Specialization Name</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name" id="inputName" placeholder="Name">
                                    </div>
                                    @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary">Create</button>


                                    <a href="{{route('dashboard')}}" class="btn btn-info">Back</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>



@endsection