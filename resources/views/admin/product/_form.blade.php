@csrf

<div class="form-group">
    @php
        if(old("category_id")){
            $category_id = old('category_id');
        }elseif(isset($product)){
            $category_id = $product->category_id;
        }else{
            $category_id = null;
        }
    @endphp
    <label for="category_id" class="col-lg-2 col-sm-2 control-label"><strong>Category</strong></label>
    <div class="col-lg-10">
        <select name="category_id" id="category_id" class="form-control form-control-line @error('category_id') is-invalid @enderror">
                <option value="">Select Category</option>
            @foreach($categories as $category)
                <option @if($category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach

        </select>
        @error('category_id')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    @php
        if(old("brand_id")){
            $brand_id = old('brand_id');
        }elseif(isset($product)){
            $brand_id = $product->brand_id;
        }else{
            $brand_id = null;
        }
    @endphp
    <label for="brand_id" class="col-lg-2 col-sm-2 control-label"><strong>Brand</strong></label>
    <div class="col-lg-10">
        <select  name="brand_id" id="brand_id" class="form-control form-control-line @error('brand_id') is-invalid @enderror">
            <option  value="">Select Brand</option>
            @foreach($brands as $brand)
                <option @if($brand_id == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach

        </select>
        @error('brand_id')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>


<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label"><strong>Product Name</strong></label>
    <div class="col-lg-10">
        <input name="name" value="{{ old('name', isset($product)?$product->name:null) }}" type="text" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" placeholder="Product Name">
        @error('name')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="code" class="col-lg-2 col-sm-2 control-label"><strong>Product code</strong></label>
    <div class="col-lg-10">
        <input name="code" value="{{ old('code', isset($product)?$product->code:null) }}" type="text" class="form-control form-control-line @error('code') is-invalid @enderror" id="code" placeholder="Product code">
        @error('code')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="color" class="col-lg-2 col-sm-2 control-label"><strong>Product Color</strong></label>
    <div class="col-lg-10">
        <input name="color" value="{{ old('color', isset($product)?$product->color:null) }}" type="text" class="form-control form-control-line @error('color') is-invalid @enderror" id="color" placeholder="Product color">
        @error('color')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="size" class="col-lg-2 col-sm-2 control-label"><strong>Product size</strong></label>
    <div class="col-lg-10">
        <input name="size" value="{{ old('size', isset($product)?$product->size:null) }}" type="text" class="form-control form-control-line @error('size') is-invalid @enderror" id="size" placeholder="Product size">
        @error('size')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-lg-2 col-sm-2 control-label"><strong>Product Description</strong></label>
    <div class="col-lg-10">
    <textarea placeholder="Enter Product Short Description" name="description"  class="tinymce form-control" rows="9">{{ old('description', isset($product)?$product->description:null) }}</textarea>
        @error('description')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="price" class="col-lg-2 col-sm-2 control-label"><strong>Product Price</strong></label>
    <div class="col-lg-10">
        <input name="price" value="{{ old('price', isset($product)?$product->price:null) }}" type="number" step=".01" class="form-control form-control-line @error('price') is-invalid @enderror" id="price" placeholder="Product rice" min="1">
        @error('price')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="stock" class="col-lg-2 col-sm-2 control-label"><strong>Product Stock</strong></label>
    <div class="col-lg-10">
        <input name="stock" value="{{ old('stock', isset($product)?$product->stock:null) }}" type="number" class="form-control form-control-line @error('stock') is-invalid @enderror" id="stock" placeholder="Product stock" min="1" max="1000">
        @error('stock')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($product)){
            $status = $product->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label"><strong>Product Status</strong></label>

    <div class="col-lg-10">
        <label class="radio-inline"><input type="radio" name="status" value="Active" id="active" @if($status =='Active') checked @endif>Active</label>
        <label class="radio-inline"><input type="radio" name="status" value="Inactive" id="inactive" @if($status =='Inactive') checked @endif >Inactive</label>

        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-group">
    <label for="existing_images" class="col-lg-2 col-sm-2 control-label"><strong>Existing Images</strong></label>

    <div class="col-lg-10">
        @if(count($product->product_image))
            @foreach($product->product_image as $image)
                <img style="width: 20%" src="{{ asset($image->file_path) }}" alt="">
                <a href="{{ route('product.delete.image',$image->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you confirm to delete this image?')">Delete</a>
            @endforeach
        @endif
    </div>


</div>

<div class="form-group">
    <label for="images" class="col-lg-2 col-sm-2 control-label"><strong>Product Images</strong></label>

    <div class="col-lg-10">
        <input type="file" name="images[]" id="images" multiple>
        @error('images.*')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
        
    </div>
</div>