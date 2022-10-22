@extends('public_panel.layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public_assets/css/appointment_page.css') }}">
    <div class="content-wrapper">

        <!-- Breadcrumb Start -->
        <div class="breadcrumb-wrap bg-f br-2">
            <div class="container">
                <div class="breadcrumb-title">
                    <h2>Book Appointment</h2>
                    <ul class="breadcrumb-menu list-style">
                        <li><a href="{{ route('home.page') }}">Home </a></li>
                        <li>Book Appointment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section id="appointment" class="section-padding ptb-100">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-8 text-center mx-autocol-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 aos-init aos-animate"
                    data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <div class="section-title style2 text-center mb-40">
                        <h3>Get Appointment <span>In 4 Simple Step</span></h3>
                        <span class="line"></span>
                    </div>
                </div>
                <!-- end section title -->
            </div>
            <div class="appointment-line">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
                        <div class="single-step text-center">
                            <div class="single-step-icon">
                                <i class="icofont icofont-hospital"></i>
                            </div>
                            <h5>Search For A Hospital</h5>
                            <p>Lorem ipsum dolor sit consectetur adipiscing elit sed do.</p>
                        </div>
                    </div>
                    <!-- end single step -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
                        <div class="single-step text-center">
                            <div class="single-step-icon">
                                <i class="icofont icofont-job-search"></i>
                            </div>
                            <h5>Search For A Doctor</h5>
                            <p>Lorem ipsum dolor sit consectetur adipiscing elit sed do.</p>
                        </div>
                    </div>
                    <!-- end single step -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
                        <div class="single-step text-center">
                            <div class="single-step-icon">
                                <i class="icofont icofont-pencil"></i>
                            </div>
                            <h5>Fill Out The From</h5>
                            <p>Lorem ipsum dolor sit consectetur adipiscing elit sed do.</p>
                        </div>
                    </div>
                    <!-- end single step -->
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">
                        <div class="single-step text-center">
                            <div class="single-step-icon">
                                <i class="icofont icofont-verification-check"></i>
                            </div>
                            <h5>Appointment Done</h5>
                            <p>Lorem ipsum dolor sit consectetur adipiscing elit sed do.</p>
                        </div>
                    </div>
                    <!-- end single step -->
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="appointment-form-ma">
                        <form>



                            <div class="row" id="schedules">
                                <div class="form-group col-12" id='calenderwrapper'>
                                    <div id='calendar'></div>
                                </div>

                                <div class="form-group col-lg-12" id="comments" style="display: none">
                                    <label>Comments</label>
                                    <textarea rows="5" cols="5" class="form-control" name="comments" >

                                    </textarea>
                                </div>

                                <div class="form-group col-lg-12" style="display: none" id="book_appointment_submit">
                                    <button type="button" class="btn btn-apfm">Book Appointment <i
                                            class="icofont icofont-thin-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
        <!--- END CONTAINER -->
    </section>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='{{asset('public_assets/js/moment.js')}}'></script>
    <script src='{{asset('public_assets/js/timezone_moment.js')}}'></script>
    <style>
        .selected-date {
            background-color: green;
        }

        .selected-date a {
            color: white;
        }
        .selected-slot{
            background: green;
            color: white;
            cursor: pointer;
        }
        .selected-slot label{
            background: green;
            color: white;
        }
        .selected-slot input{
            background: green;
            color: white;
        }
        .appointment-form-ma .form-control{
            cursor: pointer;
        }
    </style>
    <script>
        var BASE_URL = `{{url('')}}`;
        var doctor_id = `{{ request()->segment(count(request()->segments())) }}`;
        var patient_id=`{{auth()->user()->patient->id}}`;
        var schedule_id;
        var start;
        var end;




        document.addEventListener('DOMContentLoaded', function() {
            $('#book_appointment_submit').click(function(){
                $.ajax({
                    url: BASE_URL+"/api/book/appointment",
                    type: "POST",
                    data: {
                        'doctor_id':doctor_id,
                        'patient_id':patient_id,
                        "slot_id":schedule_id,
                        "start":start,
                        "end":end,
                        "comments":$('#comments').val()
                    },

                    cache: false,
                    timeout: 800000,
                })
                .done(function(data){
                    console.log(data);
                })
                .fail(function(error){
                    console.log(error);
                });
            });
             $('#schedules').on("click", '.schedule_wrapper', function() {
                    $('.appointment-form-ma .schedule_wrapper').removeClass('selected-slot');
                    $(this).addClass('selected-slot');
                    schedule_id= $(this).find('input[type="hidden"]').val();
                    start= $(this).find('input[type="text"]').attr('start');
                    end= $(this).find('input[type="text"]').attr('end');
                    $('#comments').show();
                    $('#book_appointment_submit').show();
            });
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // themeSystem: 'bootstrap5',
                allDaySlot: false,
                // headerToolbar: {
                //     center: 'range'
                // },
                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                initialView: 'dayGridWeek',
                // selectable: true,
                visibleRange: function(currentDate) {
                    // Generate a new date for manipulating in the next step
                    var startDate = new Date(currentDate.valueOf());
                    var endDate = new Date(currentDate.valueOf());

                    // Adjust the start & end dates, respectively
                    startDate.setDate(startDate.getDate() - 1); // One day in the past
                    endDate.setDate(endDate.getDate() + 7); // Two days into the future

                    return {
                        start: startDate,
                        end: endDate
                    };
                },

            });
            calendar.render();
            $('#calendar table tbody').remove();
            $('#calendar .fc-view-harness ').css('height', '40.593px')
            $('.fc-col-header-cell').click(function() {
                $('.fc-col-header-cell').removeClass('selected-date');
                $(this).addClass('selected-date');
                var dateString = $(this).find('a').attr('aria-label');
                let yourDate = new Date(dateString)
                const offset = yourDate.getTimezoneOffset()
                yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000))
                var userDatetimeZone = yourDate.toISOString().split("T")[0];
                $.ajax({
                    url: `/api/get/schedules/${doctor_id}/${userDatetimeZone}`,
                    type: "GET",
                    // data: {
                    //     'doctor_id':doctor_id,
                    //     'date':yourDate.toISOString()
                    // },
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                }).done(function(data) {
                    if (data != undefined && data.length != 0) {
                        var htmlSchedules = '';
                        data.forEach(element => {
                            console.log(element)
                            let startDate =moment(element.start);
                             let endDate = moment(element.end);
                             let userTimeZone=Intl.DateTimeFormat().resolvedOptions().timeZone;
                            startDate=startDate.tz(userTimeZone).format('h:mm a z');
                            endDate=endDate.tz(userTimeZone).format('h:mm a z');

                            var dbDateStart=moment(element.start).format('Y-M-D HH:mm:ss');
                            var dbDateEnd=moment(element.end).format('Y-M-D HH:mm:ss');
                            htmlSchedules += ` <div class="form-group col-lg-5 schedule_wrapper">
                                    <label>Appointments Left <span>${element.number_of_people}</span> / ${element.price} INR</label>
                                    <input class="form-control" type="text" start="${dbDateStart}" end="${dbDateEnd}" readonly value="${startDate} To ${endDate}" />
                                    <input type="hidden" value="${element.id}" />
                                </div>`;

                        });
                         $('#calenderwrapper').after('');
                        $('#calenderwrapper').after(htmlSchedules);
                    } else {
                       $('#calenderwrapper').after("<h3>No Schedule found !</h3>");
                    }
                });
                // alert(dateString)

            });
        });
    </script>
@endsection