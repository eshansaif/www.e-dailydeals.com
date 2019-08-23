@csrf

<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label">Category Name</label>
    <div class="col-lg-10">
        <input name="name" value="{{ old('name', isset($category)?$category->name:null) }}" type="text" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" placeholder="Category Name">
    </div>

    @error('name')
    <div class="pl-1 text-danger">{{ $message }}</div>
    @enderror
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
    <label class="radio-inline"><input type="radio" name="status" value="active" id="active" @if($status =='Active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="inactive" id="inactive" @if($status =='Inactive') checked @endif >Inactive</label>
        </div>
    @error('status')
    <div class="pl-1 text-danger">{{ $message }}</div>
    @enderror
</div>