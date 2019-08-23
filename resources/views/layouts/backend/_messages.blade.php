@if(session('message'))
    {{--<div class="text-center" style="margin: 0 0 20px 0;">--}}
        <div class="alert alert-success text-center" style="margin: 0 0 20px 0;">{{ session('message') }}</div>
    {{--</div>--}}
@endif