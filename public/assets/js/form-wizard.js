(function ($) {
    "use strict";
    // $.datetimepicker.setDateFormatter({
    //     parseDate: function (date, format) {
    //         var d = moment(date, format);
    //         return d.isValid() ? d.toDateTime() : false;
    //     },
    //     formatDate: function (date, format) {
    //         return moment(date).format(format);
    //     },
    // });
    $("#start").datetimepicker({

    });
    $("#end").datetimepicker({

    });
    $("#slot_belong").change(function () {
        if ($(this).is(":checked")) {
            $("#belong_effect").hide();
        } else {
             $("#belong_effect").show();
        }
    });
    // var baseUrl = `{{url('/')}}`;
    //valdate
    $("#form").validate({
        errorClass: "error fail-alert",
        validClass: "valid success-alert",
        rules: {
            doctor_id: {
                required: true,
            },
            start: {
                required: true,
            },
            end: {
                required: true,
            },
            interval: {
                required: true,
            },
        },
        // messages: {
        //     doctor_id: {
        //         required: "Please Select Doctor",
        //     },
        //     start: {
        //         required: "Please provide Start Date Time",
        //     },
        //     end: {
        //         required: "Please provide End Date Time",
        //     },
        //     interval: {
        //         required: "Please provide interval",
        //     },
        // },
    });
    // ACCORDION WIZARD
    var options = {
        mode: "wizard",
        autoButtonsNextClass: "btn btn-primary float-end",
        autoButtonsPrevClass: "btn btn-light",
        stepNumberClass: "badge rounded-pill bg-primary me-1",
        beforeBack: function (previousStep) {
            alert(1);
            return true;
        },
        beforeNextStep: function (currentStep) {
            if (!$("#form").valid())
                return false;
            var form = $("#form")[0];


            // FormData object
            var data = new FormData(form);
            var start = $("#start").datetimepicker("getValue");
            var end = $("#end").datetimepicker("getValue");

            var status = $("#status").is(":checked") ? 1 : 0;
            var slot_belong = $("#slot_belong").is(":checked") ? 1 : 0;
            var doctor_id = $("#doctor_id").find(":selected").val();
            // If you want to add an extra field for the FormData
            data.set("status", status);
            data.set("slot_belong", slot_belong);
            data.set("doctor_id", doctor_id);
            data.set("start", moment(start));
            data.set("end", moment(end));
            $.ajax({
                url: "/api/store/schedule/",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
            })
                .done(function (data) {
                    console.log(data);
                    var schedule_id = data.schedule_id;
                    $("#schedule_id").val(schedule_id);
                    var slots = data.slots;

                    var slotsHtml = "";
                    slots.forEach(function (row, index) {
                        var slot_time = row.slot;
                        var slot_id = row.slot_id;
                        var slot_price = row.price;
                        var time_span = `<span>${slot_time}</span>`;
                        var price_input = `<input type="number" class="form-control" value="${slot_price}" name="price[]">`;
                        var status_input = ` <input type="checkbox" checked class="form-checkbox" value="1"  name="status[]"> `;
                        var slot_id_input = `<input type="hidden" value="${slot_id}" name="slot_id[]">`;
                        slotsHtml += `<div class="form-group col-2 bg-green mx-1 "> <label><b>Slot</b> : ${time_span}  Status: ${status_input} </label> ${price_input} ${slot_id_input}</div>`;
                    });
                    $("#slots_required").html(slotsHtml);
                })
                .fail(function (error) {
                    console.log(error);
                });

            return true;
        },

        onSubmit: function () {
            var form = $("#form")[0];
            var data = new FormData(form);
            $.ajax({
                url: "/api/update/slots",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 800000,
            })
                .done(function (data) {
                    console.log(data);
                    if (data.msg == "done") window.location = "hospital/schedules";
                })
                .fail(function (error) {
                    console.log(error);
                });
            return false;
        },
    };
    $("#form").accWizard(options);
})(jQuery);

//Function to show image before upload

// function readURL(input) {
//     'use strict'

//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('.dropify-render img').remove();
//             var img = $('<img id="dropify-img">'); //Equivalent: $(document.createElement('img'))
//             img.attr('src', e.target.result);
//             img.appendTo('.dropify-render');
//             $(".dropify-preview").css("display", "block");
//             $(".dropify-clear").css("display", "block");
//         };
//         reader.readAsDataURL(input.files[0]);
//     }
// }
