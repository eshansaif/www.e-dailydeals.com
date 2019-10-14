
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
            },
            phone:{
                required:true,
                matches: "[0-9]+",
                minlength:11,
                maxlength:14
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
            },
            phone: {
                required: "Please provide your Phone Number",
                matches: "You must use a valid phone number",
                minlength: "Please provide a valid Phone no, It can't be less than 11",
                maxlength: "Please provide a valid Phone no, It can't be more than 14"
            }
        }
    });

    // Validate Login form on keyup and submit
    $("#loginForm").validate({
        rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        messages:{
            email:{
                required: "Please enter your Email",
                email: "Please enter valid Email"
            },
            password:{
                required:"Please provide your Password"
            }
        }
    });

    // Validate Register form on keyup and submit
    $("#accountForm").validate({
        rules:{
            name:{
                required:true,
                minlength:2,
                accept: "[a-zA-Z]+"
            },
            address:{
                required:true,
                minlength:6
            },
            zip:{
                required:true,
                minlength:4,
                number: true
            },
            city:{
                required:true,
                minlength:2
            },
            district:{
                required:true,
                minlength:2
            },
            country:{
                required:true
            },
            phone:{
                required:true,
                minlength:11,
                maxlength:15,
                number: true

            }
        },
        messages:{
            name:{
                required:"Please enter your Name",
                minlength: "Your Name must be atleast 2 characters long",
                accept: "Your Name must contain letters only"
            },
            address:{
                required:"Please provide your Address",
                minlength: "Your Address must be atleast 10 characters long"
            },
            zip:{
                required:"Please provide ypur Zip Code",
                minlength:"Zip cant be less than 4 digit!",
                number:"Zip code must be number"
            },
            city:{
                required:"Please provide your City",
                minlength: "Your City must be atleast 2 characters long"
            },
            district:{
                required:"Please provide your State",
                minlength: "Your State must be atleast 2 characters long"
            },
            country:{
                required:"Please select your Country"
            },
            phone:{
                required:"Please provide your Phone number",
                minlength:"Phone number cant be less than 11 digit!",
                maxlength:"Phone number cant be more than 15 digit!",
                number:"Phone number must be numeric number!"
            }
        }
    });

    $("#passwordForm").validate({
        rules:{
            current_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            new_pwd:{
                required: true,
                minlength:6,
                maxlength:20
            },
            confirm_pwd:{
                required:true,
                minlength:6,
                maxlength:20,
                equalTo:"#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    // Check Current User Password
    $("#current_pwd").keyup(function(){
        var current_pwd = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'check-user-pwd',
            data:{current_pwd:current_pwd},
            success:function(resp){
                /*alert(resp);*/
                if(resp=="false"){
                    $("#chkPwd").html("<font color='red'>Current Password is incorrect</font>");
                }else if(resp=="true"){
                    $("#chkPwd").html("<font color='green'>Current Password is correct</font>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Copy Billing Address to Shipping Address Script
    $("#copyAddress").click(function(){
        if(this.checked){
            $("#shipping_name").val($("#billing_name").val());
            $("#shipping_address").val($("#billing_address").val());
            $("#shipping_zip").val($("#billing_zip").val());
            $("#shipping_city").val($("#billing_city").val());
            $("#shipping_district").val($("#billing_district").val());
            $("#shipping_country").val($("#billing_country").val());
            $("#shipping_phone").val($("#billing_phone").val());
        }else{
            $("#shipping_name").val('');
            $("#shipping_address").val('');
            $("#shipping_zip").val('');
            $("#shipping_city").val('');
            $("#shipping_district").val('');
            $("#shipping_country").val('');
            $("#shipping_phone").val('');
        }
    });

    // Password Strength Script
    $('#password').passtrength({
        minChars: 4,
        passwordToggle: true,
        tooltip: true,
        eyeImg : "assets/frontend/assets/images/eye.svg"
    });



});

function selectPaymentMethod(){
    if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
        /*alert("checked");*/
    }else{
        alert("Please select Payment Method");
        return false;
    }
}



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





