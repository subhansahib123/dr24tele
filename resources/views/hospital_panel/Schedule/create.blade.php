@extends('hospital_panel.layout.master');

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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="row">
                    <div class="form-group">
                        @include('admin_panel.frontend.includes.messages')
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <h3 class="card-title">Create Schedule</h3>
                            </div>
                            <div class="card-body">
                                <form id="form" action="" method="post">
                                    <input type="hidden" name="id" id="schedule_id"/>
                                    <div class="list-group">
                                        <div class="list-group-item" data-acc-step>
                                            <h5 class="mb-0 d-flex" data-acc-title><span
                                                    class="form-wizard-title">Schedule</span></h5>
                                            <div data-acc-content>
                                                <div class="my-3 row">
                                                     <div class="form-group col-4">

                                                        <label for="start">Doctors</label>
                                                        <select type="datetime-local" class="form-control" name="doctor_id"
                                                            id="doctor_id" required>
                                                            <option value="">Select Doctor</option>
                                                            @foreach ($doctors as $doctor )
                                                            <option value="{{$doctor->id}}">{{$doctor->user->username}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-12">


                                                        <input type="text" name="start"
                                                            id="start" placeholder="Start Date" required>

                                                        <input type="text" name="end"
                                                            id="end" placeholder="End Date" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label for="price">Price</label>
                                                        <input type="number" class="form-control" name="price"
                                                            id="price" placeholder="Enter Price" required>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="interval">Interval</label>
                                                        <input type="number" class="form-control" name="interval"
                                                            value="" id="interval" placeholder="Enter Interval" required>
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label class="form-label" for="middleName">Slot Belong To One
                                                            <input type="checkbox" checked class="form-checkbox"
                                                                id="slot_belong" name="slot_belong"

                                                                value="">

                                                        </label>

                                                    </div>
                                                    <div class="form-group col-4" id="belong_effect" style="display: none">
                                                        <label for="exampleInputEmail1">People Per Slot</label>
                                                        <input type="number" class="form-control" name="number_of_people"
                                                            value="" id="number_of_people"
                                                            placeholder="Enter People Per Slot">
                                                    </div>
                                                    <div class="form-group col-4">
                                                        <label class="form-label" for="status">Staus
                                                            <input type="checkbox" checked class="form-checkbox"
                                                                id="status" name="status"

                                                                value="">

                                                        </label>

                                                    </div>
                                                    <div class="form-group col-12">
                                                        <label for="comment">Comments</label>
                                                        <textarea class="form-control" name="comment" id="comment">Enter Comments About Schedule</textarea>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-group-item" data-acc-step>
                                            <h5 class="mb-0 d-flex" data-acc-title><span
                                                    class="form-wizard-title">Slots</span></h5>
                                            <div data-acc-content>
                                                <div class="my-3 row" id="slots_required">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 OPEN -->

                <!-- ROW-1 CLOSED -->

            </div>
            <!--CONTAINER CLOSED -->

        </div>
    </div>
    <style>
        #form input.error.fail-alert {
            border: 2px solid red;
            border-radius: 4px;
            line-height: 1;
            padding: 2px 0 6px 6px;
            background: #ffe6eb;
            }
          #form select.error.fail-alert {
            border: 2px solid red;
            border-radius: 4px;
            line-height: 1;
            padding: 2px 0 6px 6px;
            background: #ffe6eb;
            }

         #form input.valid.success-alert {
            border: 2px solid #4CAF50;
            color: green;
            }
        #form  select.valid.success-alert {
            border: 2px solid #4CAF50;
            color: green;
            }
    </style>
@endsection
