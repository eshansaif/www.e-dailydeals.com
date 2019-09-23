@extends('layouts.backend._master')
@section('content')
    <section class="wrapper">
        <!-- page start-->

        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8 col-md-offset-2">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Product Attributes
                        </header>
                        <div class="panel-body">
                            <form action="{{ url('admin/product/add-attributes/'.$productDetails->id) }}" method="post" class="form-horizontal">
                            {{--<form action="{{ route('attribute.add', $productDetails->id) }}" method="post" class="form-horizontal">--}}
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 col-sm-2 control-label">Product Name</label>

                                    <div class="col-lg-10">
                                        <Span class="form-control"><strong>{{ $productDetails->name }}</strong></Span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-lg-2 col-sm-2 control-label">Product Code</label>

                                    <div class="col-lg-10">
                                        <Span class="form-control"><strong>{{ $productDetails->code }}</strong></Span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-lg-2 col-sm-2 control-label">Product Color</label>

                                    <div class="col-lg-10">
                                        <Span class="form-control"><strong>{{ $productDetails->color }}</strong></Span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-lg-2 col-sm-2 control-label"></label>

                                    <div class="field_wrapper">
                                        <div>
                                            <input type="text" name="sku[]" id="sku" style="width: 120px" placeholder="SKU" required/>
                                            <input type="text" name="size[]" id="size" style="width: 120px" placeholder="Size" required/>
                                            <input type="text" name="price[]" id="price" style="width: 120px" placeholder="Price" required/>
                                            <input type="text" name="stock[]" id="stock" style="width: 120px" placeholder="Stock" required/>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                        </div>
                                    </div>
                                </div>



                                    <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10 text-right">
                                        <button name="" type="submit" class="btn btn-primary">Add Attributes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                </div>
            </div>
        </div>


        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <header class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <label  class="btn btn-primary" ><i class="fa fa-list">Attribute List </i></label>
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


                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                    <tr>
                                        <th>Attribute ID</th>
                                        <th>SKU</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($productDetails['product_attributes'] as $attribute)

                                        <tr class="">
                                            <td>{{ $attribute->id }}</td>
                                            <td>{{ $attribute->sku }}</td>
                                            <td>{{ $attribute->size }}</td>
                                            <td>{{ $attribute->price }}</td>
                                            <td>{{ $attribute->stock }}</td>
                                            <td>
                                                <a href="{{ route('product_attribute.delete',$attribute->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you confirm to delete this Attribute?')">Delete</a>
                                            </td>



                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            {{--{{ $attributes->render() }}--}}
                        </div>

                    </section>
            </div>
        </div>

        <!--body wrapper end-->


    </section>



@endsection

