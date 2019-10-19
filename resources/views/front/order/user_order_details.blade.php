@extends('layouts.frontend.master');

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('customer.account') }}">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('orders') }}">My Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $orderDetails->id }}</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-9 order-lg-last dashboard-content">
                <h2>My Order Details</h2>



                <table class="table table-bordered table-cart ">
                    <thead>
                    <tr>
                        <th class="product-col">Product Code</th>
                        <th class="price-col">Product Name</th>
                        <th class="price-col">Product Size</th>
                        <th class="price-col">Product Color</th>
                        <th class="price-col">Product Price</th>
                        <th class="price-col">Product Quantity</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orderDetails->orders as $item)
                        <tr class="product-row">
                            <td>{{ $item->product_code }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->product_size }}</td>
                            <td>{{ $item->product_color }}</td>
                            <td>{{ $item->product_price }}</td>
                            <td>{{ $item->product_quantity }}</td>

                        </tr>

                    @endforeach


                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="4" class="clearfix">


                            <div class="float-right">
                                <a href="{{ route('orders') }}" class="btn btn-outline-secondary btn-clear-cart">Back To My Orders</a>

                            </div><!-- End .float-right -->
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- End .col-lg-9 -->

            <aside class="sidebar col-lg-3">
                <div class="widget widget-dashboard">
                    <h3 class="widget-title">My Account</h3>

                    <ul class="list">
                        <li><a href="#">Account Dashboard</a></li>
                        <li><a href="#">Account Information</a></li>
                        <li><a href="#">Address Book</a></li>
                        <li class="active"><a href="{{ route('orders') }}">My Orders</a></li>
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