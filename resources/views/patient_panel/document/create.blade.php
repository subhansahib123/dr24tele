@extends('patient_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('admin_panel.frontend.includes.messages')

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Document</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Document's</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('document.save')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class=" row mb-1">
                                    <label for="memberName" class="col-md-3 form-label">Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" onkeydown="return /[a-z\ ]/i.test(event.key)" value="{{old('title')}}" name="title" id="title" placeholder="Document Name">
                                    </div>
                                    @if ($errors->has('title'))
                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-1">
                                    <label for="email" class="col-md-3 form-label">File</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" value="{{old('doc_file')}}" name="doc_file" id="doc_file">
                                    </div>
                                    @if ($errors->has('doc_file'))
                                    <span class="text-danger text-left">{{ $errors->first('doc_file') }}</span>
                                    @endif
                                </div>

                                <div class="form-group card-footer text-end mx-0 px-0">
                                    <!-- <label for="role">Roles</label> -->
                                    <button type="submit" class="btn btn-primary ">Create</button>
                                    <a href="{{route('patient.dashboard')}}" class="btn btn-info">Back</a>
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
