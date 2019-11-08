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



                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $orderDetails->name }}</td>
                        </tr>
                        <tr>
                            <th>Shipping Address</th>
                            <td>{{ $orderDetails->address.', '.$orderDetails->city.', '.$orderDetails->district.', '.$orderDetails->zip }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $orderDetails->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $orderDetails->user_email }}</td>
                        </tr>
                        <tr>
                            <th>Order Number</th>
                            <td>{{ Session::get('order_id') }}</td>
                        </tr>
                        <tr>
                            <th>Payable Amount</th>
                            <td>{{ Session::get('grand_total') }}/-</td>
                        </tr>
                        <tr>
                            @if($orderDetails->order_status !== 'Paid' )
                            <td><a href="{{ route('ssl.paymentGateway') }}" class="btn btn-success btn-bg">Pay Now</a></td>
                            @endif
                        </tr>
                    </table>
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
    /*Session::forget('grand_total');
    Session::forget('order_id');
    Session::forget('CouponAmount');
    Session::forget('CouponCode');*/

@endphp