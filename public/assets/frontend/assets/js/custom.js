/*

$(document).ready(function () {
    $("#selSize").change(function (){
       var idSize = $(this).val();
       $.ajax({
          type: 'get',
           url: '/get-product-price',
           data:{idSize:idSize},
           success:function (resp) {
               /!*alert(resp);*!/
           },error:function () {
               alert("Error");
           }

       });
    });
});*/
