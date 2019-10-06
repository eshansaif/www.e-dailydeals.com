@extends('layouts.frontend.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">

        <div class="row">

            <div class="col-md-6 order-lg-last dashboard-content">

                <?php
/*                if(isset($_POST['customer_register']))
                {
                    if(@$rergiResult == "success")
                    {
                        echo '<div class="alert alert-success">Dear '.$_POST['customer_name'].', thank you for registering.</div>';

                        echo "<style>.regi-form-div { display: none; }</style>";
                    }
                    else
                        echo '<div class="alert alert-danger">Sorry! Please recheck your information! Unable to register.</div>';
                }

                */?>

                <div class="regi-form-div">
                    <h2>Customer Registration Form</h2>

                    <form id="registerForm" name="registerForm" action="{{ route('customer.register') }}" method="post">
                        @csrf
                        <div class="form-group required-field col-md-12">
                            <label for="name"><strong>Full Name </strong></label>
                            <input  type="name" class="form-control" id="name" name="name" >
                        </div><!-- End .form-group -->

                        <div class="form-group required-field col-md-12">
                            <label for="email"><strong> Email</strong></label>
                            <input type="email" class="form-control" id="email" name="email" >
                        </div><!-- End .form-group -->

                        <div class="form-group required-field col-md-12">
                            <label for="password"><strong> Password</strong></label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div><!-- End .form-group -->

                        {{--<div class="form-group required-field col-md-12">
                            <label for="phone"><strong> Phone Number</strong></label>
                            <input type="text" class="form-control" id="phone" name="phone_number" >
                        </div><!-- End .form-group -->--}}

                        {{--<div class="form-group col-md-12">
                            <label for="" class=" required-field"><strong>Gender </strong> </label> <br/>
                            <label class="radio-inline"><input type="radio" name="gender" value="Male" checked>Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="Other">Other</label>
                        </div><!-- End .form-group -->--}}

                        <div class="form-footer">

                            <div class="form-footer-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div><!-- End .form-footer -->
                    </form>
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