$("#mic-btn").prop("disabled", true);
$("#video-btn").prop("disabled", true);
$("#screen-share-btn").prop("disabled", true);
$("#exit-btn").prop("disabled", true);

// $(document).ready(function () {
//     $("#modalForm").modal("show");
// });
var agoraAppId = $("#form-appid").val();
var token = $("#form-token").val();
var channelName = $("#form-channel").val();
var uid = parseInt($("#form-uid").val());
// $("#modalForm").modal("hide");
initClientAndJoinChannel(agoraAppId, token, channelName, uid);



