@extends('layouts.frontend.master');

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-6 order-lg-last dashboard-content">
                <h2>Customer Login</h2>

                <form action="{{ route('customer.login') }}" method="post" id="loginForm" name="loginForm" >

                    @csrf
                    <div class="form-group required-field col-md-12" >
                        <label for="email"><strong> Email</strong></label>
                        <input type="email" class="form-control" id="email" name="email" autocomplete="none" >
                        @error('email')
                        <div class="pl-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-md-12">
                        <label for="password"><strong> Password</strong></label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="none" >
                        @error('password')
                        <div class="pl-1 text-danger">{{ $message }}</div>
                        @enderror
                    </div><!-- End .form-group -->


                    <div class="mb-2"></div><!-- margin -->

                    <!--<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="change-pass-checkbox" value="1">
                        <label class="custom-control-label" for="change-pass-checkbox">Keep me logged in</label>
                    </div> -->




                    <div class="required text-right">* Required Field</div>
                    <div class="form-footer form-footer-right">
                        <div class="form-footer-left">
                            <p>Don't have any Account? <a href="{{ route('customer.register_form') }}"><strong>Click to Register</strong></a></p>
                        </div>
                        <div class="form-footer-right">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div><!-- End .form-footer -->

                </form>
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
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
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-5"></div><!-- margin -->
@endsection