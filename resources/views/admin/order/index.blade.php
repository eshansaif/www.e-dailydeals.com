@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="btn btn-primary" href="{{ route('coupon.create') }}">Add New <i class="fa fa-plus"></i></a>
                        <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        {{--<a href="javascript:;" class="fa fa-times"></a>--}}
                     </span>
                    </header>


                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">

                                <div class="btn-group pull-right">

                                    <form class="btn-group" >

                                        <select name="status" id="" class="">
                                            <option  value="">Select status</option>
                                            <option @if(request()->status == 'Active') selected @endif  value="Active">Active</option>
                                            <option @if(request()->status == 'Inactive') selected @endif value="Inactive">Incative</option>
                                        </select>

                                        <input type="text" placeholder="Search.." name="search" value="{{ request()->search }}">
                                        <button type="submit"><i class="fa fa-search"></i></button>


                                    </form>

                                </div>

                                <div class="btn-group pull-left">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Ordered Products(Qty)</th>
                                    <th>Ordered Amount </th>
                                    <th>Ordered Status </th>
                                    <th>Payment Method </th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)

                                    <tr class="">
                                        <td>{{ $serial++ }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->user_email }}</td>
                                        <td>
                                            @foreach($order->orders as $pro)
                                                {{ $pro->product_code }}
                                                ({{ $pro->product_quantity }})
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>{{ $order->grand_total }}</td>
                                        <td>{{ $order->order_status }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">View Order Details</a>
                                        </td>

                                        {{--<td><span class="label {{ ($coupon->status == 'Active')?'label-info':'label-danger'}}">{{ $coupon->status }}</span></td>--}}
                                        {{--<td>

                                            @if($coupon->deleted_at == null)
                                                <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <form action="{{ route('coupon.destroy', $coupon->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to delete this coupon')">Delete</button>
                                                </form>
                                            @else
                                                <form action="{{ route('coupon.restore', $coupon->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('You are going to restore this coupon')">Restore</button>
                                                </form>

                                                <form action="{{ route('coupon.permanent_delete', $coupon->id) }}" method="post" style="display: inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to permanently delete this coupon')">Permanent Delete</button>
                                                </form>
                                            @endif
                                        </td>--}}


                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $orders->render() }}
                    </div>

                </section>
        </div>
    </div>
    </div>
    <!--body wrapper end-->



@endsection
