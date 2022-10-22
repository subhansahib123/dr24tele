@extends('public_panel.layout.master');

@section('content')
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

        <section class="appointment-form-wrap ptb-100">
            <div class="container- p-0">
                <div id="main-container" class="row">
                    <div class="col-xl-12 col-lg-12 col-12">
                        <div id="screen-share-btn-container " class="col-2 text-right mt-2 d-none">
                            <button id="screen-share-btn" type="button" class="btn btn-lg">
                                <i id="screen-share-icon" class="fas fa-desktop"></i>
                            </button>
                        </div>
                        <div id="buttons-container" class="row justify-content-center mt-3">
                            <div class="col-md-2 text-center">
                                <button id="mic-btn" type="button" class="btn btn-block btn-dark btn-lg">
                                    <i id="mic-icon" class="fas fa-microphone"></i>
                                </button>
                            </div>
                            <div class="col-md-2 text-center">
                                <button id="video-btn" type="button" class="btn btn-block btn-dark btn-lg">
                                    <i id="video-icon" class="fas fa-video"></i>
                                </button>
                            </div>
                            <div class="col-md-2 text-center">
                                <button id="exit-btn" type="button" class="btn btn-block btn-danger btn-lg">
                                    <i id="exit-icon" class="fas fa-phone-slash"></i>
                                </button>
                            </div>
                        </div>
                        <div id="full-screen-video"></div>
                        <div id="lower-video-bar" class="row mb-1">
                            <div id="remote-streams-container" class="container col-12 ml-1">
                                <div id="remote-streams" class="row">
                                    <!-- insert remote streams dynamically -->
                                </div>
                            </div>
                            <div id="local-stream-container" class="col-12 p-0">
                                <div id="mute-overlay" class="col">
                                    <i id="mic-icon" class="fas fa-microphone-slash"></i>
                                </div>
                                <div id="no-local-video" class="col text-center">
                                    <i id="user-icon" class="fas fa-user"></i>
                                </div>
                                <div id="local-video" class="col p-0"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>
    <div class="modal fade" id="modalForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Join Channel</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-4">
                        <input type="text" id="form-appid" value="e4fc13e59b1d4105b5dd434a56a2bf94" readonly
                            class="form-control">
                        <label for="form-appid">Agora AppId</label>
                    </div>
                    <div class="md-form mb-4">
                        <input type="text" id="form-token" class="form-control">
                        <label for="form-token">Agora Token</label>
                    </div>
                    <div class="md-form mb-4">
                        <input type="text" id="form-channel" value="first-channel" class="form-control">
                        <label for="form-channel">Channel</label>
                    </div>
                    <div class="md-form mb-4">
                        <input type="number" id="form-uid" class="form-control" value="1001" data-decimals="0" />
                        <label for="form-uid">UID</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button id="join-channel" class="btn btn-primary">Join Channel</button>
                </div>
            </div>
        </div>
    </div>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src='{{ asset('public_assets/js/AgoraRTCSDK.min.js') }}'></script>
<script src='{{ asset('public_assets/js/agora-interface.js') }}'></script>
<script src="{{asset('public_assets/js/custom-Agora.js')}}"></script>
<style>
    #player_1001{
        height: 100vh !important;
    }
    .after_join{
        position: absolute;
        top: 165px;
        width: 100vw;
        height: 100%;
        background: #2490eb;
        z-index: 9;
    }
    @media screen and (max-width:768px){
        .after_join{
            top:315px
        }
    }

#buttons-container {
  position: absolute;
  z-index: 2;
  width: 100vw;
  bottom: 0;
}

#full-screen-video {
  position: absolute;
  width: 100vw;
  height: 100vh;
}

#lower-video-bar {
  height: 20vh;
}

#local-stream-container {
  position: relative;
  display: inline-block;
}

.remote-stream-container {
  display: inline-block;
}

#remote-streams {
  height: 100%;
}

#local-video {
  position: absolute;
  z-index: 1;
  height: 115vh;
  max-width: 100%;
}

.remote-video {
  position: absolute;
  z-index: 1;
  height: 100% !important;
  width: 80%;
  max-width: 500px;
}

