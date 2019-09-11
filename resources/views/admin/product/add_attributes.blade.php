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
                            {{--<form action="{{ url('product/add-attributes/'.$productDetails->id) }}" method="post" class="form-horizontal">--}}
                            <form action="{{ route('attribute.add', $productDetails->id) }}" method="post" class="form-horizontal">
                                @csrf
                                @method('put')
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
                                            <input type="text" name="sku[]" id="sku" style="width: 120px" placeholder="SKU"/>
                                            <input type="text" name="size[]" id="size" style="width: 120px" placeholder="Size"/>
                                            <input type="text" name="price[]" id="price" style="width: 120px" placeholder="Price"/>
                                            <input type="text" name="stock[]" id="stock" style="width: 120px" placeholder="Stock"/>
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


    </section>
@endsection

