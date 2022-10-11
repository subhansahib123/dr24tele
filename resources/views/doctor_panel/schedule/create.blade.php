@extends('doctor_panel.layout.master');

@section('content')


<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Create Schedule</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-1 OPEN -->
            <div class="row">
                <div class="form-group">
                    @include('doctor_panel.frontend.includes.messages')
                </div>
                <div class="col-xl-8">
                    <div class="card">
                         <div class="card-header">
                            <h4 class=""> Create Schedule
                            </h4>
                        </div>
                        <div class="card-body">
                        <form  action="{{route('store.schedule.doctor')}}" method="post" class="form-horizontal">
                            @csrf
                                   <input type="hidden" class="form-control" name="doctor_id"
                                                            id="doctor_id" required value="{{$doctor_id}}">
                                    <div class="list-group">
                                        <div class="list-group-item" data-acc-step>
                                            <h5 class="mb-0 d-flex" data-acc-title><span
                                                    class="form-wizard-title">Schedule</span></h5>
                                            <div data-acc-content>
                                                <div class="my-3 row">
                                                     <div class="form-group col-6">

                                                        <label for="start">Start Date</label>
                                                        <input type="text" class="form-control" name="start"
                                                            id="start" placeholder="Start Date" required value="{{old('start')}}">
                                                             @if ($errors->has('start'))
                                                                <span class="text-danger text-left">{{ $errors->first('start') }}</span>
                                                            @endif

                                                    </div>
                                                    <div class="form-group col-6">


                                                        <label for="end">End Date</label>

                                                        <input type="text" class="form-control" name="end"
                                                            id="end" placeholder="End Date" required value="{{old('end')}}">
                                                            @if ($errors->has('end'))
                                                                <span class="text-danger text-left">{{ $errors->first('end') }}</span>
                                                            @endif
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="price">Price</label>
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" placeholder="Enter Price" value="{{old('price')}}" required>
                                                            @if ($errors->has('price'))
                                                                <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                                            @endif
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="interval">Interval</label>
                                                        <input type="number" class="form-control" name="interval"
                                                            value="" id="interval" placeholder="Enter Interval" value="{{old('interval')}}" required>
                                                            @if ($errors->has('interval'))
                                                                <span class="text-danger text-left">{{ $errors->first('interval') }}</span>
                                                            @endif
                                                    </div>

                                                    <div class="form-group col-4" id="belong_effect">
                                                        <label for="exampleInputEmail1">People Per Slot</label>
                                                        <input type="number" class="form-control" name="number_of_people"
                                                            value="" id="number_of_people" value="{{old('number_of_people')}}"
                                                            placeholder="Enter People Per Slot">
                                                            @if ($errors->has('number_of_people'))
                                                                <span class="text-danger text-left">{{ $errors->first('number_of_people') }}</span>
                                                            @endif
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label class="form-label" for="status">Staus
                                                            <input type="checkbox" class="form-checkbox"
                                                                id="status" name="status" value="{{old('status')}}" >
                                                              @if ($errors->has('status'))
                                                                <span class="text-danger text-left">{{ $errors->first('status') }}</span>
                                                            @endif

                                                        </label>

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="comment">Comments</label>
                                                        <textarea class="form-control" value="{{old('comment')}}" name="comment" id="comment">Enter Comments About Schedule</textarea>
                                                        @if ($errors->has('comment'))
                                                                <span class="text-danger text-left">{{ $errors->first('comment') }}</span>
                                                            @endif
                                                    </div>
                                                    <div class="mb-0 mt-4 row justify-content-end">
                                                        <div class="col">
                                                            <button class="btn btn-primary" type="submit">Save</button>
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
