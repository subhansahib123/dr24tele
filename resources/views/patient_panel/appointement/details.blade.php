@extends('doctor_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('doctor_panel.frontend.includes.messages')

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
                                </ol>
                            </div>
                            <div class="col-6">
                                <span class="card-title"><strong> Schedule Details</strong></span>
                            </div>

                            <div class="col-1">
                            </div>
                        </div>

                        <div class="card-body">
                        <div class="list-group">
                                    <div class="list-group-item" data-acc-step>
                                        <div data-acc-content>
                                            <div class="my-3 row">
                                                <div class="form-group col-6">

                                                    <label for="start">Start Date</label>
                                                    <input type="text" class="form-control" disabled value="{{$appointment->start}}" name="start" id="start" placeholder="Start Date">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">


                                                    <label for="end">End Date</label>

                                                    <input type="text" class="form-control" name="end" id="end" disabled value="{{$appointment->end}}" placeholder="End Date"   >
                                                    @if ($errors->has('end'))
                                                    <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="price">Price</label>
                                                    <input type="number" class="form-control" name="price" id="price" disabled value="{{$schedule->price}}" placeholder="Enter Price"   >
                                                    @if ($errors->has('price'))
                                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="interval">Interval</label>
                                                    <input type="number" class="form-control" name="interval" value="" id="interval" placeholder="Enter Interval" disabled value="{{$schedule->interval}}"  >
                                                    @if ($errors->has('interval'))
                                                    <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="interval">Upload Records</label>
                                                    <input type="checkbox" class="form-control" name="interval" id="records"   >
                                                    @if ($errors->has('interval'))
                                                    <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                    @endif
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                </div>
                            <form action="{{route('store.schedule.doctor')}}" style="display: hidden;" id="form" method="post" class="form-horizontal">
                                @csrf
                                <input type="hidden" class="form-control" name="doctor_id" id="doctor_id"   value="{{$doctor_id}}">
                                <div class="list-group">
                                    <div class="list-group-item" data-acc-step>
                                        <div data-acc-content>
                                            <div class="my-3 row">
                                                <div class="form-group col-6">

                                                    <label for="xRay">X-Rays</label>
                                                    <input type="file" class="form-control" name="xRay" id="xRay">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">


                                                    <label for="reports">Previous Reports</label>

                                                    <input type="file" class="form-control" name="reports" id="reports">
                                                    @if ($errors->has('end'))
                                                    <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                    @endif
                                                </div>
                                                <div class="mb-0 mt-4 mx-0 row text-end">
                                                    <div class="col mx-0">
                                                        <button class="btn btn-primary" type="submit">Create</button>
                                                        <span><a href="{{route('doctor.dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!--CONTAINER CLOSED -->

    </div>
</div>





@endsection
@section('foot_script')
<script>
    
</script>
@endsection