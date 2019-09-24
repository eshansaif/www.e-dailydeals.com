<div class="container">
    <nav class="main-nav">
        <ul class="menu sf-arrows">
            <li class="active"><a href="{{ route('home') }}">Home</a></li>
            <li>
                <a href="category.html" class="sf-with-ul">Categories</a>
                <div class="megamenu megamenu-fixed-width">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="menu-title">
                                        <a href="{{ route('front.product.index') }}">All CategoriesWise<span class="tip tip-new">Product!</span></a>
                                    </div>
                                    <ul>
                                        @foreach($categories as $id=>$category)
                                        <li><a href="{{ route('front.product.index',$id) }}">{{ $category }}{{--<span class="tip tip-hot">Hot!</span>--}}</a></li>
                                        @endforeach
                                    </ul>
                                </div><!-- End .col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="menu-title">
                                        <a href="#">Variations 2</a>
                                    </div>
                                    <ul>
                                        <li><a href="#">Product List Item Types</a></li>
                                        <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll</a></li>
                                        <li><a href="category.html">3 Columns Products</a></li>
                                        <li><a href="category-4col.html">4 Columns Products <span class="tip tip-new">New</span></a></li>
                                        <li><a href="category-5col.html">5 Columns Products</a></li>
                                        <li><a href="category-6col.html">6 Columns Products</a></li>
                                        <li><a href="category-7col.html">7 Columns Products</a></li>
                                        <li><a href="category-8col.html">8 Columns Products</a></li>
                                    </ul>
                                </div><!-- End .col-lg-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="banner">
                                <a href="#">
                                    <img src="{{ asset('assets/frontend/assets/images/menu-banner-2.jpg') }}" alt="Menu banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-4 -->
                    </div>
                </div><!-- End .megamenu -->
            </li>
            <li class="megamenu-container">
                <a href="product.html" class="sf-with-ul">Products</a>
                <div class="megamenu">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="menu-title">
                                        <a href="#">Variations</a>
                                    </div>
                                    <ul>
                                        <li><a href="product.html">Horizontal Thumbnails</a></li>
                                        <li><a href="product-full-width.html">Vertical Thumbnails<span class="tip tip-hot">Hot!</span></a></li>
                                        <li><a href="product.html">Inner Zoom</a></li>
                                        <li><a href="product-addcart-sticky.html">Addtocart Sticky</a></li>
                                        <li><a href="product-sidebar-left.html">Accordion Tabs</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="menu-title">
                                        <a href="#">Variations</a>
                                    </div>
                                    <ul>
                                        <li><a href="product-sticky-tab.html">Sticky Tabs</a></li>
                                        <li><a href="product-simple.html">Simple Product</a></li>
                                        <li><a href="product-sidebar-left.html">With Left Sidebar</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="menu-title">
                                        <a href="#">Product Layout Types</a>
                                    </div>
                                    <ul>
                                        <li><a href="product.html">Default Layout</a></li>
                                        <li><a href="product-extended-layout.html">Extended Layout</a></li>
                                        <li><a href="product-full-width.html">Full Width Layout</a></li>
                                        <li><a href="product-grid-layout.html">Grid Images Layout</a></li>
                                        <li><a href="product-sticky-both.html">Sticky Both Side Info<span class="tip tip-hot">Hot!</span></a></li>
                                        <li><a href="product-sticky-info.html">Sticky Right Side Info</a></li>
                                    </ul>
                                </div><!-- End .col-lg-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="banner">
                                <a href="#">
                                    <img class="product-promo" src="assets/images/menu-banner.jpg') }}" alt="Menu banner">
                                </a>
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-4 -->
                    </div>
                </div><!-- End .megamenu -->
            </li>
            <li>
                <a href="#" class="sf-with-ul">Pages</a>

                <ul>
                    <li><a href="cart.html">Shopping Cart</a></li>
                    <li><a href="#">Checkout</a>
                        <ul>
                            <li><a href="checkout-shipping.html">Checkout Shipping</a></li>
                            <li><a href="checkout-shipping-2.html">Checkout Shipping 2</a></li>
                            <li><a href="checkout-review.html">Checkout Review</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Dashboard</a>
                        <ul>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="my-account.html">My Account</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="#">Blog</a>
                        <ul>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="single.html">Blog Post</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#" class="login-link">Login</a></li>
                    <li><a href="forgot-password.html">Forgot Password</a></li>
                </ul>
            </li>
            <li><a href="#" class="sf-with-ul">Features</a>
                <ul>
                    <li><a href="#">Header Types</a></li>
                    <li><a href="#">Footer Types</a></li>
                </ul>
            </li>
            <li class="float-right"><a href="#">Buy Porto!</a></li>
            <li class="float-right"><a href="#">Special Offer!</a></li>
        </ul>
    </nav>
</div><!-- End .header-bottom -->