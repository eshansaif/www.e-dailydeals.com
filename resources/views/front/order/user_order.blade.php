@extends('layouts.frontend.master');

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('customer.account') }}">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-9 order-lg-last dashboard-content">
                <h2>My Orders</h2>



                <table class="table table-bordered table-cart ">
                    <thead>
                    <tr>
                        <th class="product-col">Order ID</th>
                        <th class="price-col">Ordered Product</th>
                        <th class="price-col">Payment Method</th>
                        <th class="price-col">Grand Total</th>
                        <th class="price-col">Created At</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orders as $order)
                        <tr class="product-row">
                            <td>
                                {{ $order->id }}
                            </td>
                            <td>@foreach($order->orders as $pro)
                                    <a href="{{ url('orders/'.$order->id) }}">{{ $pro->product_code }}</a><br>
                                @endforeach
                            </td>

                            <td>{{ $order->payment_method }}</td>
                            <td>৳ {{ $order->grand_total }}/-</td>
                            <td>{{ $order->created_at }}</td>


                        </tr>



                    @endforeach


                    </tbody>

                    <tfoot>
                    {{--<tr>
                        <td colspan="4" class="clearfix">


                            <div class="float-right">
                                <a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                <a href="" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>
                            </div><!-- End .float-right -->
                        </td>
                    </tr>--}}
                    </tfoot>
                </table>
                {{ $orders->render() }}
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