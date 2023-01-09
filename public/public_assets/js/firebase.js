$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
window.onload = function () {
    const firebaseConfig = {
        apiKey: "AIzaSyBc8YTR6-EF3sABfIDoOrcJMMiMrdYYnMY",
        authDomain: "drtele-fe555.firebaseapp.com",
        projectId: "drtele-fe555",
        storageBucket: "drtele-fe555.appspot.com",
        messagingSenderId: "466139943247",
        appId: "1:466139943247:web:a21d0b6d163a4e5e2cb53a",
        measurementId: "G-9CXB87FG9K",
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //reder captcha
    if ($("#recaptcha-container").length > 0) render();
    if (loggedIn) {
        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken();
            })
            .then(function (response) {
                $.ajax({
                    url: base_url() + "/api/store-token",
                    type: "POST",
                    data: {
                        token: response,
                        user_id: user_id,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        alert(error);
                    },
                });
            })
            .catch(function (error) {
                alert(error);
            });
        messaging.onMessage(function (payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    }
};
function render() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
        "recaptcha-container",
        {
            size: "invisible",
        }
    );
    recaptchaVerifier.render();
}
function sendOTP() {

    var number = $("#txtPhone").intlTelInput('getNumber');
    // var number = $("#txtPhone").val();
    // console.warn(number);
    // var phoneCode=$(".selected-dial-code").html();
    // var client_number=phoneCode+number;

    firebase
        .auth()
        .signInWithPhoneNumber(number, window.recaptchaVerifier)
        .then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
            $("#successAuth").text("OTP Sended Successfully.");
            $("#successAuth").show();
            $("#numbercon").hide();
            $("#verfiycon").show();
            setTimeout(function() {
                $("#resend").show();
            }, 30000);
            $("#numbercon").hide();
            $("#sendoptbtn").hide();
            $("#recaptcha-container").hide();
            $("#verifyoptbtn").show();
        })
        .catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
            $("#successAuth").hide();
        });
    return false;
}

function reSendOTP() {

    var number = $("#txtPhone").intlTelInput('getNumber');

    firebase
        .auth()
        .signInWithPhoneNumber(number, window.recaptchaVerifier)
        .then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
            $("#resend").hide();
            $("#successAuth").hide();
            $("#successAuth").text("OTP Resend Successfully");
            $("#successAuth").show();
            setTimeout(function() {
                $("#resend").show();
            }, 30000);
        })
        .catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
            $("#successAuth").hide();
        });
    return false;
}
function verify() {
    var code = $("#verification").val();
    coderesult
        .confirm(code)
        .then(function (result) {
            var user = result.user;
            console.log(user);
            $("#successAuth").text("Welcome!");
            $("#successAuth").show();
            $("#login_form").submit();
        })
        .catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
            $("#successAuth").hide();
        });
    return false;
}
// base url
function base_url() {
    var pathparts = location.pathname.split("/");
    if (location.host == "localhost") {
        var url = location.origin + "/" + pathparts[1].trim("/") + "/"; // http://localhost/myproject/
    } else {
        var url = location.origin; // http://stackoverflow.com
    }
    return url;
}
function send_notification(userId, title, body, Islink = false,owner=null) {


    $.ajax({
        url: base_url() + "/api/send-web-notification",
        type: "POST",
        data: {
            // token: response,
            user_id: userId,
            title: title,
            body: body,
            link: Islink,
            owner: owner,
        },
        dataType: "JSON",
        success: function (response) {
            // console.log(response.fire_base);
            console.log(response);
            if (response.conference_link != "")
                window.open(response.conference_link, "_blank");
        },
        error: function (error) {
            alert(error);
        },
    });
    return false;
}


function generate_token(userId) {
    var channelName = "first-channel" + userId;
    var token;
     $.ajax({
         url: "/api/agoraToken",
         type: "GET",
         data: {
             channel: channelName,
         },

         cache: false,
         timeout: 800000,
     })
         .done(function (data) {
           token=data.token;
            //  $("#form-token").val(data.token);
         })
         .fail(function (error) {
             console.log(error);
         });

    return {token,channelName};

}
 function convertCurrency(code) {
     $(".lang-name").html(code);
     $.ajax({
         url: base_url() + "/api/convert-currency",
         type: "get",
         data: {
             to: code,
         },
         dataType: "JSON",
         success: function (response) {
             console.log(response);
         },
         error: function (error) {
             alert(error);
         },
     });
 }
