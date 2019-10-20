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
                    <h3>YOUR PAYPAL ORDER HAS BEEN Canceled</h3>
                    <h5>Please contact us if You have any Queries to know!</h5>
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