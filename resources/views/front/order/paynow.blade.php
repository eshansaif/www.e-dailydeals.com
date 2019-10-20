@extends('layouts.frontend.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanks Page</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">

        <div class="row vertical-center-row">

            <div class="col-md-6 order-lg-last dashboard-content">


                <div class="alert alert-info" align="center">
                    <h3>Your order has been placed Successfully!</h3>
                    <h5>Your Order number is {{ Session::get('order_id') }} and Total payable amount is ৳ {{ Session::get('grand_total') }}/-</h5>
                    <h5>Please complete your oder by clicking on Payment Button </h5>

                    @php
                        $orderDetails = \App\Order::getOrderDetails(Session::get('order_id'));
                        $nameArr = explode(' ',$orderDetails->name);
                        $getCountryCode = \App\Order::getCountryCode($orderDetails->country);

                    @endphp

                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="sb-cqrf47425979@business.example.com">
                        {{--<input type="hidden" name="item_name" value="{{ Session::get('order_id') }}">
                        <input type="hidden" name="amount" value="{{ round(Session::get('grand_total'),2) }}">
                        <input type="hidden" name="currency_code" value="USD">--}}

                        <input type="text" name="item_name" value="{{ Session::get('order_id') }}">
                        <input type="text" name="currency_code" value="USD">
                        <input type="text" name="amount" value="{{ Session::get('grand_total') }}">
                        <input type="text" name="first_name" value="{{ $nameArr[0] }}">
                        <input type="text" name="last_name" value="{{ $nameArr[1] }}">
                        <input type="text" name="address1" value="{{ $orderDetails->address }}">
                        <input type="text" name="address2" value="{{ $orderDetails->city }},{{ $orderDetails->district }},{{ $orderDetails->zip }}">
                        <input type="text" name="city" value="{{ $orderDetails->city }}">
                        <input type="text" name="state" value="{{ $orderDetails->district }}">
                        <input type="text" name="zip" value="{{ $orderDetails->zip }}">
                        <input type="text" name="night_phone_a" value="{{ $orderDetails->phone }}">
                        <input type="hidden" name="night_phone_b" value="{{ $orderDetails->phone }}">
                        <input type="hidden" name="night_phone_c" value="{{ $orderDetails->phone }}">
                        <input type="text" name="email" value="{{ $orderDetails->user_email }}">
                        <input type="hidden" name="country" value="{{ $getCountryCode->code }}">
                        <input type="hidden" name="return" value="{{ url('paynow/thanks') }}">
                        <input type="hidden" name="cancel_return" value="{{ url('paypal/cancel') }}">
                        <br>
                        <br>
                        <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_paynow_107x26.png" alt="Pay Now">
                        <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                    <h5></h5>
                </div>

            </div><!-- End .col-lg-9 -->

            {{--<aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">My Account</h3>

                    <ul class="list">
                        <li class="active"><a href="#">Account Dashboard</a></li>
                        <li><a href="#">Account Information</a></li>
                        <li><a href="#">Address Book</a></li>
                        <li><a href="#">My Orders</a></li>
                        <li><a href="#">Billing Agreements</a></li>
                        <li><a href="#">Recurring Profiles</a></li>
                        <li><a href="#">My Product Reviews</a></li>
                        <li><a href="#">My Tags</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">My Applications</a></li>
                        <li><a href="#">Newsletter Subscriptions</a></li>
                        <li><a href="#">My Downloadable Products</a></li>
                    </ul>
                </div><!-- End .widget -->
            </aside><!-- End .col-lg-3 -->--}}
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
@endsection

@php
    Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('CouponAmount');
    Session::forget('CouponCode');

@endphp