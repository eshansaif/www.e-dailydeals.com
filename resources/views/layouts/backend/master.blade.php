<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminex.themebucket.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:54:15 GMT -->
<head>
    @include('layouts.backend._head')
</head>

<body class="sticky-header">

<section>
    <!-- left side start-->
    @include('layouts.backend._left_nav')
   <!-- left side end-->

    <!-- main content start-->
    <div class="main-content" >

        <!-- header section start-->
        @include('layouts.backend._header')
        <!-- header section end-->



        <!--body wrapper start-->
        @yield('content')
        <!--body wrapper end-->

        <!--footer section start-->
        @include('layouts.backend._footer')
        <!--footer section end-->


    </div>
    <!-- main content end-->
</section>

{{--All Scripts--}}
@include('layouts.backend._scripts')


</body>

<!-- Mirrored from adminex.themebucket.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:54:53 GMT -->
</html>
