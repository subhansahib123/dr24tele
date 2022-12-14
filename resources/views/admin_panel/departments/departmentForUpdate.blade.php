@extends('admin_panel.layout.master')

@section('content')


<div class="main-content app-content mt-5">
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
                                    <li class="breadcrumb-item active" aria-current="page">Update Department</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Department Details</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('update.department')}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <input type="hidden" name="DepUuid" value="{{$depData->uuid}}">
                                    <label for="displayname" class="col-md-3 form-label"> Display Name *</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $depData->display_name }}" onkeydown="return /[a-z\ ]/i.test(event.key)" name="displayname" id="displayname"
                                               placeholder="Display Name" autocomplete="displayname">
                                    </div>
                                    @if ($errors->has('displayname'))
                                    <span class="text-danger text-left">{{ $errors->first('displayname') }}</span>
                                    @endif
                                </div>

                                <input type="hidden" class="form-control" value="{{$depData->name}}" name="name">


                                <div class=" row mb-4">
                                    <label for="country" class="col-md-3 form-label"> Select Status  *</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status" id="state">
                                            <option value="">Select</option>
                                            <option value="Enabled" {{$depData->status=="Enabled"?"selected":''}}>Enable</option>
                                            <option value="Disabled" {{$depData->status=="Disabled"?"selected":''}}>Disable</option>

                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="pre_image" value="">
                                <div class=" row  mb-1">
                                    <label for="image" class="col-md-3 form-label">Picture <strong> 1140*650</strong></label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="file" name="image" id="image">
                                    </div>
                                </div>
                                <div class="mb-0 mt-4 row text-end">
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit">Upadate</button>
                                        <span><a href="{{route('organization')}}" class="btn btn-secondary  ">Cancel</a></span>
                                    </div>
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
