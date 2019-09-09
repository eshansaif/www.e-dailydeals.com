@extends('layouts.backend._master')

@section('content')
    <section class="wrapper">
        <!-- page start-->

        <div class="wrapper">
            <div class="row">
                <div class="col-lg-10 col-md-offset-1">
                    <section class="panel">
                        <header class="panel-heading">
                             Product Details
                        </header>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <th style="width: 10%">Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ $product->brand->name }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{ $product->color }}</td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <td>{{ $product->size }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Is Featured</th>
                                    <td>@if($product->is_featured == 1) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($product->status) }}</td>
                                </tr>
                                <tr>
                                    <th>Details</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Images</th>
                                    <td>
                                        @if(count($product->product_image))
                                            @foreach($product->product_image as $image)
                                                <img style="width: 20%" src="{{ asset($image->file_path) }}" alt="">
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            </table>


                        </div>
                    </section>

                </div>
            </div>
        </div>


    </section>


@endsection