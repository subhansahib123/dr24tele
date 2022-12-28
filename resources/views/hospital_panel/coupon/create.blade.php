@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-3" style="margin-top:350px">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

        @include('admin_panel.frontend.includes.messages')
        
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"></a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Coupon</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Coupon Details
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">
                             
                            </div>
                        </div>
                        <div class="container">
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('hospital.coupon.store')}}" method="POST">
                                @csrf
                                <div class=" row mb-4">
                                    <label for="displayname" class="col-md-3 form-label">Coupon</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('title')}}" name="title" id="title" placeholder="Coupon" autocomplete="title">
                                    </div>
                                    @if ($errors->has('title'))
                                    <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="start_date" class="col-md-3 form-label"> Start Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" value="{{old('start_date')}}" name="start_date" id="start_date" placeholder="Start Date">
                                    </div>
                                    @if ($errors->has('start_date'))
                                    <span class="text-danger text-left">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="end_date" class="col-md-3 form-label">End Date</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" value="{{old('end_date')}}" name="end_date" id="end_date" placeholder="End Date">
                                    </div>
                                    @if ($errors->has('end_date'))
                                    <span class="text-danger text-left">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
                                <div class=" row mb-4">
                                    <label for="discount" class="col-md-3 form-label"> Discount</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{old('discount')}}" name="discount" id="discount" placeholder="Discount">
                                    </div>
                                    @if ($errors->has('discount'))
                                    <span class="text-danger text-left">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>

                                <div class=" row mb-4">
                                    <label class="col-md-3 form-label" for="status">Status</label>
                                    <div class="col-md-9">

                                        <select class="form-select" name="status" id="status">

                                            <option value="0">
                                                Enable
                                            </option>
                                            <option value="1">
                                                Disable
                                            </option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                    <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                    @endif
                                </div>

                                <div class=" row mb-4">
                                    <label class="col-md-3 form-label" for="hospital">Hospital</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="hospital" id="hospital">
                                            @foreach($hospital as $hos)
                                            <option value="{{ $hos->id }}">{{ $hos->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('hospital'))
                                    <span class="text-danger text-left">{{ $errors->first('hospital') }}</span>
                                    @endif
                                </div>

                                <div class="mb-0 mt-4 row px-0 card-footer text-end">
                                    <div class="col">

                                        <button class="btn btn-primary" type="submit">Create</button>
                                        <span><a href="{{route('hospital.dashboard')}}" class="btn btn-info  ">Cancel</a></span>

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
<script>
    $("#start_date").datetimepicker({

    });
    $("#end").datetimepicker({

    });
</script>