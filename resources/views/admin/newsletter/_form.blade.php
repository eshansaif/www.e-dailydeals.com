@csrf



<div class="form-group">
    <label for="email" class="col-lg-2 col-sm-2 control-label">Subscriber Name</label>
    <div class="col-lg-10">
        <input name="email" value="{{ old('email', isset($subscriber)?$subscriber->name:null) }}" type="email" class="form-control form-control-line @error('email') is-invalid @enderror" id="email" placeholder="" disabled>

    </div>


</div>


<div class="form-group">
    <label for="created_at" class="col-lg-2 col-sm-2 control-label">Created At</label>
    <div class="col-lg-10">
        <input name="created_at" value="{{ old('created_at', isset($subscriber)?$subscriber->name:null) }}" type="text" class="form-control form-control-line @error('created_at') is-invalid @enderror" id="created_at" placeholder="" disabled>

    </div>

</div>





<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($subscriber)){
            $status = $subscriber->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label">Newsletter Status</label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="Active" id="Active" @if($status =='Active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="Inactive" id="Inactive" @if($status =='Inactive') checked @endif >Inactive</label>
        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>