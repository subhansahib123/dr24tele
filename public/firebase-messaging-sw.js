importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

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
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(title, options);
});
