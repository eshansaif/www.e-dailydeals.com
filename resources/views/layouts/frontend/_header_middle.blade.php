<div class="container">
    <div class="header-left">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('assets/frontend/assets/images/dd_logo.png') }}" alt="Daily Deals Logo">
        </a>
    </div><!-- End .header-left -->

    <div class="header-center">
        <div class="header-search">
            <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>
            <form action="{{ route('search.products') }}" method="post">
                @csrf
                <div class="header-search-wrapper">
                    <input type="search" class="form-control" name="product" id="q" placeholder="Search..." required>
                    <div class="select-custom">
                        <select id="cat" name="cat">
                            <option value="">All Categories</option>
                            <option value="4">Fashion</option>
                            <option value="12">- Women</option>
                            <option value="13">- Men</option>
                            <option value="66">- Jewellery</option>
                            <option value="67">- Kids Fashion</option>
                            <option value="5">Electronics</option>
                            <option value="21">- Smart TVs</option>
                            <option value="22">- Cameras</option>
                            <option value="63">- Games</option>
                            <option value="7">Home &amp; Garden</option>
                            <option value="11">Motors</option>
                            <option value="31">- Cars and Trucks</option>
                            <option value="32">- Motorcycles &amp; Powersports</option>
                            <option value="33">- Parts &amp; Accessories</option>
                            <option value="34">- Boats</option>
                            <option value="57">- Auto Tools &amp; Supplies</option>
                        </select>
                    </div><!-- End .select-custom -->
                    <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                </div><!-- End .header-search-wrapper -->
            </form>
        </div><!-- End .header-search -->
    </div><!-- End .headeer-center -->

    <div class="header-right">
        <button class="mobile-menu-toggler" type="button">
            <i class="icon-menu"></i>
        </button>
        <div class="header-contact">
            <span>Call us now</span>
            <a href="tel:#"><strong>+123 5678 890</strong></a>
        </div><!-- End .header-contact -->

        <div class="dropdown cart-dropdown">
            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                <span class="cart-count">2</span>
            </a>

            <div class="dropdown-menu" >
                <div class="dropdownmenu-wrapper">
                    <div class="dropdown-cart-products">
                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Woman Ring</a>
                                </h4>

                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $99.00
                                                </span>
                            </div><!-- End .product-details -->

                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('assets/frontend/assets/images/products/cart/product-1.jpg') }}" alt="product">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                            </figure>
                        </div><!-- End .product -->

                        <div class="product">
                            <div class="product-details">
                                <h4 class="product-title">
                                    <a href="product.html">Woman Necklace</a>
                                </h4>

                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">1</span>
                                                    x $35.00
                                                </span>
                            </div><!-- End .product-details -->

                            <figure class="product-image-container">
                                <a href="product.html" class="product-image">
                                    <img src="{{ asset('assets/frontend/assets/images/products/cart/product-2.jpg') }}" alt="product">
                                </a>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                            </figure>
                        </div><!-- End .product -->
                    </div><!-- End .cart-product -->

                    <div class="dropdown-cart-total">
                        <span>Total</span>

                        <span class="cart-total-price">$134.00</span>
                    </div><!-- End .dropdown-cart-total -->

                    <div class="dropdown-cart-action">
                        <a href="cart.html" class="btn">View Cart</a>
                        <a href="checkout-shipping.html" class="btn">Checkout</a>
                    </div><!-- End .dropdown-cart-total -->
                </div><!-- End .dropdownmenu-wrapper -->
            </div><!-- End .dropdown-menu -->
        </div><!-- End .dropdown -->
    </div><!-- End .header-right -->
</div><!-- End .container -->