#mute-overlay {
  position: absolute;
  z-index: 2;
  bottom: 0;
  left: 0;
  color: #d9d9d9;
  font-size: 2em;
  padding: 0 0 3px 3px;
  display: none;
}

.mute-overlay {
  position: absolute;
  z-index: 2;
  top: 2px;
  color: #d9d9d9;
  font-size: 1.5em;
  padding: 2px 0 0 2px;
  display: none;
}

#no-local-video, .no-video-overlay {
  position: absolute;
  z-index: 3;
  width: 100%;
  top: 40%;
  color: #cccccc;
  font-size: 2.5em;
  margin: 0 auto;
  display: none;
}

.no-video-overlay {
  width: 80%;
}

#screen-share-btn-container {
  z-index: 99;
}
</style>



    <script>
        //
        $('#join-channel').click(function(){
            $('#main-container').addClass('after_join');
        })

        // UI buttons
        function enableUiControls(localStream) {

            $("#mic-btn").prop("disabled", false);
            $("#video-btn").prop("disabled", false);
            $("#screen-share-btn").prop("disabled", false);
            $("#exit-btn").prop("disabled", false);

            $("#mic-btn").click(function() {
                toggleMic(localStream);
            });

            $("#video-btn").click(function() {
                toggleVideo(localStream);
            });

            $("#screen-share-btn").click(function() {
                toggleScreenShareBtn(); // set screen share button icon
                $("#screen-share-btn").prop("disabled", true); // disable the button on click
                if (screenShareActive) {
                    stopScreenShare(localStream);
                } else {
                    initScreenShare(localStream);
                }
            });

            $("#exit-btn").click(function() {
                console.log("so sad to see you leave the channel");
                leaveChannel();
            });

            // keyboard listeners
            $(document).keypress(function(e) {
                switch (e.key) {
                    case "m":
                        console.log("squick toggle the mic");
                        toggleMic(localStream);
                        break;
                    case "v":
                        console.log("quick toggle the video");
                        toggleVideo(localStream);
                        break;
                    case "s":
                        console.log("initializing screen share");
                        toggleScreenShareBtn(); // set screen share button icon
                        $("#screen-share-btn").prop("disabled", true); // disable the button on click
                        if (screenShareActive) {
                            stopScreenShare(localStream);
                        } else {
                            initScreenShare(localStream);
                        }
                        break;
                    case "q":
                        console.log("so sad to see you quit the channel");
                        leaveChannel();
                        break;
                    default: // do nothing
                }

                // (for testing)
                if (e.key === "r") {
                    window.history.back(); // quick reset
                }
            });
        }

        function toggleBtn(btn) {
            btn.toggleClass('btn-dark').toggleClass('btn-danger');
        }

        function toggleScreenShareBtn() {
            $('#screen-share-btn').toggleClass('btn-danger');
            $('#screen-share-icon').toggleClass('fa-share-square').toggleClass('fa-times-circle');
        }

        function toggleVisibility(elementID, visible) {
            if (visible) {
                $(elementID).attr("style", "display:block");
            } else {
                $(elementID).attr("style", "display:none");
            }
        }

        function toggleMic(localStream) {
            toggleBtn($("#mic-btn")); // toggle button colors
            $("#mic-icon").toggleClass('fa-microphone').toggleClass('fa-microphone-slash'); // toggle the mic icon
            if ($("#mic-icon").hasClass('fa-microphone')) {
                localStream.enableAudio(); // enable the local mic
                toggleVisibility("#mute-overlay", false); // hide the muted mic icon
            } else {
                localStream.disableAudio(); // mute the local mic
                toggleVisibility("#mute-overlay", true); // show the muted mic icon
            }
        }

        function toggleVideo(localStream) {
            toggleBtn($("#video-btn")); // toggle button colors
            $("#video-icon").toggleClass('fa-video').toggleClass('fa-video-slash'); // toggle the video icon
            if ($("#video-icon").hasClass('fa-video')) {
                localStream.enableVideo(); // enable the local video
                toggleVisibility("#no-local-video", false); // hide the user icon when video is enabled
            } else {
                localStream.disableVideo(); // disable the local video
                toggleVisibility("#no-local-video", true); // show the user icon when video is disabled
            }
        }
    </script>

