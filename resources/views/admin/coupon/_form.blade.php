@csrf

<div class="form-group">
    <label for="coupon_code" class="col-lg-2 col-sm-2 control-label">Coupon Code</label>
    <div class="col-lg-10">
        <input name="coupon_code" value="{{ old('coupon_code', isset($coupon)?$coupon->coupon_code:null) }}" type="text" class="form-control form-control-line @error('coupon_code') is-invalid @enderror" id="coupon_code" placeholder="Coupon Code">
        @error('coupon_code')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>

<div class="form-group">
    <label for="amount" class="col-lg-2 col-sm-2 control-label">Amount</label>
    <div class="col-lg-10">
        <input name="amount" value="{{ old('amount', isset($coupon)?$coupon->amount:null) }}" type="number" class="form-control form-control-line @error('amount') is-invalid @enderror" id="amount" placeholder="Amount">
        @error('amount')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-group">
    @php
        if(old("amount_type")){
            $amount_type = old('amount_type');
        }elseif(isset($coupon)){
            $amount_type = $coupon->amount_type;
        }else{
            $amount_type = null;
        }
    @endphp
    <label for="amount_type" class="col-lg-2 col-sm-2 control-label">Amount Type</label>

    <div class="col-lg-10">
        <label class="radio-inline"><input type="radio" name="amount_type" value="Percentage" id="Percentage" @if($amount_type =='Percentage') checked @endif>Percentage</label>
        <label class="radio-inline"><input type="radio" name="amount_type" value="Fixed" id="Fixed" @if($amount_type =='Fixed') checked @endif >Fixed</label>
        @error('amount_type')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-group">
    <label for="expiry_date" class="col-lg-2 col-sm-2 control-label">Expiry Date</label>
    <div class="col-lg-10">
        <input name="expiry_date" value="{{ old('expiry_date', isset($coupon)?$coupon->expiry_date:null) }}" type="date" class="form-control form-control-line @error('expiry_date') is-invalid @enderror" id="expiry_date" placeholder="Expiry Date">
        @error('expiry_date')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>




<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($coupon)){
            $status = $coupon->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label">Coupon Status</label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="Active" id="Active" @if($status =='Active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="Inactive" id="Inactive" @if($status =='Inactive') checked @endif >Inactive</label>
        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>