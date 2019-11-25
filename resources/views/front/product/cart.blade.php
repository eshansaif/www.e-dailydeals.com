@extends('layouts.frontend.master')

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index-2.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                        <tr>
                            <th class="product-col">Product</th>
                            <th class="price-col">Price</th>
                            {{--<th class="qty-col">Qty</th>--}}
                            <th class="qty-col">Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $total_amount = 0;
                        @endphp
                        @foreach($user_cart as $cart)
                        <tr class="product-row">
                            <td class="product-col">
                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img style="width: 178px; height: 178px;" src="{{ asset(isset($cart->file)?$cart->file:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
                                    </a>
                                </figure>
                                <h2 class="product-title">
                                    <a href="{{ route('product.details', $cart->id) }}">{{ $cart->name }}</a>
                                    <p>{{ $cart->code}} | {{ $cart->size }}</p>
                                </h2>
                            </td>
                            <td>৳ {{ $cart->price }}/-</td>
                            {{--<td>
                                <input class="vertical-quantity form-control" type="text" value=" {{ $cart->quantity }}" disabled>
                            </td>--}}
                            <td>

                                <div class="qty mt-5">

                                        <a class="plus bg-dark" href="{{ url('cart/update-quantity/'.$cart->id.'/1') }}">+</a>
                                    <input type="number" class="count" name="qty" value="{{ $cart->quantity }}" min="0" autocomplete="off">
                                    @if($cart->quantity > 1)
                                        <a class="minus bg-dark" href="{{ url('cart/update-quantity/'.$cart->id.'/-1') }}">-</a>
                                    @endif
                                </div>
                                {{--<div class="input-group">
                                    @if($cart->quantuty > 1)
                                    <a  href="{{ url('cart/update-quantity/'.$cart->id.'/-1') }}"><input type="button" value="-" class="button-minus" data-field="quantity"></a>
                                    @endif
                                        <input type="number" step="1" max="" value="1" name="quantity" class="quantity-field">
                                    <a  href="{{ url('cart/update-quantity/'.$cart->id.'/1') }}"><input type="button" value="+" class="button-plus" data-field="quantity"></a>
                                </div>--}}
                            </td>
                            <td>৳ {{ $cart->price * $cart->quantity }}/-</td>

                        </tr>


                        <tr class="product-action-row">
                            <td colspan="4" class="clearfix">
                                <div class="float-left">
                                    <a href="#" class="btn-move">Move to Wishlist</a>
                                </div><!-- End .float-left -->

                                <div class="float-right">
                                    <a href="#" title="Edit product" class="btn-edit"><span class="sr-only">Edit</span><i class="icon-pencil"></i></a>
                                    <a href="{{ route('cart.delete',$cart->id) }}" onclick="return confirm('Are you confirm to remove this Product from Cart?')" title="Remove product" class="btn-remove"><span class="sr-only">Remove</span></a>
                                </div><!-- End .float-right -->
                            </td>
                        </tr>
                         @php
                             $total_amount = $total_amount + ($cart->price * $cart->quantity);
                         @endphp
                        @endforeach


                        </tbody>

                        <tfoot>
                        <tr>
                            <td colspan="4" class="clearfix">
                                <div class="float-right">
                                    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                                </div><!-- End .float-left -->

                                {{--<div class="float-right">
                                    <a href="#" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                    <a href="" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>
                                </div><!-- End .float-right -->--}}
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->

                <div class="cart-discount">
                    <h4>Apply Coupon Code</h4>
                    <form action="{{ route('cart.apply_coupon') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input name="coupon_code" type="text" class="form-control form-control-sm" placeholder="Enter coupon code"  required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Coupon</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">Estimate Shipping and Tax</a>
                    </h4>

                    <div class="collapse" id="total-estimate-section">
                        <form action="#">
                            <div class="form-group form-group-sm">
                                <label>Country</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="USA">United States</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="China">China</option>
                                        <option value="Germany">Germany</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>State/Province</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="CA">California</option>
                                        <option value="TX">Texas</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>Zip/Postal Code</label>
                                <input type="text" class="form-control form-control-sm">
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Flat Way</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="flat-rate">
                                    <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Best Rate</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="best-rate">
                                    <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->
                        </form>
                    </div><!-- End #total-estimate-section -->

                    <table class="table table-totals">
                        <tbody>
                        @if(!empty(Session::get('CouponAmount')))
                        <tr>
                            <td>Subtotal</td>
                            <td>৳ @php echo $total_amount;  @endphp/-</td>
                        </tr>

                        <tr>
                            <td>Discount Price(Coupon)</td>
                            <td>৳ @php echo Session::get('CouponAmount');  @endphp/-</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Grand Total</td>
                            <td>৳ @php echo $total_amount - Session::get('CouponAmount');  @endphp/-</td>
                        </tr>
                        </tfoot>
                        @else

                            <tfoot>
                            <tr>
                                <td>Grand Total</td>
                                <td>৳ @php echo $total_amount;  @endphp/-</td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>

                    <div class="checkout-methods">
                        <a href="{{ route('checkout') }}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                        <a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>
                    </div><!-- End .checkout-methods -->
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection
@push('cart_css')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .qty .count {
            color: #000;
            display: inline-block;
            vertical-align: top;
            font-size: 25px;
            font-weight: 700;
            line-height: 30px;
            padding: 0 2px
        ;min-width: 35px;
            text-align: center;
        }
        .qty .plus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial,sans-serif;
            text-align: center;
            border-radius: 50%;
        }
        .qty .minus {
            cursor: pointer;
            display: inline-block;
            vertical-align: top;
            color: white;
            width: 30px;
            height: 30px;
            font: 30px/1 Arial,sans-serif;
            text-align: center;
            border-radius: 50%;
            background-clip: padding-box;
        }
        div {
            text-align: center;
        }
        .minus:hover{
            background-color: #717fe0 !important;
        }
        .plus:hover{
            background-color: #717fe0 !important;
        }
        /*Prevent text selection*/
        span{
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }
        input{
            border: 0;
            width: 2%;
        }
        nput::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input:disabled{
            background-color:white;
        }

    </style>
@endpush

@push('cart_js')
    <script>
        $(document).ready(function(){
            $('.count').prop('disabled', true);
            $(document).on('click','.plus',function(){
                $('.count').val(parseInt($('.count').val()) + 1 );
            });
            $(document).on('click','.minus',function(){
                $('.count').val(parseInt($('.count').val()) - 1 );
                if ($('.count').val() == 0) {
                    $('.count').val(1);
                }
            });
        });
    </script>
@endpush


{{--@push('cart_css')
    <style>
        input,
        textarea {
            border: 1px solid #eeeeee;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .input-group {
            clear: both;
            margin: 15px 0;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: #eeeeee;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 38px;
            padding: 0;
            width: 38px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 38px;
            left: -6px;
            text-align: center;
            width: 62px;
            display: inline-block;
            font-size: 13px;
            margin: 0 0 5px;
            resize: vertical;
        }

        .button-plus {
            left: -13px;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            -webkit-appearance: none;
        }
    </style>

@endpush--}}
{{--@push('cart_js')
    <script>
        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        $('.input-group').on('click', '.button-plus', function(e) {
            incrementValue(e);
        });

        $('.input-group').on('click', '.button-minus', function(e) {
            decrementValue(e);
        });

    </script>

@endpush--}}
