<div class="container">
    <div class="header-left header-dropdowns">
        <div class="header-dropdown">
            <a href="#">USD</a>
            <div class="header-menu">
                <ul>
                    <li><a href="#">EUR</a></li>
                    <li><a href="#">USD</a></li>
                </ul>
            </div><!-- End .header-menu -->
        </div><!-- End .header-dropown -->

        <div class="header-dropdown">
            <a href="#"><img src="{{ asset('assets/frontend/assets/images/flags/en.png') }}" alt="England flag">ENGLISH</a>
            <div class="header-menu">
                <ul>
                    <li><a href="#"><img src="{{ asset('assets/frontend/assets/images/flags/en.png') }}" alt="England flag">ENGLISH</a></li>
                    <li><a href="#"><img src="{{ asset('assets/frontend/assets/images/flags/fr.png') }}" alt="France flag">FRENCH</a></li>
                </ul>
            </div><!-- End .header-menu -->
        </div><!-- End .header-dropown -->

        <div class="dropdown compare-dropdown">
            @php
                $user_email = \Illuminate\Support\Facades\Auth::user()->email;
                $compareCount = \App\Comparision::where(['user_email'=>$user_email])->count();
                    @endphp
            <a href="{{ route('compare') }}" {{--class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"--}}>
                <i class="icon-retweet"></i> Compare ({{ $compareCount }})
            </a>

            {{--<div class="dropdown-menu" >
                <div class="dropdownmenu-wrapper">
                    <ul class="compare-products">
                        <li class="product">
                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                            <h4 class="product-title"><a href="product.html">Lady White Top</a></h4>
                        </li>
                        <li class="product">
                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                            <h4 class="product-title"><a href="product.html">Blue Women Shirt</a></h4>
                        </li>
                    </ul>

                    <div class="compare-actions">
                        <a href="#" class="action-link">Clear All</a>
                        <a href="{{ route('compare') }}" class="btn btn-primary">Compare</a>
                    </div>
                </div><!-- End .dropdownmenu-wrapper -->
            </div>--}}<!-- End .dropdown-menu -->
        </div><!-- End .dropdown -->
    </div><!-- End .header-left -->

    <div class="header-right">
        @if(empty(Auth::check()))

            <p class="welcome-msg">Welcome to Dailydeals! </p>
        @else
            <p class="welcome-msg">Welcome {{ $userDetails->name }}! </p>
        @endif

        <div class="header-dropdown dropdown-expanded">
            <a href="#">Links</a>
            <div class="header-menu">
                <ul>

                    <li><a href="#">DAILY DEAL</a></li>
                    <li><a href="{{ route('wishlist') }}">MY WISHLIST </a></li>
                    <li><a href="blog.html">BLOG</a></li>
                    <li><a href="{{ route('page.contact_us') }}">Contact</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>

                    @if(empty(Auth::check()))
                        <li><a href="{{ route('customer.register_form') }}" class="">Register</a></li>
                        <li><a href="{{ route('customer.login_form') }}" class="">LOG IN</a></li>
                    @else
                    <li><a href="{{ route('customer.account') }}">MY ACCOUNT </a></li>
                    <li><a href="{{ route('customer.logout') }}">Logout </a></li>

                    @endif


                </ul>
            </div><!-- End .header-menu -->
        </div><!-- End .header-dropown -->
    </div><!-- End .header-right -->
</div><!-- End .container -->