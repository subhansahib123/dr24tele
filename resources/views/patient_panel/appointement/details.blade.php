@extends('patient_panel.layout.master');

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
                                <div class="list-group-item">
                                    <div>
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

                                                <input type="text" class="form-control" name="end" id="end" disabled value="{{$appointment->end}}" placeholder="End Date">
                                                @if ($errors->has('end'))
                                                <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control" name="price" id="price" disabled value="{{$appointment->price}}" placeholder="Enter Price">
                                                @if ($errors->has('price'))
                                                <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="interval">Interval</label>
                                                <input type="number" class="form-control" name="interval" id="interval" disabled value="{{$appointment->interval}}" placeholder="Enter Price">

                                            </div>
                                        </div>
                                        <div id="dvPassport" style="display: none">
                                            <form action="{{route('uploadRecords')}}" style="display: hidden;" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="patientId" value="{{$appointment->patient_id}}">
                                                <input type="hidden" name="appointmentId" value="{{$appointment->id}}">
                                                <div class="list-group">
                                                    <div class="list-group-item">
                                                        <div>

                                                            <div class="my-3 row">
                                                                <div class="form-group col-6" style="display: none;">
                                                                    <input type="file" class="form-control" name="xRay"  id="xRay">

                                                                    <label for="xRay">X-Rays</label>
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
                                                                        <button class="btn btn-primary" type="submit">Upload</button>
                                                                        <span><a href="{{route('patient.dashboard')}}" class="btn btn-secondary  ">Cancel</a></span>

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
<script type="text/javascript">
    function ShowHideDiv(upload) {
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = upload.checked ? "block" : "none";
    }
</script>
@endsection
