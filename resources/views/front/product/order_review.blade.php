@extends('layouts.frontend.master')
@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <ul class="checkout-progress-bar">
            <li>
                <span>Shipping</span>
            </li>
            <li class="active">
                <span>Review &amp; Payments</span>
            </li>
        </ul>
        <div class="row">
            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>Review Ordered Products</h3>

                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">{{ count($user_cart) }} products in Cart</a>
                    </h4>

                    <div class="{{--collapse--}}" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>

                            @php $total_amount = 0; @endphp
                            @foreach($user_cart as $item)
                                <tr>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset(isset($item->file)?$item->file:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
                                            </a>
                                        </figure>
                                        <div>
                                            <h2 class="product-title">
                                                <a href="product.html">{{ $item->name }}</a>
                                            </h2>

                                            <span class="product-qty">Qty: {{ $item->quantity }}</span>
                                        </div>
                                    </td>
                                    <td class="price-col">৳{{ $item->price * $item->quantity }}/-</td>
                                </tr>

                                @php
                                    $total_amount = $total_amount + ($item->price * $item->quantity);
                                @endphp
                            @endforeach
                            <tr>
                                <td><strong>Sub Total</strong></td>
                                <td><strong>৳ @php echo $total_amount; @endphp/-</strong></td>
                            </tr>

                            <tr>
                                <td>Discount Price(Coupon)</td>
                                @if(!empty(Session::get('CouponAmount')))

                                <td>৳{{ Session::get('CouponAmount') }}/-</td>

                                @else

                                <td>৳ 0/- </td>

                                @endif
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td>৳ 0/-</td>
                            </tr>
                            </tbody>
                            <tfoot>
                                    <td class="product-col"><strong>Grand Total</strong></td>
                                    <td ><strong>৳ {{ $grand_total = $total_amount - Session::get('CouponAmount')  }}/-</strong></td>

                            </tfoot>
                        </table>

                    </div><!-- End #order-cart-section -->
                </div><!-- End .order-summary -->

                <div class="checkout-info-box">
                    <h3 class="step-title">Ship To:
                        <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                    </h3>

                    <address>
                        {{ $shippingDetails->name }} <br>
                        {{ $shippingDetails->address }} <br>
                        {{ $shippingDetails->city }}, {{ $shippingDetails->district }} {{ $shippingDetails->zip }} <br>
                        {{ $shippingDetails->country }} <br>
                        {{ $shippingDetails->phone }}
                    </address>
                </div><!-- End .checkout-info-box -->

                <div class="checkout-info-box">
                    <h3 class="step-title">Shipping Method:
                        <a href="#" title="Edit" class="step-title-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                    </h3>

                    <p>Flat Rate - Fixed</p>
                </div><!-- End .checkout-info-box -->
            </div><!-- End .col-lg-4 -->

            <div class="col-lg-8 order-lg-first">
                <div class="checkout-payment">
                    <h2 class="step-title">Review Your Billing Address:</h2>

                    {{--<h4>Check / Money order</h4>

                    <div class="form-group-custom-control">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="change-bill-address" value="1">
                            <label class="custom-control-label" for="change-bill-address">My billing and shipping address are the same</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-group -->--}}

                    {{--<div id="checkout-shipping-address">
                        <address>
                            <span>Desmond Mason</span> <br>
                            <span>123 Street Name, City, USA</span> <br>
                            <span>Los Angeles, California 03100</span> <br>
                            <span>United States</span> <br>
                            <span>(123) 456-7890</span>
                        </address>
                    </div><!-- End #checkout-shipping-address -->--}}

                    <div id="new-checkout-address" class="show">
                        <form action="#">
                            <div class="form-group">
                                <label>Billing Name: </label>
                                <strong>{{ $userDetails->name }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Street Address: </label>
                                <strong>{{ $userDetails->address }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Billing Zip Code </label>
                                <strong>{{ $userDetails->zip }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>City:  </label>
                                <strong>{{ $userDetails->city }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>District:  </label>
                                <strong>{{ $userDetails->district }}</strong>
                            </div><!-- End .form-group -->


                            <div class="form-group">
                                <label>Country:</label>
                                <strong>{{ $userDetails->country }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Phone Number: </label>
                                <strong>{{ $userDetails->phone }}</strong>
                            </div><!-- End .form-group -->
                        </form>
                    </div><!-- End #new-checkout-address -->

                {{--</div><!-- End .checkout-payment -->

            </div><!-- End .col-lg-8 -->

            <div class="col-lg-8 order-lg-first">
                <div class="checkout-payment">--}}
                    <h2 class="step-title">Review Your Shipping Address:</h2>

                    {{--<h4>Check / Money order</h4>

                    <div class="form-group-custom-control">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="change-bill-address" value="1">
                            <label class="custom-control-label" for="change-bill-address">My billing and shipping address are the same</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-group -->

                    <div id="checkout-shipping-address">
                        <address>
                            <span>Desmond Mason</span> <br>
                            <span>123 Street Name, City, USA</span> <br>
                            <span>Los Angeles, California 03100</span> <br>
                            <span>United States</span> <br>
                            <span>(123) 456-7890</span>
                        </address>
                    </div><!-- End #checkout-shipping-address -->--}}

                    <div id="new-checkout-address" class="show">
                        <form action="#">
                            <div class="form-group">
                                <label>Billing Name: </label>
                                <strong>{{ $shippingDetails->name }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Street Address: </label>
                                <strong>{{ $shippingDetails->address }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Billing Zip Code </label>
                                <strong>{{ $shippingDetails->zip }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>City:  </label>
                                <strong>{{ $shippingDetails->city }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>District:  </label>
                                <strong>{{ $shippingDetails->district }}</strong>
                            </div><!-- End .form-group -->


                            <div class="form-group">
                                <label>Country:</label>
                                <strong>{{ $shippingDetails->country }}</strong>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Phone Number: </label>
                                <strong>{{ $shippingDetails->phone }}</strong>
                            </div><!-- End .form-group -->
                        </form>
                    </div><!-- End #new-checkout-address -->

                    <h2 class="step-title">Payment Method</h2>

                    <form name="paymentForm" id="paymentForm" action="{{ route('place_order') }}" method="post">
                        @csrf
                        <input type="hidden" name="grand_total" value="{{ $grand_total }}">
                        <div class="payment-options">
					<span>
						<label><strong>Select Payment Method:</strong></label>
					</span>
                            <span>
						<label><input type="radio" name="payment_method" id="COD" value="COD"> <strong>COD</strong></label>
					</span>
                            <span>
						<label><input type="radio" name="payment_method" id="Paypal" value="Paypal"> <strong>Paypal</strong></label>
					</span>

                            <span style="float:right;">
						{{--<button type="submit" class="btn btn-default" onclick="return selectPaymentMethod();">Place Order</button>--}}
                            <button type="submit"  class="btn btn-primary float-right" onclick="return selectPaymentMethod();">Place Order</button>
					</span>
                        </div>
                    </form>

                    <div class="clearfix">
                    </div><!-- End .clearfix -->
                </div><!-- End .checkout-payment -->

                <div class="checkout-discount">
                    <h4>
                        <a data-toggle="collapse" href="#checkout-discount-section" class="collapsed" role="button" aria-expanded="false" aria-controls="checkout-discount-section">Apply Discount Code</a>
                    </h4>

                    <div class="collapse" id="checkout-discount-section">
                        <form action="#">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
                            <button class="btn btn-sm btn-outline-secondary" type="submit">Apply Discount</button>
                        </form>
                    </div><!-- End .collapse -->
                </div><!-- End .checkout-discount -->
            </div><!-- End .col-lg-8 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection