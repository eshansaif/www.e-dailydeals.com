<div class="product">
    <figure class="product-image-container">
        <a href="{{ route('product.details', $product->id) }}" class="product-image">
            <img style="height: 225.2px; width: 225.2px" src="{{ asset(isset($product->product_image[0])?$product->product_image[0]->file_path:'assets/frontend/assets/images/products/no-image-available.jpg') }}" alt="product">
        </a>
        <a href="ajax/product-quick-view.html" class="btn-quickview">Quickview</a>
    </figure>
    <div class="product-details">
        <div class="ratings-container">
            <div class="product-ratings">
                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
            </div><!-- End .product-ratings -->
        </div><!-- End .product-container -->
        <h2 class="product-title">
            <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
        </h2>
        <div class="price-box">
            <span class="product-price">৳ {{ $product->price }}/- </span>
        </div><!-- End .price-box -->

        {{--<div class="product-action">
            <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                <span>Add to Wishlist</span>
            </a>

            <a href="product.html" class="paction add-cart" title="Add to Cart">
                <span>Add to Cart</span>
            </a>

            <a href="#" class="paction add-compare" title="Add to Compare">
                <span>Add to Compare</span>
            </a>
        </div>--}}<!-- End .product-action -->
    </div><!-- End .product-details -->
</div>