@extends('public_panel.layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public_assets/css/appointment_page.css') }}">
    {{--    <div class="content-wrapper m-6">--}}
    {{--    </div>--}}
    <section id="appointment" class="section-padding pt-100 pb-50 mt-100">
        <div class="auto-container">
            {{--            <div class="appointment-line">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-2">--}}
            {{--                        <div class="single-step text-center">--}}
            {{--                            <div class="single-step-icon">--}}
            {{--                                <i class="icofont icofont-hospital"></i>--}}
            {{--                            </div>--}}
            {{--                            <h5>Search For A Hospital</h5>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <!-- end single step -->--}}
            {{--                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">--}}
            {{--                        <div class="single-step text-center">--}}
            {{--                            <div class="single-step-icon">--}}
            {{--                                <i class="icofont icofont-job-search"></i>--}}
            {{--                            </div>--}}
            {{--                            <h5>Search For A Doctor</h5>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <!-- end single step -->--}}
            {{--                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">--}}
            {{--                        <div class="single-step text-center">--}}
            {{--                            <div class="single-step-icon">--}}
            {{--                                <i class="icofont icofont-pencil"></i>--}}
            {{--                            </div>--}}
            {{--                            <h5>Fill Out The From</h5>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <!-- end single step -->--}}
            {{--                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-5">--}}
            {{--                        <div class="single-step text-center">--}}
            {{--                            <div class="single-step-icon">--}}
            {{--                                <i class="icofont icofont-verification-check"></i>--}}
            {{--                            </div>--}}
            {{--                            <h5>Appointment Done</h5>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                    <!-- end single step -->--}}
            {{--                </div>--}}
            <div class="row">
                <div class="col-12">
                    <div style="text-align:center;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </div>
            </div>
            {{--            </div>--}}
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="appointment-form-ma">
                        <div class="row">
                            <div class="col-12 error">
                            </div>
                        </div>


                        <form id="appointmentForm">
                            <div class="col-12 error">
                            </div>
                            <div class="row" id="schedules">
                                {{--                                <div class="form-group col-12" id='calenderwrapper'>--}}
                                {{--                                    <div id='calendar'></div>--}}
                                {{--                                </div>--}}
                                <div class="col-12" id="scheduleDoctor">
                                </div>
                                {{--                                <div class="form-group col-lg-12" id="comments" style="display: none">--}}
                                {{--                                    <label>Comments</label>--}}
                                {{--                                    <textarea rows="5" cols="5" class="form-control" name="comments" required></textarea>--}}
                                {{--                                    <div class="col-12 text-center mt-3">--}}
                                {{--                                       <div class="btn btn-primary btn-sm" style="cursor: pointer;"  id="next-comment">Next</div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="form-group col-lg-12" id="membership" style="display: none">
                                    <div class="row">
                                        {{--                                        <div class="col-12 ">--}}
                                        {{--                                            <div class="form-check">--}}
                                        {{--                                                <input type="checkbox" name="hospital-check" value="1">--}}
                                        {{--                                                <label class="form-check-label" for="hospital-check">Are you already registered with this hospital?</label>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <form role="form">--}}
                                        {{--                                            <div class="col-12">--}}
                                        {{--                                                <div class="form-group">--}}
                                        {{--                                                    <label>Coupon</label>--}}
                                        {{--                                                    <div class="input-group">--}}
                                        {{--                                                        <input type="text" id="coupon" class="form-control" placeholder="Coupon Code" />--}}
                                        {{--                                                        <button type="button" id="coupon-btn" class="btn btn-apfm">Apply</button>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                        {{--                                        <div class="row">--}}
                                        {{--                                            <div class="col-lg-1 offset-11 mt-1 text-right text-primary" id="next-payment" style="cursor: pointer;">Next</div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="row" id="payment" style="display: none">
                                    <div class="col-xs-12 col-md-12 col-md-offset-4">

                                    </div>
                                </div>
                                <div class="form-group col-lg-12" style="display: none" id="book_appointment_submit">
                                    <button type="button" class="btn btn-apfm">Book Appointment <i class="icofont icofont-thin-right"></i></button>
                                </div>
                            </div>
                        </form>

                        <form id="appointmentForm">
                            {{--                        <form id="regForm" action="">--}}
                            <!-- One "tab" for each step in the form: -->
                            <div class="tab">
                                <p><div id='calendar'></div></p>
                            </div>

                            <div class="tab">
                                <p><label>Comments</label></p>
                                <p><textarea rows="5" cols="5" class="form-control" name="comments" required></textarea></p>
                                <div class="row">
                                    <div class="col-1">
                                        <input type="checkbox" name="hospital-check" value="1">
                                    </div>
                                    <div class="col-11 pl-0">
                                        <label class="form-check-label" for="hospital-check">Are you already registered with this hospital?</label>
                                    </div>
                                </div>
                            </div>

                            <div class="tab">
                                <form role="form">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Coupon</label>
                                            <div class="input-group">
                                                <input type="text" id="coupon" name="coupon" class="form-control" placeholder="Coupon Code" />
                                                <button type="button" id="coupon-btn" class="btn btn-apfm">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form role="form">
                                            <div class="row">
                                                <div class="col-xs-12 required">
                                                    <div class="form-group">
                                                        <label>CARD NUMBER</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control card-num"
                                                                   placeholder="Valid Card Number" />
                                                            <span class="input-group-addon"><span
                                                                    class="fa fa-credit-card "></span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4 col-md-4 required">
                                                    <div class="form-group">
                                                        <label><span class="hidden-xs">EXPIRATION MONTH</span></label>
                                                        <input type="text" class="form-control card-expiry-month" placeholder="MM" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-md-4 required">
                                                    <div class="form-group">
                                                        <label><span class="hidden-xs">EXPIRATION YEAR</span></label>
                                                        <input type="text" class="form-control card-expiry-year" placeholder="YY" />
                                                    </div>
                                                </div>
                                                <div class="col-xs-4 col-md-4 pull-right required">
                                                    <div class="form-group">
                                                        <label>CV CODE</label>
                                                        <input type="text" class="form-control card-cvc" placeholder="CVC" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 required">
                                                    <div class="form-group">
                                                        <label>CARD OWNER</label>
                                                        <input type="text" class="form-control" placeholder="Card Owner Names" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div style="overflow:auto;" class="mt-5">
                                <div style="float:right;">
                                    <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
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
    <script src='{{ asset('public_assets/js/moment.js') }}'></script>
    <script src='{{ asset('public_assets/js/timezone_moment.js') }}'></script>
    <style>

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 50px;
            width: 50px;
            margin: 0 20px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: blue;
        }

        .selected-date {
            background-color: green;
        }

        .selected-date a {
            color: white;
        }

        .selected-slot {
            background: green;
            color: white;
            cursor: pointer;
        }

        .selected-slot label {
            background: green;
            color: white;
        }

        .selected-slot input {
            background: green;
            color: white;
        }

        .appointment-form-ma .form-control {
            cursor: pointer;
        }
    </style>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        var BASE_URL = `{{ url('') }}`;
        var doctor_id = `{{ request()->segment(count(request()->segments())) }}`;
        var patient_id = `{{ auth()->user()->patient->id }}`;
        var schedule_id;
        var start;
        var end;
        var user_id;
        var fee;
        var paymentToken
        var public_date;
        var coupon;
        var hospital;


        document.addEventListener('DOMContentLoaded', function() {

            var $form = $("#appointmentForm");
            $("#coupon-btn").click(function(e){

                coupon = $('#coupon').val();
                if(coupon == '') {
                    coupon = 'coupon';
                }
                hospital = 1;
                $.ajax({
                    url: `/api/get/schedules/${doctor_id}/${public_date}/${coupon}/coupon`,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                }).done(function(data) {

                    if (data != undefined && data.length != 0) {
                        var htmlSchedules = '';
                        user_id = data.user_id;
                        data.schedules.forEach(element => {
                            console.log(element)
                            let startDate = moment(element.start);
                            let endDate = moment(element.end);
                            let userTimeZone = Intl.DateTimeFormat().resolvedOptions()
                                .timeZone;
                            startDate = startDate.tz(userTimeZone).format('h:mm a z');
                            endDate = endDate.tz(userTimeZone).format('h:mm a z');

                            var dbDateStart = moment(element.start).format(
                                'Y-M-D HH:mm:ss');
                            var dbDateEnd = moment(element.end).format('Y-M-D HH:mm:ss');
                            htmlSchedules += ` <div class="form-group col-lg-5 schedule_wrapper">
                                    <label>Appointments Left <span>${element.number_of_people}</span> / <span class="amount-converted">${element.price}</span> <span class="currency-code">INR</span></label>
                                    <input class="form-control" type="text" start="${dbDateStart}" end="${dbDateEnd}" readonly value="${startDate} To ${endDate}" />
                                    <input type="hidden" value="${element.id}" />
                                </div>`;

                            fee = $(this).find("span.amount-converted").html()
                        });

                        $('#scheduleDoctor').html(htmlSchedules);
                    } else {
                        $('#scheduleDoctor').html("<h3>No Schedule found !</h3>");
                    }
                });
                // alert(dateString)

            });
            $('#book_appointment_submit').click(function(e) {
                validateAndPay(e);
                paymentToken=$form.find('input[name="stripeToken"]').val();
                $.ajax({
                    url: BASE_URL + "/api/book/appointment",
                    type: "POST",
                    data: {
                        'doctor_id': doctor_id,
                        'patient_id': patient_id,
                        "slot_id": schedule_id,
                        "start": start,
                        "end": end,
                        "fee": fee,
                        "coupon" : coupon,
                        "hospital": hospital,
                        "comments": $('textarea[name="comments"]').val(),
                        'stripeToken': paymentToken

                    },

                    cache: false,
                    timeout: 800000,
                })
                    .done(function(data) {
                        // console.log(data);

                        send_notification(user_id, 'Appointment No.' + data.msg,
                            'You have a new appointment')
                        window.location = BASE_URL + '/patient/appointments'
                    })
                    .fail(function(error) {
                        console.log(error);
                    });
            });
            $('#schedules').on("click", '.schedule_wrapper', function() {
                $('.appointment-form-ma .schedule_wrapper').removeClass('selected-slot');
                $(this).addClass('selected-slot');
                schedule_id = $(this).find('input[type="hidden"]').val();
                start = $(this).find('input[type="text"]').attr('start');
                end = $(this).find('input[type="text"]').attr('end');
                fee = $(this).find("span.amount-converted").html()
                $('#comments').show();
                $('#calenderwrapper').hide();
                // $('#scheduleDoctor').hide();

                // $('#payment').show();

                // $('#book_appointment_submit').show();
            });
            $('#next-comment').on("click", function() {
                $('#membership').show();
                $('#comments').hide();
            });
            $('#yes_has_reg').click(function(){

                $('#has_reg').toggle();
            });

            $('#next-payment').on("click", function() {
                $('#membership').hide();
                $('#payment').show();
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
                public_date = userDatetimeZone;
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
                        user_id = data.user_id;
                        data.schedules.forEach(element => {
                            console.log(element)
                            let startDate = moment(element.start);
                            let endDate = moment(element.end);
                            let userTimeZone = Intl.DateTimeFormat().resolvedOptions()
                                .timeZone;
                            startDate = startDate.tz(userTimeZone).format('h:mm a z');
                            endDate = endDate.tz(userTimeZone).format('h:mm a z');

                            var dbDateStart = moment(element.start).format(
                                'Y-M-D HH:mm:ss');
                            var dbDateEnd = moment(element.end).format('Y-M-D HH:mm:ss');
                            htmlSchedules += ` <div class="form-group col-lg-5 schedule_wrapper">
                                    <label>Appointments Left <span>${element.number_of_people}</span> / <span class="amount-converted">${element.price}</span> <span class="currency-code">INR</span></label>
                                    <input class="form-control" type="text" start="${dbDateStart}" end="${dbDateEnd}" readonly value="${startDate} To ${endDate}" />
                                    <input type="hidden" value="${element.id}" />
                                </div>`;

                        });

                        $('#scheduleDoctor').html(htmlSchedules);
                    } else {
                        $('#scheduleDoctor').html("<h3>No Schedule found !</h3>");
                    }
                });
                // alert(dateString)

            });

            function validateAndPay(e) {
                // var $form = $(".appointmentForm"),
                inputVal = ['input[type=text]', 'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey('pk_test_0OgQlXP7CRZ0AzpdcYQfM496');
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }
            }

            function stripeHandleResponse(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    paymentToken = response['id'];
                    $form.find('input[type=text]').empty();

                }
            }

        });

        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            var x = document.getElementsByClassName("tab");
            if (n == 1 && !validateForm()) return false;
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {
                //...the form gets submitted:
                var buttonforclick = document.getElementById("book_appointment_submit");
                buttonforclick.click();
                // document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            for (i = 0; i < y.length; i++) {
                if (y[i].value == "" && y[i].getAttribute("name") != "coupon") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }


    </script>
@endsection
