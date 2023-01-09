@extends('hospital_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">


            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                    @include('hospital_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Schedule</li>
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
                            <form action="{{route('update.schedule')}}" method="post" class="form-horizontal">
                                @csrf

                                <input type="hidden" class="form-control" name="id" id="id" required value="{{$schedule->id}}">
                                <div class="list-group">
                                    <div class="list-group-item" data-acc-step>
                                        <div data-acc-content>
                                            <div class="my-3 row">
                                                <div class="form-group col-6">

                                                    <label for="start">Doctors *</label>
                                                    <input type="text" disabled class="form-control" value="{{$doctor->user->name}}">

                                                </div>
                                                <div class="form-group col-6">

                                                    <label for="start">Start Date *</label>
                                                    <input type="text" class="form-control" required name="start" id="start" placeholder="Start Date" required value="{{$schedule->start}}">
                                                    @if ($errors->has('start'))
                                                    <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                    @endif

                                                </div>
                                                <div class="form-group col-6">


                                                    <label for="end">End Date *</label>

                                                    <input type="text" class="form-control" name="end" required id="end" placeholder="End Date" required value="{{$schedule->end}}">
                                                    @if ($errors->has('end'))
                                                    <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="price">Price *</label>
                                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{$schedule->price}}" required>
                                                    @if ($errors->has('price'))
                                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="interval">Interval *</label>
                                                    <input type="number" class="form-control" required name="interval" id="interval" placeholder="Enter Interval" value="{{$schedule->interval}}" required>
                                                    @if ($errors->has('interval'))
                                                    <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-4" id="belong_effect">
                                                    <label for="exampleInputEmail1">People Per Slot *</label>
                                                    <input type="number" class="form-control" required name="number_of_people" id="number_of_people" value="{{$schedule->number_of_people}}" placeholder="Enter People Per Slot">
                                                    @if ($errors->has('number_of_people'))
                                                    <span class="text-danger text-left">{{ $errors->first('number_of_people') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-12">
                                                    <label for="comment">Comments *</label>
                                                    <textarea class="form-control" value="{{old('comment')}}" required name="comment" id="comment">{{$schedule->comment}}</textarea>
                                                    @if ($errors->has('comment'))
                                                    <span class="text-danger text-left">{{ $errors->first('comment') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-4">
                                                    <label class="form-label" for="status">Staus
                                                        <input type="checkbox" class="form-checkbox mx-2" id="status" name="status" {{$schedule->status==1?'checked':''}}>
                                                        @if ($errors->has('status'))
                                                        <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                                        @endif

                                                     </label>

                                                </div>

                                                <div class="px-0 card-footer text-end">
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