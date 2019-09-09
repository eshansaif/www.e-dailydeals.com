@extends('layouts.backend._master')
@section('content')


    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <header class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <a class="btn btn-primary" href="{{ route('product.create') }}">Add New <i class="fa fa-plus"></i></a>
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
                                    <th>Name</th>
                                    <th>Beand Name</th>
                                    <th>Category Name</th>
                                    <th style="width: 30%;">Description</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)

                                <tr class="">
                                    <td>{{ $serial++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ str_limit($product->description,100)  }}</td>
                                    <td><span class="label {{ ($product->status == 'Active')?'label-info':'label-danger'}}">{{ $product->status }}</span></td>
                                    <td>

                                        @if($product->deleted_at == null)
                                         <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-default"><strong>Details</strong></a>
                                         <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm  btn-info"><strong>Edit</strong></a>
                                       <form action="{{ route('product.destroy', $product->id) }}" method="post" style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to delete this product')"><strong>Delete</strong></button>
                                        </form>
                                        @else
                                        <form action="{{ route('product.restore', $product->id) }}" method="post" style="display: inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('You are going to restore this product')"><strong>Restore/strong></button>
                                        </form>

                                            <form action="{{ route('product.permanent_delete', $product->id) }}" method="post" style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('You are going to permanently delete this product')"><strong>Permanent Delete</strong></button>
                                            </form>
                                            @endif
                                    </td>


                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $products->render() }}
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!--body wrapper end-->



@endsection