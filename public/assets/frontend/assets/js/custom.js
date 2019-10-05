


/*
$(document).ready(function () {
    $("#selSize").change(function () {
        var idSize = $(this).val();

        $.ajax({
            type:'get',
            dataType: 'html',
            contentType: "application/json; charset=utf-8",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            url: "{{ url('get-product-price') }}",
            data:{idSize:idSize},
            success:function (resp) {
                alert(resp);
            },error:function () {
                alert("Error");
            }
        });
    });
});
*/

/*$(document).ready(function () {
    $("#selSize").change(function () {
        var idSize = $(this).val();
        alert(idSize);
    });
});*/



/*$(document).ready(function () {
    $("#selSize").change(function (){
        var idSize = $(this).val();
        $.ajax({
            type: 'get',
            dataType: 'JSON',
            url: 'get-product-price',
            data:{idSize:idSize},
            success:function (resp) {
                alert(resp);
            },error:function () {
                alert("Error");
            }

        });
    });
});*/

$(document).ready(function () {
    $("#selSize").change(function () {
        var idSize = $(this).val();
        //alert(idSize);
        $.ajax({
           type:'get',
            url: 'get-product-price',
            /*url: '{{ URL::action('/get-product-price/') }}',*/
            /*url: "{{ url('get-product-price')}}"+'/'+idSize,*/
            data:{idSize:idSize},
            success:function (resp) {
                alert(resp);
            },error:function () {
                //alert(xhr.status);
                alert("Error");
            }
        });
    });

});



