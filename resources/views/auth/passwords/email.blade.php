@extends("auth.template")

@section("content")
    <p class="login-box-msg">{{ Lang::get("auth.enter_mail") }}</p>

    @if(session("status"))
        <div class="alert alert-success">
            {{ session("status") }}
        </div>
    @endif

    <form method="post" action="{{ route('password.email') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ Lang::get('auth.email') }}" class="form-control @error('email') is-invalid @enderror">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error("email")
                <span class="error invalid-feedback">{!! $message !!}</span>
            @enderror
        </div>

        <div class="row" style="margin-bottom:-8px">
            <div class="col-sm-6 mb-2" style="align-self:center">
                <a href="{{ route('login') }}">{{ Lang::get("auth.back") }}</a>
            </div>
    
            <div class="col-sm-6 mb-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-envelope" style="margin-right:5px"></i>
                    {{ Lang::get("auth.button_send_mail") }}
                </button>
            </div>
        </div>
    </form>
@endsection