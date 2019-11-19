@csrf


<div class="form-group">
    @php
        if(old("category_id")){
            $category_id = old('category_id');
        }elseif(isset($post)){
            $category_id = $post->category_id;
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
        if(old("user_id")){
            $user_id = old('user_id');
        }elseif(isset($post)){
            $user_id = $post->user_id;
        }else{
            $user_id = null;
        }
    @endphp
    <label for="user_id" class="col-lg-2 col-sm-2 control-label"><strong>Author</strong></label>
    <div class="col-lg-10">
        <select name="user_id" id="user_id" class="form-control form-control-line @error('user_id') is-invalid @enderror">
            <option value="">Select Select Author</option>
            @foreach($users as $user)
                <option @if($user_id == $user->id) selected @endif value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>
        @error('user_id')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="title" class="col-lg-2 col-sm-2 control-label"><strong>Blog Title</strong></label>
    <div class="col-lg-10">
        <input name="title" value="{{ old('title', isset($post)?$post->title:null) }}" type="text" class="form-control form-control-line @error('title') is-invalid @enderror" id="title" placeholder="Blog title">
        @error('title')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

{{--<div class="form-group">
    <label for="details" class="col-lg-2 col-sm-2 control-label"><strong>Brand Details</strong></label>
    <div class="col-lg-10">
        <textarea rows="5" name="details"   class="form-control form-control-line @error('details') is-invalid @enderror" id="details" placeholder="Brand Details">{{ old('details', isset($brand)?$brand->details:null) }}</textarea>

        @error('details')
        <div class="pl-1 text-danger ">{{ $message }}</div>
        @enderror
    </div>


</div>--}}


<div class="form-group">
    <label for="details" class="col-lg-2 col-sm-2 control-label"><strong>Blog Details</strong></label>
    <div class="col-lg-10">
        <textarea placeholder="Enter Blog Description" name="details"  class="wysihtml5 form-control" rows="9">{{ old('details', isset($post)?$post->details:null) }}</textarea>
        @error('details')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>



<div class="form-group">
    <label for="file" class="col-lg-2 col-sm-2 control-label"><strong>Upload Post Banner</strong></label>
    <div class="col-lg-10">
        @if(isset($post) && $post->file != null)
            <img src="{{ asset($post->file) }}" alt="">
        @endif
        <input name="file"  type="file" class="form-control form-control-line @error('file') is-invalid @enderror" id="file" placeholder="Upload File">
        @error('image')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>


{{--<div class="form-group">
    <label class="col-md-12">Image</label>
    <div class="col-md-12">
        @if(isset($post) && $post->file != null)
            <img src="{{ asset($post->file) }}" alt="">
        @endif
        <input name="file" type="file" placeholder="Upload file" class="form-control form-control-line @error('file') is-invalid @enderror">
    </div>
    @error('image')
    <div class="pl-1 text-danger">{{ $message }}</div>
    @enderror
</div>--}}


<div class="form-group">
    <label for="file" class="col-lg-2 col-sm-2 control-label"><strong>Is Featured</strong></label>
    @php
        if(old("status")){
            $is_featured = old('status');
        }elseif(isset($post)){
            $is_featured = $post->is_featured;
        }else{
            $is_featured = null;
        }
    @endphp
    <div class="col-md-10">
        <input name="is_featured" @if($is_featured ==0) checked @endif value="0" type="radio" id="no"> <label for="no"> No</label>
        <input name="is_featured" @if($is_featured ==1) checked @endif value="1" type="radio" id="yes"> <label for="yes"> Yes</label>
    </div>
    @error('is_featured')
    <div class="pl-1 text-danger">{{ $message }}</div>
    @enderror
</div>


<div class="form-group">
    <label for="file" class="col-lg-2 col-sm-2 control-label"><strong>publish Date</strong></label>
    <div class="col-md-10">
        <input name="published_at" value="{{ old('published_at',isset($post)?$post->published_at:null) }}" type="datetime-local" placeholder="Select date and time" class="form-control form-control-line @error('published_at') is-invalid @enderror">
    </div>
    @error('published_at')
    <div class="pl-1 text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($post)){
            $status = $post->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label"><strong>Post Status</strong></label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="published" id="published" @if($status =='published') checked @endif>Published</label>
    <label class="radio-inline"><input type="radio" name="status" value="unpublished" id="unpublished" @if($status =='unpublished') checked @endif >Unpublished</label>
    <label class="radio-inline"><input type="radio" name="status" value="draft" id="draft" @if($status =='draft') checked @endif >Draft</label>

        {{--<input name="status" @if($status =='published') checked @endif value="published" type="radio" id="published"> <label for="published"> Published</label>
        <input name="status" @if($status =='unpublished') checked @endif value="unpublished" type="radio" id="unpublished"> <label for="unpublished"> Unpublished</label>
        <input name="status" @if($status =='draft') checked @endif value="draft" type="radio" id="draft"> <label for="draft"> Draft</label>--}}

        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<script>
    jQuery(document).ready(function(){
        $('.wysihtml5').wysihtml5();
    });
</script>
