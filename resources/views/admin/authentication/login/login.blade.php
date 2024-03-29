<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminex.themebucket.net/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:56:16 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">

    <title>Login</title>

    <link href="{{ asset('assets/backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/backend/css/style-responsive.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/backend/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/backend/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form class="form-signin form-group" action="{{ route('admin.login') }}" method="post" >
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Sign In</h1>
            <img src="{{ asset('assets/backend/images/login-logo.png') }}" alt=""/>
        </div>
        @if(session('message'))
            <span style="color: red; text-align: center" class="form-control login-wrap">{{ session('message') }}</span>
        @endif

        <div class="login-wrap">
            @csrf
            <input  name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="User Email" autofocus>
            @error('email')
            <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror
            <br>
            <input name="password" value="{{ old('password') }}" type="password" class="form-control" placeholder="Password">
            @error('password')
            <div class="pl-1 text-danger">{{ $message }}</div>
            @enderror

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check">Sign In</i>
            </button>

            <div class="registration">
                Not a member yet?
                <a class="" href="registration.html">
                    Signup
                </a>
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>

        </div>

        <!-- Modal -->
{{-- <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Forgot Password ?</h4>
             </div>
             <div class="modal-body">
                 <p>Enter your e-mail address below to reset your password.</p>
                 <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

             </div>
             <div class="modal-footer">
                 <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                 <button class="btn btn-primary" type="button">Submit</button>
             </div>
         </div>
     </div>
 </div>
 <!-- modal -->--}}

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="{{ asset('assets/backend/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/modernizr.min.js') }}"></script>

</body>

<!-- Mirrored from adminex.themebucket.net/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:56:16 GMT -->
</html>
