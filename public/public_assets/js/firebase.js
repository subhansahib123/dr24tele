

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
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

 window.onload = function () {
     render();
 };
 function render() {
     window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
         "recaptcha-container"
     );
     recaptchaVerifier.render();
 }
 function sendOTP() {
     var number = $("#number").val();
     firebase
         .auth()
         .signInWithPhoneNumber(number, window.recaptchaVerifier)
         .then(function (confirmationResult) {
             window.confirmationResult = confirmationResult;
             coderesult = confirmationResult;
             console.log(coderesult);
             $("#successAuth").text("Message sent");
             $("#successAuth").show();
             $("#numbercon").hide();
             $("#verfiycon").show();
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
 }
 function verify() {
     var code = $("#verification").val();
     coderesult
         .confirm(code)
         .then(function (result) {
             var user = result.user;
             console.log(user);
             $("#successAuth").text("Auth is successful");
             $("#successAuth").show();
         })
         .catch(function (error) {
             $("#error").text(error.message);
             $("#error").show();
             $("#successAuth").hide();
         });
 }
