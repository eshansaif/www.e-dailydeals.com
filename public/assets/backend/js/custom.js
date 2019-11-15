$(document).ready(function () {
    $("#access").hide();
   $("#type").change(function () {
       var type = $("#type").val();
       if (type == "Admin"){
           $("#access").hide();
       }else{
           $("#access").show();
       }
   })
});