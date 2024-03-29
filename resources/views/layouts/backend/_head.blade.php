<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
<meta name="description" content="">
<meta name="author" content="ThemeBucket">
<link rel="shortcut icon" href="#" type="image/png">

<title>{{isset($title)?$title:config('app.name')}}</title>


{{--wysihtml5 editor--}}
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var maxField = 5; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div class="field_wrapper" style="margin-left: 116px;: ">' +
            '<div>' +
            '<input type="text" name="sku[]" id="sku" style="width: 120px; margin-right: 4px; margin-top: 2px;" placeholder="SKU" s/>' +
            '<input type="text" name="size[]" id="size" style="width: 120px; margin-right: 4px; margin-top: 2px;" placeholder="Size"/>' +
            '<input type="text" name="price[]" id="price" style="width: 120px; margin-right: 4px; margin-top: 2px;" placeholder="Price"/>' +
            '<input type="text" name="stock[]" id="stock" style="width: 120px; margin-right: 4px; margin-top: 2px;" placeholder="Stock"/>' +
            '<a href="javascript:void(0);" class="remove_button">Remove</a>' +
            '</div>' +
            '</div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>



<!--icheck-->
<link href="{{asset('assets/backend/js/iCheck/skins/minimal/minimal.css')}}" rel="stylesheet">
<link href="{{asset('assets/backend/js/iCheck/skins/square/square.css')}}" rel="stylesheet">
<link href="{{asset('assets/backend/js/iCheck/skins/square/red.css')}}" rel="stylesheet">
<link href="{{asset('assets/backend/js/iCheck/skins/square/blue.css')}}" rel="stylesheet">

<!--dashboard calendar-->
<link href="{{asset('assets/backend/css/clndr.css')}}" rel="stylesheet">

<!--data table-->
<link href="{{ asset('assets/backend/js/advanced-datatable/css/demo_page.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/backend/js/advanced-datatable/css/demo_table.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/backend/js/data-tables/DT_bootstrap.css') }}" />


<!--common-->
<link href="{{asset('assets/backend/css/style.css')}}" rel="stylesheet">
<link href="{{asset('assets/backend/css/style-responsive.css')}}" rel="stylesheet">

<!-- font-awesome CDN -->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<!--SweetAlert CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

<script src="{{asset('assets/backend/js/custom.js')}}"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>

<script src="{{asset('assets/backend/js/html5shiv.js')}}"></script>
<script src="{{asset('assets/backend/js/respond.min.js')}}"></script>


<![endif]-->