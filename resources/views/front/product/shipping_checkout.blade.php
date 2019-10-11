@extends('layouts.frontend.master')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <ul class="checkout-progress-bar">
            <li class="active">
                <span>Shipping</span>
            </li>
            <li>
                <span>Review &amp; Payments</span>
            </li>
        </ul>
        {{--<div class="row">
            <div class="col-lg-8">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Shipping Address</h2>

                        <form action="#">
                            <div class="form-group required-field">
                                <label>Email Address </label>
                                <div class="form-control-tooltip">
                                    <input type="email" class="form-control" required>
                                    <span class="input-tooltip" data-toggle="tooltip" title="We'll send your order confirmation here." data-placement="right"><i class="icon-question-circle"></i></span>
                                </div><!-- End .form-control-tooltip -->
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Password </label>
                                <input type="password" class="form-control" required>
                            </div><!-- End .form-group -->

                            <p>You already have an account with us. Sign in or continue as guest.</p>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">LOGIN</button>
                                <a href="forgot-password.html" class="forget-pass"> Forgot your password?</a>
                            </div><!-- End .form-footer -->
                        </form>

                        <form action="#">
                            <div class="form-group required-field">
                                <label>Shipping Name </label>
                                <input id="shipping_name" name="shipping_name" value="{{ $userDetails->name }}" type="text" class="form-control" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Street Address </label>
                                <textarea class="form-control" name="shipping_address" id="shipping_address" cols="30" rows="10">{{ $userDetails->address }}</textarea>
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label>Shipping Zip Code </label>
                                <input id="shipping_zip" name="shipping_zip" value="{{ $userDetails->zip }}" type="number" class="form-control">
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>City  </label>
                                <input id="shipping_city" name="shipping_city" value="{{ $userDetails->city }}" type="text" class="form-control" required>
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>District  </label>
                                <input id="shipping_district" name="shipping_district" value="{{ $userDetails->district }}" type="text" class="form-control" required>
                            </div><!-- End .form-group -->


                            <div class="form-group">
                                <label>Country</label>
                                <div class="select-custom">
                                    <select class="form-control">
                                        <option value="USA">Select Country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->name }}" @if($country->name == $userDetails->country) selected @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label>Phone Number </label>
                                <div class="form-control-tooltip">
                                    <input id="shipping_phone" name="shipping_phone" value="{{ $userDetails->phone }}" type="tel" class="form-control" required>
                                    <span class="input-tooltip" data-toggle="tooltip" title="For delivery questions." data-placement="right"><i class="icon-question-circle"></i></span>
                                </div><!-- End .form-control-tooltip -->
                            </div><!-- End .form-group -->
                        </form>
                    </li>

                    <li>
                        <div class="checkout-step-shipping">
                            <h2 class="step-title">Shipping Methods</h2>

                            <table class="table table-step-shipping">
                                <tbody>
                                <tr>
                                    <td><input type="radio" name="shipping-method" value="flat"></td>
                                    <td><strong>$20.00</strong></td>
                                    <td>Fixed</td>
                                    <td>Flat Rate</td>
                                </tr>

                                <tr>
                                    <td><input type="radio" name="shipping-method" value="best"></td>
                                    <td><strong>$15.00</strong></td>
                                    <td>Table Rate</td>
                                    <td>Best Way</td>
                                </tr>
                                </tbody>
                            </table>
                        </div><!-- End .checkout-step-shipping -->
                    </li>
                </ul>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="order-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section">2 products in Cart</a>
                    </h4>

                    <div class="collapse" id="order-cart-section">
                        <table class="table table-mini-cart">
                            <tbody>
                            <tr>
                                <td class="product-col">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/product-1.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div>
                                        <h2 class="product-title">
                                            <a href="product.html">Felt Hat</a>
                                        </h2>

                                        <span class="product-qty">Qty: 4</span>
                                    </div>
                                </td>
                                <td class="price-col">$156.00</td>
                            </tr>

                            <tr>
                                <td class="product-col">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="assets/images/products/product-2.jpg" alt="product">
                                        </a>
                                    </figure>
                                    <div>
                                        <h2 class="product-title">
                                            <a href="product.html">Zippered Jacket</a>
                                        </h2>

                                        <span class="product-qty">Qty: 4</span>
                                    </div>
                                </td>
                                <td class="price-col">$220.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- End #order-cart-section -->
                </div><!-- End .order-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->--}}

        <form action="{{ route('checkout') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif type="text" placeholder="Billing Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <textarea style="height: 5px;" class="form-control" name="billing_address" id="billing_address" cols="30" rows="10">{{ $userDetails->address }}</textarea>

                        </div>
                        <div class="form-group">
                            <input name="billing_zip" id="billing_zip" @if(!empty($userDetails->zip)) value="{{ $userDetails->zip }}" @endif type="text" placeholder="Billing Zip Code" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif type="text" placeholder="Billing City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input name="billing_district" id="billing_district" @if(!empty($userDetails->district)) value="{{ $userDetails->district }}" @endif type="text" placeholder="Billing District" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select name="billing_country" id="billing_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" @if(!empty($userDetails->country) && $country->name == $userDetails->country) selected  @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="billing_phone" id="billing_phone" @if(!empty($userDetails->phone)) value="{{ $userDetails->phone }}" @endif type="text" placeholder="Billing Phone" class="form-control" />
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="copyAddress">
                            <label class="form-check-label" for="copyAddress"><strong>Shipping Address same as Billing Address</strong></label>
                        </div>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2></h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif name="shipping_name" id="shipping_name"   type="text" placeholder="Shipping Name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <textarea style="height: 5px;" class="form-control" name="shipping_address" id="shipping_address" cols="30" rows="10">@if(!empty($shippingDetails->name)) {{ $shippingDetails->address }} @endif</textarea>

                        </div>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->zip)) value="{{ $shippingDetails->zip }}" @endif  name="shipping_zip" id="shipping_zip"  type="text" placeholder="Shipping Zip Code" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif name="shipping_city" id="shipping_city"  type="text" placeholder="Shipping City" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->district)) value="{{ $shippingDetails->district }}" @endif name="shipping_district" id="shipping_district"  type="text" placeholder="Shipping District" class="form-control" />
                        </div>
                        <div class="form-group">
                            <select name="shipping_country" id="shipping_country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" @if(!empty($shippingDetails->country) && $country->name == $shippingDetails->country) selected  @endif>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->phone)) value="{{ $shippingDetails->phone }}" @endif name="shipping_phone" id="shipping_phone"  type="text" placeholder="Shipping Phone" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-default">Check Out</button>
                    </div><!--/sign up form-->
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-steps-action">
                    <a href="#" class="btn btn-primary float-right">NEXT</a>
                </div><!-- End .checkout-steps-action -->
            </div><!-- End .col-lg-8 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->

@endsection