{{--@if(session('message'))
    --}}{{--<div class="text-center" style="margin: 0 0 20px 0;">--}}{{--
        <div class="alert alert-success text-center" style="margin: 0 0 20px 0;">
            <strong>{{ session('message') }}</strong>
        </div>
    --}}{{--</div>--}}{{--
@endif--}}

@if(session('message'))
    {{--<div class="text-center" style="margin: 0 0 20px 0;">--}}
    <div class="alert alert-success text-center" style="margin: 0 0 20px 0;">
        <strong>{{ session('message') }}</strong>
    </div>
    {{--</div>--}}

    @elseif(session('error_message'))

    <div class="alert alert-danger text-center" style="margin: 0 0 20px 0;">
        <strong>{{ session('error_message') }}</strong>
    </div>

@endif