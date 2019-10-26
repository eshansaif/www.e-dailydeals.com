@csrf


{{--<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label">Category Level</label>
    <div class="col-lg-10">
        <select class="form-control" name="parent_id" id="">
                <option value="0">Main Category</option>
        @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
        </select>
    </div>


</div>--}}

<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label">Category Name</label>
    <div class="col-lg-10">
        <input name="name" value="{{ old('name', isset($category)?$category->name:null) }}" type="text" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" placeholder="Category Name">
        @error('name')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>


<div class="form-group">
    <label for="url" class="col-lg-2 col-sm-2 control-label">Category URL</label>
    <div class="col-lg-10">
        <input name="url" value="{{ old('url', isset($category)?$category->url:null) }}" type="text" class="form-control form-control-line @error('url') is-invalid @enderror" id="url" placeholder="Category URL">
        @error('url')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>



<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($category)){
            $status = $category->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label">Category Status</label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="Active" id="Active" @if($status =='Active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="Inactive" id="Inactive" @if($status =='Inactive') checked @endif >Inactive</label>
        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>