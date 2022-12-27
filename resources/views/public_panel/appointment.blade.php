@extends('public_panel.layout.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public_assets/css/appointment_page.css') }}">
    {{--    <div class="content-wrapper m-6">--}}
    {{--    </div>--}}
    <section id="appointment" class="section-padding pt-100 pb-50 mt-100">
        <div class="auto-container">
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
            <div class="row mt-5">
                <div class="col-lg-10 mx-auto">
                    <div class="row appointment-form-ma">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-12 error">
                                </div>
                            </div>
                            <form id="appointmentForms">
                                <div class="col-12 error">
                                </div>
                                <div class="row" id="schedules">
                                    <div class="col-12" id="scheduleDoctor">
                                    </div>
                                    <div class="form-group col-lg-12" style="display: none"
                                         id="book_appointment_submit">
                                        <button type="button" class="btn btn-apfm">Book Appointment <i
                                                class="icofont icofont-thin-right"></i></button>
                                    </div>
                                </div>
                            </form>

                            <form id="appointmentForm">
                                <div class="tab">
                                    <p>
                                    <div id="doc-calender"></div>
                                    </p>
                                    {{--                                    <p><div id='calendar'></div></p>--}}
                                </div>

                                <div class="tab">
                                    <p><label>Comments</label></p>
                                    <p><textarea rows="5" cols="5" class="form-control" name="comments"
                                                 required></textarea></p>
                                    <div class="row ms-2 my-2" id="hospital-check-is">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input me-2 p-0"
                                                   name="hospital-check" id="hospital-check" value="1">
                                            <label class="form-check-label" for="hospital-check">Are you already
                                                registered with this hospital?</label>
                                        </div>
                                    </div>
                                    <div class="row" id="hospital-check-file" style="display: none">
                                        <div class="col-md-6">
                                            <input type="file" id="hospital-register-id" hidden>
                                            <label for="hospital-register-id"><i class="ri-add-line"></i></label>
                                            <p>Please upload your registration card</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab">
                                    <form role="form">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Coupon</label>
                                                <div class="input-group">
                                                    <input type="text" id="coupon" name="coupon"
                                                           class="form-control mb-3" placeholder="Coupon Code"/>
                                                    <button type="button" id="coupon-btn" class="btn btn-apfm">Apply
                                                    </button>
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
                                                                       placeholder="Valid Card Number"/>
                                                                <span class="input-group-addon"><span
                                                                        class="fa fa-credit-card "></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4 required">
                                                        <div class="form-group">
                                                            <label><span
                                                                    class="hidden-xs">EXPIRATION MONTH</span></label>
                                                            <input type="text" class="form-control card-expiry-month"
                                                                   placeholder="MM"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4 required">
                                                        <div class="form-group">
                                                            <label><span
                                                                    class="hidden-xs">EXPIRATION YEAR</span></label>
                                                            <input type="text" class="form-control card-expiry-year"
                                                                   placeholder="YY"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4 pull-right required">
                                                        <div class="form-group">
                                                            <label>CV CODE</label>
                                                            <input type="text" class="form-control card-cvc"
                                                                   placeholder="CVC"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 required">
                                                        <div class="form-group">
                                                            <label>CARD OWNER</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Card Owner Names"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                                <div style="overflow:auto;" class="mt-5">
                                    <div style="text-align:right;">
                                        <button type="button" class="btn btn-primary" id="prevBtn"
                                                onclick="nextPrev(-1)">Previous
                                        </button>
                                        <button type="button" class="btn btn-primary" id="nextBtn"
                                                onclick="nextPrev(1)">Next
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="d-none d-md-block col-md-4">
                            <div class="dr-details">
                                <div class="dr-image">
                                    <img
                                        src="{{ ($doctor->user->image) ? asset('uploads/organization/department/doctor/'. $doctor->user->image) : asset('public_assets/img/services/service-9.jpg')}}"
                                        alt="Image">
                                </div>
                                <div class="dr-info text-capitalize">
                                    <h6 >{{ $doctor->user->name }}</h6>
                                    @foreach($doctor->specialization as $specialization)
                                    <p>{{  $specialization->name  }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end col -->
        </div>
        </div>
        <!--- END CONTAINER -->
    </section>

    <script src='{{ asset('public_assets/js/moment.js') }}'></script>
    <script src='{{ asset('public_assets/js/timezone_moment.js') }}'></script>
    <style>
        .section-padding {
            background: #135aa5;
        }

        .appointment-form-ma {
            box-shadow: none;
        }

        .auto-container {
            counter-reset: section;
        }

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

        #hospital-register-id + label {
            background-color: #42c0fb;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            height: 40px;
            width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            color: #000000;
            height: 50px;
            width: 50px;
            margin: 0 20px;
            background-color: #42c0fb;
            border: none;
            border-radius: 50%;
            display: inline-flex;
            font-weight: bold;
            /*opacity: 0.5;*/
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .step::before {
            counter-increment: section;
            content: counter(section);
        }

        .step:not(:last-of-type)::after {
            content: '';
            border-bottom: 2px solid #42c0fb;
            position: absolute;
            top: 25px;
            left: 50px;
            width: 100%;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #42c0fb;
        }

        .step.finish::before {
            content: '\2713';
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
            border-radius: 10px;
            background: transparent;
        }

        #nextBtn,
        #prevBtn {
            border-radius: 3px;
            line-height: 10px;
            border: 1px solid #14467b;
        }

        #prevBtn {
            background-color: #ffffff;
            color: #14467b;
        }

        #nextBtn {
            background-color: #14467b;
            color: #ffffff;
        }

        .dr-details {
            display: flex;
            align-items: center;
        }

        .dr-image {
            width: 60px;
            height: 60px;
        }

        .dr-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .dr-info {
            margin-left: .75rem;
        }

        .dr-info h6 {
            margin-bottom: 0;
        }

        .fee-details {
            margin-top: 1rem;
        }

        .fee-details h6 {
            color: #8f8d8d;
            margin-bottom: 0;
        }

        .fee-details p {
            color: indigo;
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
        var doc_fee = '';
        var user_id;
        var fee;
        var paymentToken
        var public_date;
        var coupon;
        var hospital;


        document.addEventListener('DOMContentLoaded', function () {

            var $form = $("#appointmentForm");

            $('#hospital-check').click(function (e) {
                // $('#hospital-check-is').toggle();
                $('#hospital-check-file').toggle();

            });
            $("#coupon-btn").click(function (e) {

                coupon = $('#coupon').val();
                if (coupon == '') {
                    coupon = 'coupon';
                }
                hospital = 1;
                $.ajax({
                    url: `/api/get/schedules/${schedule_id}/${coupon}/coupon`,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                }).done(function (data) {

                    if (data != undefined) {
                        var htmlSchedules = '';
                        var element = data.schedules
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
                        $('#scheduleDoctor').html(htmlSchedules);
                        // $(".fee-details span p").remove();
                        doc_fee = `<p class="text">${element.price} INR</p>`
                        $('.fee-details span').html(doc_fee);
                    } else {
                        $('#scheduleDoctor').html("<h3>No Schedule found !</h3>");
                    }
                });
                // alert(dateString)

            });

            $('#book_appointment_submit').click(function (e) {
                validateAndPay(e);
                paymentToken = $form.find('input[name="stripeToken"]').val();
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
                        "coupon": coupon,
                        "hospital": hospital,
                        "comments": $('textarea[name="comments"]').val(),
                        'stripeToken': paymentToken,
                        'appointment_link':'',


                    },

                    cache: false,
                    timeout: 800000,
                })
                    .done(function (data) {
                        send_notification(user_id, 'Appointment No.' + data.msg, 'You have a new appointment');
                        document.getElementById("appointmentForm").reset();
                        window.location = BASE_URL + '/patient/appointments'
                    })
                    .fail(function (error) {
                        console.log(error);
                    });
            });

            $('#schedules').on("click", '.schedule_wrapper', function () {
                $('.appointment-form-ma .schedule_wrapper').removeClass('selected-slot');
                $(this).addClass('selected-slot');
                schedule_id = $(this).find('input[type="hidden"]').val();
                start = $(this).find('input[type="text"]').attr('start');
                end = $(this).find('input[type="text"]').attr('end');
                fee = $(this).find("span.amount-converted").html()
                $('#comments').show();
                $('#calenderwrapper').hide();
            });
            $('#next-comment').on("click", function () {
                $('#membership').show();
                $('#comments').hide();
            });
            $('#yes_has_reg').click(function () {

                $('#has_reg').toggle();
            });

            $('#next-payment').on("click", function () {
                $('#membership').hide();
                $('#payment').show();
                $('#book_appointment_submit').show();
            });

