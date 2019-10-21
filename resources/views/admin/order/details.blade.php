@extends('layouts.backend._master')
@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
        {{--<div class="row">
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Basic Table
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                    </header>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Striped Table
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Update Order Status
                        <span class="tools pull-right">
                                {{--<a href="javascript:;" class="fa fa-chevron-down"></a>--}}
                            {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                             </span>
                    </header>
                    <div class="panel-body">
                        <form action="{{ url('admin/update-order-status') }}" method="post">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <select name="order_status" id="order_status" class="control-label" required="">
                                            <option value="New" @if($orderDetails->order_status == "New") selected @endif>New</option>
                                            <option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>Pending</option>
                                            <option value="Cancelled" @if($orderDetails->order_status == "Cancelled") selected @endif>Cancelled</option>
                                            <option value="In Process" @if($orderDetails->order_status == "In Process") selected @endif>In Process</option>
                                            <option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>Shipped</option>
                                            <option value="Delivered" @if($orderDetails->order_status == "Delivered") selected @endif>Delivered</option>
                                            <option value="Paid" @if($orderDetails->order_status == "Paid") selected @endif>Paid</option>
                                        </select>

                                    </td>
                                    <td>
                                        <input type="submit" value="Update Status">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">

            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Order Details
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                             </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $orderDetails->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>{{ $orderDetails->order_status }}</td>
                            </tr>
                            <tr>
                                <th>Order Total</th>
                                <td>‎৳ {{ $orderDetails->grand_total }}/-</td>
                            </tr>
                            <tr>
                                <th>Shipping Charges</th>
                                <td>{{ $orderDetails->shipping_charges }}</td>
                            </tr>
                            <tr>
                                <th>Coupon Code</th>
                                <td>{{ $orderDetails->coupon_code }}</td>
                            </tr>
                            <tr>
                                <th>Coupon Amount</th>
                                <td>{{ $orderDetails->coupon_amount }}</td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td>{{ $orderDetails->payment_method }}</td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Customer Details
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                             </span>
                    </header>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Customer Name</th>
                                <td>{{ $orderDetails->name }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td>{{ $orderDetails->user_email }}</td>
                            </tr>


                        </table>
                    </div>
                </section>
            </div>
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Billing Address
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                             </span>
                    </header>
                    <div class="panel-body">
                        <address>
                            {{ $userDetails->name }} <br>
                            {{ $userDetails->address }} <br>
                            {{ $userDetails->city }},{{ $userDetails->district }},{{ $userDetails->zip }} <br>
                            {{ $userDetails->country }} <br>
                            {{ $userDetails->phone }}

                        </address>
                    </div>
                </section>
            </div>
            <div class="col-sm-6">
                <section class="panel">
                    <header class="panel-heading">
                        Shipping Address
                        <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                             </span>
                    </header>
                    <div class="panel-body">
                        <address>
                            {{ $orderDetails->name }} <br>
                            {{ $orderDetails->address }} <br>
                            {{ $orderDetails->city }},{{ $userDetails->district }},{{ $userDetails->zip }} <br>
                            {{ $orderDetails->country }} <br>
                            {{ $orderDetails->phone }}

                        </address>
                    </div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Product Attributes
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                         </span>
                    </header>
                    <div class="panel-body">
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderDetails->orders as $pro)
                            <tr>
                                <td>{{ $pro->product_code }}</td>
                                <td>{{ $pro->product_name }}</td>
                                <td>{{ $pro->product_size }}</td>
                                <td>{{ $pro->product_color }}</td>
                                <td>{{ $pro->product_price }}</td>
                                <td>{{ $pro->product_quantity }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->
@endsection
