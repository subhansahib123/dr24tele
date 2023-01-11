@extends('hospital_panel.layout.master')

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- ROW-1 OPEN -->
            <div class="form-group">
                @include('hospital_panel.frontend.includes.messages')
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Doctor Schedule</li>
                                </ol>
                            </div>
                            <div class="col-4">
                                <span class="card-title"><strong>
                                        Schedule Details
                                    </strong></span>
                            </div>

                            <div class="col-3 text-end">

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.schedule')}}" method="post" class="form-horizontal">
                                @csrf

                                <div class="list-group">
                                    <div class="list-group-item" data-acc-step>
                                        <div data-acc-content>
                                            <div class="my-3 row">
                                                <div class="form-group col-6">

                                                    <label for="start">Doctors *</label>
                                                    <select type="datetime-local" class="form-control" name="doctor_id" id="doctor_id" required>
                                                        <option value="">Select Doctor</option>
                                                        @foreach ($doctors as $doctor )
                                                        <option {{old('doctor_id')==$doctor->id?'selected':''}}value="{{$doctor->id}}">{{$doctor->user->name}}</option>

                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('doctor_id'))
                                                    <span class="text-danger text-left">{{ $errors->first('doctor_id') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">

                                                    <label for="start_date">Start Date * </label>
                                                    <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Start Date" required value="{{old('start_date')}}">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">

                                                    <label for="start">Start Time *</label>
                                                    <input type="time" class="form-control" required name="start" placeholder="Start Date" required value="{{old('start')}}">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">


                                                    <label for="end">End Time *</label>

                                                    <input type="time" class="form-control" name="end" placeholder="End Date" required value="{{old('end')}}">
                                                    @if ($errors->has('end'))
                                                    <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group col-6">
                                                    <label for="price">Price *</label>
                                                    <input type="number" class="form-control" required name="price" id="price" maxlenght="10" placeholder="Enter Price" value="{{old('price')}}" required>
                                                    @if ($errors->has('price'))
                                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="interval">Interval *</label>
                                                    <input type="number" class="form-control" required name="interval" id="interval" placeholder="Enter Interval" value="{{old('interval')}}" required>
                                                    @if ($errors->has('interval'))
                                                    <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-6" id="belong_effect">
                                                    <label for="exampleInputEmail1">People Per Slot *</label>
                                                    <input type="number" class="form-control" name="number_of_people" required id="number_of_people" value="{{old('number_of_people')}}" placeholder="Enter People Per Slot">
                                                    @if ($errors->has('number_of_people'))
                                                    <span class="text-danger text-left">{{ $errors->first('number_of_people') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="comment">Comments *</label>
                                                    <textarea class="form-control" value="{{old('comment')}}" required name="comment" onkeydown="return /[a-z\ ]/i.test(event.key)" placeholder="Enter Comments About Schedule" id="comment"></textarea>
                                                    @if ($errors->has('comment'))
                                                    <span class="text-danger text-left">{{ $errors->first('comment') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-6 mt-5">
                                                    <div class="row">
                                                        <div class="col-3 offset-1">
                                                            <label class="form-label" for="status">Status
                                                                <input type="checkbox" class="form-checkbox" required id="status" name="status" value="{{old('status')}}">
                                                                @if ($errors->has('status'))
                                                                <span class="text-danger text-left mt-4 ">{{ $errors->first('status') }}</span>
                                                                @endif

                                                            </label>
                                                        </div>
                                                        <div class="col-3 offset-1">
                                                            <label class="form-label" for="repeat">Repeat
                                                                <input type="checkbox" class="form-checkbox" id="repeat" name="repeat" value="{{old('repeat')}}">
                                                                @if ($errors->has('repeat'))
                                                                <span class="text-danger text-left mt-4 ">{{ $errors->first('repeat') }}</span>
                                                                @endif

                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group col-12 " id="recursion">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="form-label" for="status">Days
                                                                <select class="form-select" id="days" name="days[]" multiple>
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
                                                        <div class="col-6">
                                                            <label for="end_date">End Date * </label>
                                                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="Start Date" required value="{{old('end_date')}}">
                                                            @if ($errors->has('start'))
                                                            <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                            @endif

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class=" px-0 mt-4  card-footer text-end">
                                                    <div>
                                                        <button class="btn btn-primary" type="submit">Save</button>
                                                        <span><a href="{{route('hospital.dashboard')}}" class="btn btn-info  ">Cancel</a></span>

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
    $('#recursion').hide();
    $('#weekDays').hide();
    let date=document.getElementsByName("end_date")
    $('#repeat').change(function(e) {
        if ($(this).is(":checked")) {
            $('#recursion').show();

            $('#days').find('option').attr("selected", "selected");

        } else
            $('#recursion').hide();

        $('#days').find('option').attr("selected", "");


        return false;
    });
</script>

@endsection