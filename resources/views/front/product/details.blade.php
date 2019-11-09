@extends('layouts.frontend.master')
@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name  }}</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="product-single-container product-single-default">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 product-single-gallery">
                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">
                                    @foreach($product->product_image as $image)
                                        <div class="product-item">
                                            <img style="width: 470.04px; height: 470.04px;" class="product-single-image" src="{{ asset($image->file_path) }}" data-zoom-image="{{ asset($image->file_path) }}"/>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                            </div>
                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                @foreach($product->product_image as $image)
                                    <div class="col-3 owl-dot">
                                        <img style="width: 110px; height: 110px;" src="{{ asset($image->file_path) }}"/>
                                    </div>
                                @endforeach

                            </div>
                        </div><!-- End .col-lg-7 -->

                        <div class="col-lg-5 col-md-6">
                            <div class="product-single-details">
                                <h1 class="product-title">{{ $product->name }}</h1>

                                        <ul>
                                            <li>Brand: <a href="#" class="rating-link">{{ $product->brand->name}}</a></li>
                                            <li>Code: {{ $product->code }}</li>
                                            <li>
                                                <select id="selSize" name="size"  style="width: 100px">
                                                    <option value="">Sizes</option>
                                                    @foreach($product_details->product_attributes as $sizes)
                                                        <option {{--id="idSize"--}} value="{{ $product_details->id }}{{ $sizes->size }}">{{ $sizes->size }}</option>
                                                    @endforeach
                                                </select>
                                            </li>
                                            <li>Available Sizes:</li>
                                            <li>
                                                <div class="widget-body">
                                                    <ul class="config-size-list">

                                                        @foreach($product->product_attributes as $sizes)
                                                            <li  class=""><a  href="#"><strong>{{ $sizes->size }}</strong></a></li>

                                                        @endforeach
                                                    </ul>
                                                </div>

                                            </li>
                                            <li><strong>Availability:</strong>@if($total_stock > 0) In Stock @else Out of Stock @endif</li>
                                        </ul>



                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->

                                    <a href="#" class="rating-link">( 6 Reviews )</a>
                                </div><!-- End .product-container -->

                                <div class="price-box">
                                    <span class="old-price">৳ 81.00/-</span>
                                    <span id="getPrice" class="product-price">৳ {{ $product->price }}/-</span>
                                </div><!-- End .price-box -->

                                {{--<div class="product-desc">
                                    <p>{{ str_limit($product->description,100) }}</p>
                                </div><!-- End .product-desc -->--}}


                                <div class="product-filters-container">
                                    <div class="product-single-filter">
                                        <label>Colors:</label>
                                        <ul class="config-swatch-list">
                                            <li class="active">
                                                <a href="#" style="background-color: #6085a5;"></a>
                                            </li>
                                            <li>
                                                <a href="#" style="background-color: #ab6e6e;"></a>
                                            </li>
                                            <li>
                                                <a href="#" style="background-color: #b19970;"></a>
                                            </li>
                                            <li>
                                                <a href="#" style="background-color: #11426b;"></a>
                                            </li>
                                        </ul>
                                    </div><!-- End .product-single-filter -->
                                </div><!-- End .product-filters-container -->


                                <form name="addToCartFrom" id="addToCartForm" method="post" action="{{ route('add-cart') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="name" value="{{ $product->name }}">
                                    <input type="hidden" name="code" value="{{ $product->code }}">
                                    <input type="hidden" name="color" value="{{ $product->color }}">
                                    <input type="hidden" name="price" value="{{ $product->price }}">
                                    <input type="hidden" name="size" value="{{ $product->size }}">



                                @if($total_stock > 0)
                                <div class="product-action product-all-icons">
                                    <div class="product-single-qty">
                                        <input name="quantity" class="horizontal-quantity form-control" type="text">
                                    </div><!-- End .product-single-qty -->

                                    <button  class="paction add-cart" title="Add to Cart" id="cartButton" name="cartButton" value="Cart">
                                        <span class="">Add to Cart</span>
                                    </button>
                                    <button  class="paction add-wishlist" title="Add to Wishlist" id="wishlistButton" name="wishlistButton" value="Wish List">
                                        <span>Add to Wishlist</span>
                                    </button>
                                    <button type="submit" href="#" class="paction add-compare" title="Add to Compare" id="compareButton" name="compareButton" value="Add to Compare">
                                        <span>Add to Compare</span>
                                    </button>
                                </div><!-- End .product-action -->
                                @endif
                                </form>

                                <div class="product-single-share">
                                    <label>Share:</label>
                                    <!-- www.addthis.com share plugin-->
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div><!-- End .product single-share -->
                            </div><!-- End .product-single-details -->
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .product-single-container -->


                <div class="product-single-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content" role="tab" aria-controls="product-tags-content" aria-selected="false">Tags</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                            <div class="product-desc-content">
                                <p>@php echo nl2br($product->description)  @endphp</p>
                                <ul>
                                    <li  class="fas fa-align-justify">List of Available sizes:</li>
                                    @foreach($product->product_attributes as $size)
                                        <li><i class="icon-ok"></i>{{ $size->size }}</li>
                                    @endforeach

                                </ul>
                                <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, <br>quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                            <div class="product-tags-content">
                                <form action="#">
                                    <h4>Add Your Tags:</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" required>
                                        <input type="submit" class="btn btn-primary" value="Add Tags">
                                    </div><!-- End .form-group -->
                                </form>
                                <p class="note">Use spaces to separate tags. Use single quotes (') for phrases.</p>
                            </div><!-- End .product-tags-content -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                            <div class="product-reviews-content">
                                <div class="collateral-box">
                                    <ul>
                                        <li>Be the first to review this product</li>
                                    </ul>
                                </div><!-- End .collateral-box -->

                                <div class="add-product-review">
                                    <h3 class="text-uppercase heading-text-color font-weight-semibold">WRITE YOUR OWN REVIEW</h3>
                                    <p>How do you rate this product? *</p>

                                    <form action="#">
                                        <table class="ratings-table">
                                            <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>1 star</th>
                                                <th>2 stars</th>
                                                <th>3 stars</th>
                                                <th>4 stars</th>
                                                <th>5 stars</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Quality</td>
                                                <td>
                                                    <input type="radio" name="ratings[1]" id="Quality_1" value="1" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="ratings[1]" id="Quality_2" value="2" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="ratings[1]" id="Quality_3" value="3" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="ratings[1]" id="Quality_4" value="4" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="ratings[1]" id="Quality_5" value="5" class="radio">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Value</td>
                                                <td>
                                                    <input type="radio" name="value[1]" id="Value_1" value="1" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="value[1]" id="Value_2" value="2" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="value[1]" id="Value_3" value="3" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="value[1]" id="Value_4" value="4" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="value[1]" id="Value_5" value="5" class="radio">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Price</td>
                                                <td>
                                                    <input type="radio" name="price[1]" id="Price_1" value="1" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="price[1]" id="Price_2" value="2" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="price[1]" id="Price_3" value="3" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="price[1]" id="Price_4" value="4" class="radio">
                                                </td>
                                                <td>
                                                    <input type="radio" name="price[1]" id="Price_5" value="5" class="radio">
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <label>Nickname <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label>Summary of Your Review <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group mb-2">
                                            <label>Review <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                        </div><!-- End .form-group -->

                                        <input type="submit" class="btn btn-primary" value="Submit Review">
                                    </form>
                                </div><!-- End .add-product-review -->
                            </div><!-- End .product-reviews-content -->
                        </div><!-- End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-single-tabs -->
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
            <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
                <div class="sidebar-wrapper">
                    <div class="widget widget-brand">
                        <a href="#">
                            <img src="{{ asset($product->brand->file) }}" alt="brand name">
                        </a>
                    </div><!-- End .widget -->

                    <div class="widget widget-info">
                        <ul>
                            <li>
                                <i class="icon-shipping"></i>
                                <h4>FREE<br>SHIPPING</h4>
                            </li>
                            <li>
                                <i class="icon-us-dollar"></i>
                                <h4>100% MONEY<br>BACK GUARANTEE</h4>
                            </li>
                            <li>
                                <i class="icon-online-support"></i>
                                <h4>ONLINE<br>SUPPORT 24/7</h4>
                            </li>
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget widget-banner">
                        <div class="banner banner-image">
                            <a href="#">
                                <img src="{{ asset('assets/frontend/assets/images/banners/banner-sidebar.jpg') }}" alt="Banner Desc">
                            </a>
                        </div><!-- End .banner -->
                    </div><!-- End .widget -->

                    <div class="widget widget-featured">
                        <h3 class="widget-title">Related Products</h3>

                        <div class="widget-body">
                            <div class="owl-carousel widget-featured-products">
                                <div class="featured-col">

                                    @foreach($related_products as $index=>$product)
                                        @if($index <= 2)
                                    <div class="product product-sm">
                                        <figure class="product-image-container">
                                            <a href="{{ route('product.details', $product->id) }}" class="product-image">
                                                <img style="height: 80px; width: 70px" src="{{ asset(isset($product->product_image[0])?$product->product_image[0]->file_path:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h2 class="product-title">
                                                <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                <span class="product-price">৳ {{ $product->price }}/-</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                        @endif
                                    @endforeach

                                </div><!-- End .featured-col -->

                                <div class="featured-col">
                                    @foreach($related_products as $index=>$product)
                                        @if($index >= 3)
                                    <div class="product product-sm">
                                        <figure class="product-image-container">
                                            <a href="{{ route('product.details', $product->id) }}" class="product-image">
                                                <img style="height: 80px; width: 70px" src="{{ asset(isset($product->product_image[0])?$product->product_image[0]->file_path:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h2 class="product-title">
                                                <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="ratings-container">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                </div><!-- End .product-ratings -->
                                            </div><!-- End .product-container -->
                                            <div class="price-box">
                                                {{--<span class="old-price">$50.00</span>--}}
                                                <span class="product-price">৳ {{ $product->price }}/-</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div><!-- End .product -->
                                        @endif
                                    @endforeach

                                </div><!-- End .featured-col -->
                            </div><!-- End .widget-featured-slider -->
                        </div><!-- End .widget-body -->
                    </div><!-- End .widget -->
                </div>
            </aside><!-- End .col-md-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="featured-section">
        <div class="container">
            <h2 class="carousel-title">Featured Products</h2>

            <div class="featured-products owl-carousel owl-theme owl-dots-top">
                @if(isset($featured_products))
                    @foreach($featured_products as $product)
                        @include('front.product._list')
                {{--<div class="product">
                    <figure class="product-image-container">
                        <a href="product.html" class="product-image">
                            <img style="height: 225.2px; width: 225.2px" src="{{ asset(isset($product->product_image[0])?$product->product_image[0]->file_path:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
                        </a>
                        <a href="ajax/product-quick-view.html" class="btn-quickview">Quick View</a>
                    </figure>
                    <div class="product-details">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Felt Hat</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$39.00</span>
                        </div><!-- End .price-box -->

                        <div class="product-action">
                            <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                <span>Add to Wishlist</span>
                            </a>

                            <a href="product.html" class="paction add-cart" title="Add to Cart">
                                <span>Add to Cart</span>
                            </a>

                            <a href="#" class="paction add-compare" title="Add to Compare">
                                <span>Add to Compare</span>
                            </a>
                        </div><!-- End .product-action -->
                    </div><!-- End .product-details -->
                </div><!-- End .product -->--}}
                 @endforeach
                @endif

            </div><!-- End .featured-proucts -->
        </div><!-- End .container -->
    </div><!-- End .featured-section -->
@endsection