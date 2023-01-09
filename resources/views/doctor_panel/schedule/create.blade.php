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
                            <form action="{{route('store.schedule.doctor')}}" method="post" class="form-horizontal">
                                @csrf
                                <input type="hidden" class="form-control" name="doctor_id" id="doctor_id" required value="{{$doctor_id}}">
                                <div class="list-group">
                                    <div class="list-group-item" data-acc-step>
                                        <div data-acc-content>
                                            <div class="my-3 row">
                                                <div class="form-group col-6">

                                                    <label for="start">Start Date *</label>
                                                    <input type="time" class="form-control" required name="start"  placeholder="Start Date" required value="{{old('start')}}">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">


                                                    <label for="end">End Date</label>

                                                    <input type="time" class="form-control" name="end" placeholder="End Date" required value="{{old('end')}}">
                                                    @if ($errors->has('end'))
                                                    <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="price">Price *</label>
                                                    <input type="number" class="form-control" required name="price" id="price" placeholder="Enter Price" value="{{old('price')}}" required>
                                                    @if ($errors->has('price'))
                                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="interval">Interval *</label>
                                                    <input type="number" class="form-control" required name="interval" value="" id="interval" placeholder="Enter Interval" value="{{old('interval')}}" required>
                                                    @if ($errors->has('interval'))
                                                    <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="comment">Comments *</label>
                                                    <textarea class="form-control" rows="2"  required placeholder="Enter Comments About Schedule" value="{{old('comment')}}" name="comment" id="comment"></textarea>
                                                    @if ($errors->has('comment'))
                                                    <span class="text-danger text-left">{{ $errors->first('comment') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6" id="belong_effect">
                                                    <label for="exampleInputEmail1">People Per Slot *</label>
                                                    <input type="number" class="form-control" required name="number_of_people" value="{{old('number_of_people')}}" id="number_of_people" value="{{old('number_of_people')}}" placeholder="Enter People Per Slot">
                                                    @if ($errors->has('number_of_people'))
                                                    <span class="text-danger text-left">{{ $errors->first('number_of_people') }}</span>
                                                    @endif
                                                </div>
                                              
                                                 <div class="form-group col-6">
                                                    <label class="form-label" for="status">Days
                                                        <select  class="form-select" id="days" name="days[]" multiple >
                                                            <option {{old('days')=='M'?'selected':''}} value="M">Monday</option>
                                                            <option {{old('days')=='T'?'selected':''}} value="T">Tuesday</option>
                                                            <option {{old('days')=='W'?'selected':''}} value="W">Wednesday</option>
                                                            <option {{old('days')=='TH'?'selected':''}} value="TH">Thursday</option>
                                                            <option {{old('days')=='F'?'selected':''}} value="F">Friday</option>
                                                            <option {{old('days')=='Sa'?'selected':''}} value="Sa">Saturday</option>
                                                            <option {{old('days')=='S'?'selected':''}} value="S">Sunday</option>
                                                        </select>
                                                        @if ($errors->has('days'))
                                                        <span class="text-danger text-left mt-4 ">{{ $errors->first('days') }}</span>
                                                        @endif

                                                    </label>

                                                </div>
                                                <div class="form-group col-6">
                                                    <label class="form-label" for="repeat">Repeat
                                                        <input type="checkbox"  class="form-checkbox" id="repeat" name="repeat" value="{{old('repeat')}}">
                                                        @if ($errors->has('repeat'))
                                                        <span class="text-danger text-left mt-4 ">{{ $errors->first('repeat') }}</span>
                                                        @endif

                                                    </label>

                                                </div>
                                                <div class="form-group col-6">
                                                    <label class="form-label" for="status">Staus
                                                        <input type="checkbox" class="form-checkbox" required id="status" name="status" value="{{old('status')}}">
                                                        @if ($errors->has('status'))
                                                        <span class="text-danger text-left mt-4 ">{{ $errors->first('status') }}</span>
                                                        @endif

                                                    </label>

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
$('#repeat').change(function(e){
    if($(this).is(":checked"))
        $('#days').find('option').attr("selected", "selected");
    else
       $('days').find('option').attr("selected", "");
    return false;
});
</script>
@endsection
