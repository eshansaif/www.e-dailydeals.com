@csrf

<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label">Brand Name</label>
    <div class="col-lg-10">
        <input name="name" value="{{ old('name', isset($brand)?$brand->name:null) }}" type="text" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" placeholder="Brand Name">
        @error('name')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="details" class="col-lg-2 col-sm-2 control-label">Brand Details</label>
    <div class="col-lg-10">
        <textarea rows="5" name="details"   class="form-control form-control-line @error('details') is-invalid @enderror" id="details" placeholder="Brand Details">{{ old('details', isset($brand)?$brand->details:null) }}</textarea>

        @error('details')
        <div class="pl-1 text-danger ">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($brand)){
            $status = $brand->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label">Brand Status</label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="active" id="active" @if($status =='active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="inactive" id="inactive" @if($status =='inactive') checked @endif >Inactive</label>

        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>