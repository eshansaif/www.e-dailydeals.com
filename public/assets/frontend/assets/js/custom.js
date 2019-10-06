

$().ready(function () {
    $("#registerForm").validate({
        rules:{
            name:{
                required:true,
                minlength:2,
                accept: "[a-zA-Z]+"
            },
            password:{
                required:true,
                minlength:6
            },
            email:{
                required:true,
                email:true,
                remote:"check-email"
            }
        },
        messages:{
            name:{
                required:"Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain letters only"
            },
            password:{
                required:"Please provide your Password",
                minlength: "Your Password must be atleast 6 characters long"
            },
            email:{
                required: "Please enter your Email",
                email: "Please enter valid Email",
                remote: "Email already exists!"
            }
        }
    });
});

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

/*$(document).ready(function () {
    $("#selSize").change(function () {
        var idSize = $(this).val();
        //alert(idSize);
        $.ajax({
           type:'get',
            url: 'get-product-price',
            /!*url: '{{ URL::action('/get-product-price/') }}',*!/
            /!*url: "{{ url('get-product-price')}}"+'/'+idSize,*!/
            data:{idSize:idSize},
            success:function (resp) {
                alert(resp);
            },error:function () {
                //alert(xhr.status);
                alert("Error");
            }
        });
    });

});*/



