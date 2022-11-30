@extends('doctor_panel.layout.master');

@section('content')
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('doctor_panel.frontend.includes.messages')


            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Appointments</li>
                                </ol>
                            </div>
                            <div class="col-3">
                                <span class="card-title"><strong> Appointments List</strong></span>
                            </div>

                            <div class="col-4 text-end">

                            </div>
                        </div>
                        <div class="card-body">

                            <div id="doc-calender-2"></div>

{{--                            <div class="table-responsive">--}}
{{--                                <div class="bg-light p-4 ">--}}

{{--                                    <table class="table table-striped" id="datatable">--}}
{{--                                        <thead>--}}
{{--                                            <tr>--}}
{{--                                                <th>ID</th>--}}
{{--                                                <th>Start </th>--}}
{{--                                                <th>End</th>--}}
{{--                                                <th>Comments</th>--}}
{{--                                                <th>Patient</th>--}}
{{--                                                <th class="text-end">Action</th>--}}
{{--                                            </tr>--}}
{{--                                        </thead>--}}


{{--                                        @foreach($appointements as $schedule)--}}
{{--                                        <tr>--}}

{{--                                            <td>{{ $loop->index + 1 }}</td>--}}
{{--                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->start)) }}</td>--}}
{{--                                            <td>{{ date('d-m-Y H:i A', strtotime($schedule->end)) }}</td>--}}
{{--                                            <td>{{ $schedule->comment }}</td>--}}
{{--                                            <td>{{ $schedule->patient->user->username }}</td>--}}
{{--                                            <td>--}}

{{--                                                <button type="button" onclick="" class="btn btn-success btn-sm">Call</button>--}}


{{--                                            </td>--}}



{{--                                        </tr>--}}
{{--                                        @endforeach--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->

    </div>
</div>
@endsection
@section('foot_script')
<script>
    $(document).ready(function (){
        var events = [];
        $('.js-example-basic-multiple').select2();
        $.ajax({
            url: `/api/doctor/appointments`,
            type: "GET",
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
        }).done(function(data) {
            data.forEach(element => {
                var dbDateStart = moment(element.start).format('Y-M-DTHH:mm:ss');
                var dbDateEnd = moment(element.end).format('Y-M-DTHH:mm:ss');
                events.push({id:element.id, doctor:element.doctor_id, start:dbDateStart, end: dbDateEnd, title: element.comment,
                patient_id: element.patient_id})
            });
            var calendarEl = document.getElementById('doc-calender-2');

            var doccalender = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridWeek',
                nowIndicator: true,
                initialDate: new Date(),
                navLinks: true,
                events: events,
                eventClick: function(info) {
                    info.el.style.borderColor = 'red';
                    var id = info.event.id;
                    send_notification(info.event.patient_id,'Appointment No'+ info.event.id,'please join call now',true,info.event.doctor_id)
                }
                });

            doccalender.render();
        });

    })
</script>
@endsection
