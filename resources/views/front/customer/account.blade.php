@extends('layouts.frontend.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last dashboard-content">
                <h2>Update Your Account Information</h2>

                <form id="accountForm" name="accountForm" action="{{ route('customer.account') }}" method="post">
                    @csrf

                    <div class="form-group required-field col-lg-8">
                        <label for="name">Name</label>
                        <input value="{{ $userDetails->name }}" type="text" class="form-control" id="name" name="name" >
                    </div><!-- End .form-group -->

                    <div class="form-group col-lg-8">
                        <label for="acc-email">Email</label>
                        <input value="{{ $userDetails->email }}" type="email" class="form-control" id="acc-email" name="acc-email"  disabled>

                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-lg-8">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="address" cols="15" rows="5">{{ $userDetails->address }}</textarea>

                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-lg-8">
                        <label for="zip">Zip Code</label>
                        <input value="{{ $userDetails->zip }}" type="number" class="form-control" id="zip" name="zip" min="1" >

                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-lg-8">
                        <label for="city">City</label>
                        <input value="{{ $userDetails->city }}" type="text" class="form-control" id="city" name="city" >

                    </div><!-- End .form-group -->
                    <div class="form-group required-field col-lg-8">
                        <label for="district">District</label>
                        <input value="{{ $userDetails->district }}" type="text" class="form-control" id="district" name="district" >

                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-lg-8">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control">
                            <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->name }}" @if($country->name == $userDetails->country) selected  @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>

                    </div><!-- End .form-group -->

                    <div class="form-group required-field col-lg-8">
                        <label for="phone">Mobile</label>
                        <input value="{{ $userDetails->phone }}" type="text" class="form-control" id="phone" name="phone" >

                    </div><!-- End .form-group -->

                    <div class="form-footer-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>



                    <div class="mb-2"></div><!-- margin -->

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="change-pass-checkbox" value="1">
                        <label class="custom-control-label" for="change-pass-checkbox">Change Password</label>
                    </div><!-- End .custom-checkbox -->

                    <div id="account-chage-pass">
                        <h3 class="mb-2">Change Password</h3>
                        <form id="passwordForm" name="passwordForm" action="{{ url('update-user-pwd') }}" method="POST">
                            @csrf
                        <div class="col-md-6">
                            <div class="form-group required-field">
                                <label for="current_pwd">Current Password</label>
                                <input type="password" class="form-control" id="current_pwd" name="current_pwd">

                            </div><!-- End .form-group -->
                            <span id="chkPwd"></span>
                        </div><!-- End .col-md-6 -->


                            <div class="col-md-6">
                                <div class="form-group required-field">
                                    <label for="acc-new_pwd">New Password</label>
                                    <input type="password" class="form-control" id="new_pwd" name="new_pwd">
                                </div><!-- End .form-group -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="form-group required-field">
                                    <label for="confirm_pwd">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd">
                                </div><!-- End .form-group -->
                            </div><!-- End .col-md-6 -->
                        <div class="form-footer-right">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>

                    </div><!-- End #account-chage-pass -->

                    <div class="required text-right">* Required Field</div>
                    <div class="form-footer">
                        <a href="#"><i class="icon-angle-double-left"></i>Back</a>


                    </div><!-- End .form-footer -->

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