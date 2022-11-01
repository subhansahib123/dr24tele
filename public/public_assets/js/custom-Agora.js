$("#mic-btn").prop("disabled", true);
$("#video-btn").prop("disabled", true);
$("#screen-share-btn").prop("disabled", true);
$("#exit-btn").prop("disabled", true);
   $.ajax({
       url: "/api/agoraToken",
       type: "GET",
       data: {
           channel: "first-channel",
       },

       cache: false,
       timeout: 800000,
   })
       .done(function (data) {
           console.log(data.token);
           $("#form-token").val(data.token);
       })
       .fail(function (error) {
           console.log(error);
       });
// $(document).ready(function () {
//     $("#modalForm").modal("show");
// });
var agoraAppId = $("#form-appid").val();
var token = $("#form-token").val();
var channelName = $("#form-channel").val();
var uid = parseInt($("#form-uid").val());
// $("#modalForm").modal("hide");
initClientAndJoinChannel(agoraAppId, token, channelName, uid);



