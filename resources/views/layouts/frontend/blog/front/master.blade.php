<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.frontend.blog.front._head')
</head>

<body>

<!-- Preloader -->
<div class="preloader">
    <div class="preload-img">
        <div class="spinnerBounce">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
</div>
<!-- End of Preloader -->

<!-- Nav Search Box -->
<div class="nav-search-box">
    <form>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="eg. feel the love and …">
            <span class="b-line"></span>
            <span class="b-line-under"></span>
            <div class="input-group-append">
                <button type="button" class="btn">
                    <img src="{{ asset('assets/frontend/theme-front/images/search-icon.svg') }}" alt="" class="img-fluid svg">
                </button>
            </div>
        </div>
    </form>
</div>
<!-- End of Nav Search Box -->

<!-- Header -->
<header class="header">
    <div class="header-fixed">
        @include('layouts.frontend.blog.front._mainNav')
    </div>
</header>
<!-- End of Header -->

<!-- post with sidebar -->
<div class="container pt-40 pb-90">
    @yield('content')
</div>
<!-- end of post with sidebar -->

@include('layouts.frontend.blog.front._footer')

<!-- Back to Top Button -->
<div class="back-to-top d-flex align-items-center justify-content-center">
    <span><i class="fa fa-long-arrow-up"></i></span>
</div>
<!-- End of Back to Top Button -->
@include('layouts.frontend.blog.front._scripts')
</body>
</html>