// ------------------------------------------------------

            let yourDate = new Date()
            const offset = yourDate.getTimezoneOffset()
            yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000))
            var userDatetimeZone = yourDate.toISOString().split("T")[0];
            public_date = userDatetimeZone;
            $.ajax({
                url: `/api/get/schedules/${doctor_id}/${userDatetimeZone}`,
                type: "GET",
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
            }).done(function (data) {
                var all_events = [];

                if (data != undefined && data.length != 0) {
                    user_id = data.user_id;
                    data.schedules.forEach(element => {
                        var dbDateStart = moment(element.start).format('YYYY-MM-DDTHH:mm:ss');
                        var dbDateEnd = moment(element.end).format('YYYY-MM-DDTHH:mm:ss');
                        all_events.push({
                            "id": element.id,
                            "doctor": element.doctor_id,
                            "start": dbDateStart,
                            "end": dbDateEnd,
                            "title": element.comment
                        })
                    });
                    var calendarEl = document.getElementById('doc-calender');

                    var doccalender = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            left: 'prev,next',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        initialView: 'timeGridWeek',
                        nowIndicator: true,
                        initialDate: new Date(),
                        events: all_events,
                        navLinks: true,
                        eventClick: function (info) {
                            var id = info.event.id;
                            schedule_id = id;
                            $.ajax({
                                url: `/api/get/schedules/${id}`,
                                type: "GET",
                                processData: false,
                                contentType: false,
                                cache: false,
                                timeout: 800000,
                            }).done(function (data) {
                                var element = data.schedules
                                if (element != undefined && element.length != 0) {
                                    var htmlSchedules = '';
                                    user_id = element.user_id;
                                    // data.schedules.forEach(element => {
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
                                    doc_fee += `<p class="text">${element.price} INR</p>`

                                    $('#scheduleDoctor').html(htmlSchedules);
                                    $('.fee-details span').html(doc_fee);

                                } else {
                                    $('#scheduleDoctor').html("<h3>No Schedule found !</h3>");
                                }
                            });
                        }
                    });
                    doccalender.render();
                }
            });

            function validateAndPay(e) {
                // var $form = $(".appointmentForm"),
                inputVal = ['input[type=text]', 'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
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
                var buttonforclick = document.getElementById("book_appointment_submit");
                buttonforclick.click();
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
                if (y[i].getAttribute("id") != "hospital-register-id") {
                    if (y[i].value == "" && y[i].getAttribute("name") != "coupon") {
                        y[i].className += " invalid";
                        valid = false;
                    }
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
