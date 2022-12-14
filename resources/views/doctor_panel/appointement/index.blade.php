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

                                <div class="row d-none mb-3" id="call-action">
                                    <div class="col-1">
                                        <button type="button" class="btn btn-success btn-sm" id="call">Call</button>
                                    </div>
                                    <div class="col-1">
                                        <form action="{{ route('doctor.eprescription.create') }}">
                                            <input type="hidden" name="doctor_id" id="doctor_id">
                                            <input type="hidden" name="patient_id" id="patient_id">
                                            <input type="hidden" name="organization_id" id="organization_id">
                                            <input type="hidden" name="appointment_id" id="appointment_id">
                                            <input type="submit" class="btn btn-primary btn-sm" value="E-Prescription">
                                        </form>
                                    </div>
                                </div>
                                <div id="doc-calender-2"></div>
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
        $(document).ready(function () {
            var events = [];
            $('.js-example-basic-multiple').select2();
            $.ajax({
                url: `/doctor/appointments/list`,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
            }).done(function (data) {
                console.log(data.data.appointments);
                var asd = data.data.appointments
                asd.forEach(element => {
                    var dbDateStart = moment(element.start).format('YYYY-MM-DDTHH:mm:ss');
                    var dbDateEnd = moment(element.end).format('YYYY-MM-DDTHH:mm:ss');
                    console.log(element);
                    events.push({
                        "id": element.id,
                        "doctor": element.doctor_id,
                        "department_id": element.doctor.department_id,
                        "start": dbDateStart,
                        "end": dbDateEnd,
                        "title": element.description,
                        "patient_id": element.patient_id
                    })
                });
                var calendarEl = document.getElementById('doc-calender-2');

                var doccalender = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    initialView: 'dayGridMonth',
                    nowIndicator: true,
                    initialDate: new Date(),
                    navLinks: true,
                    events: events,
                    eventClick: function (info) {
                        var id = info.event.id;
                        console.log(info)
                        $('#call-action').addClass('d-flex');
                        $('#organization_id').val(info.event.extendedProps.department_id)
                        $('#doctor_id').val(info.event.extendedProps.doctor)
                        $('#patient_id').val(info.event.extendedProps.patient_id)
                        $('#appointment_id').val(info.event.id)
                    }
                });

                doccalender.render();
            });

            $('#call').click(function (){
                var doctor_id = $('#doctor_id').val()
                var patient_id = $('#patient_id').val()
                var appointment_id = $('#appointment_id').val()
                send_notification(patient_id,'Appointment No'+appointment_id,'please join call now',true,doctor_id)
            });

        })
    </script>
@endsection
