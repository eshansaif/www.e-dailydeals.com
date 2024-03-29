@csrf

<div class="form-group">
    @php
        if(old("type")){
            $type = old('type');
        }elseif(isset($admin)){
            $type = $admin->type;
        }else{
            $type = null;
        }
    @endphp
    <label for="name" class="col-lg-2 col-sm-2 control-label"><strong>Admin type</strong> </label>
    <div class="col-lg-10">
        <select name="type" id="type" class="form-control">
            <option value="">--Select--</option>
            <option value="Admin" @if($type=='Admin') selected @endif>Admin</option>
            <option value="Operator" @if($type=='Operator') selected @endif>Operator</option>

        </select>

        @error('type')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="name" class="col-lg-2 col-sm-2 control-label"><strong>Admin Name</strong></label>
    <div class="col-lg-10">
        <input name="name" value="{{ old('name', isset($admin)?$admin->name:null) }}" type="text" class="form-control form-control-line @error('name') is-invalid @enderror" id="name" placeholder="Admin Name">
        @error('name')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="email" class="col-lg-2 col-sm-2 control-label"><strong>Email</strong></label>
    <div class="col-lg-10">
        <input name="email" value="{{ old('email', isset($admin)?$admin->email:null) }}" type="email" class="form-control form-control-line @error('email') is-invalid @enderror" id="email" placeholder="Email">
        @error('email')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="phone" class="col-lg-2 col-sm-2 control-label"><strong>Phone</strong></label>
    <div class="col-lg-10">
        <input name="phone" value="{{ old('phone', isset($admin)?$admin->phone:null) }}" type="text" class="form-control form-control-line @error('phone') is-invalid @enderror" id="phone" placeholder="Phone">
        @error('phone')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">
    <label for="password" class="col-lg-2 col-sm-2 control-label"><strong>Password</strong></label>
    <div class="col-lg-10">
        <input value="{{ old('password', isset($admin)?$admin->password:null) }}" name="password"  type="password" class="form-control form-control-line @error('password') is-invalid @enderror" id="phone" placeholder="Password">
        @error('password')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>


</div>

<div class="form-group">

    <label for="password_confirmation" class="col-lg-2 col-sm-2 control-label"><strong>Confirm Password</strong></label>
    <div class="col-lg-10">
    <input value="{{ old('password', isset($admin)?$admin->password:null) }}" name="password_confirmation" type="password"   class="form-control form-control-line @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password">

    </div>
</div>
<div class="form-group">
    @php
        if(old("status")){
            $status = old('status');
        }elseif(isset($admin)){
            $status = $admin->status;
        }else{
            $status = null;
        }
    @endphp
    <label for="status" class="col-lg-2 col-sm-2 control-label"><strong>Admin Status</strong></label>

    <div class="col-lg-10">
    <label class="radio-inline"><input type="radio" name="status" value="Active" id="Active" @if($status =='Active') checked @endif>Active</label>
    <label class="radio-inline"><input type="radio" name="status" value="Inactive" id="Inactive" @if($status =='Inactive') checked @endif >Inactive</label>
        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="form-group" id="access">
    {{--@php
        if(old("status")){
            $status = old('status');
        }elseif(isset($admin)){
            $status = $admin->status;
        }else{
            $status = null;
        }
    @endphp--}}
    <label for="status" class="col-lg-2 col-sm-2 control-label"><strong>Operator Access</strong></label>

    <div class="col-lg-10">
        <label class="radio-inline"><input type="checkbox" name="categories_access" value="1" id="categories_access" @if($admin->categories_access =='1') checked @endif>Categories</label>
        <label class="radio-inline"><input type="checkbox" name="products_access" value="1" id="products_access" @if($admin->products_access =='1') checked @endif>products</label>
        <label class="radio-inline"><input type="checkbox" name="users_access" value="1" id="users_access" @if($admin->users_access =='1') checked @endif>Users</label>
        <label class="radio-inline"><input type="checkbox" name="orders_access" value="1" id="orders_access" @if($admin->orders_access =='1') checked @endif>orders</label>
        {{--<label class="radio-inline"><input type="radio" name="status" value="Inactive" id="Inactive" @if($status =='Inactive') checked @endif >Inactive</label>--}}
        @error('status')
        <div class="pl-1 text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>