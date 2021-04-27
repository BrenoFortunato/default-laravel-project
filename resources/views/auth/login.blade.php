@extends("auth.template")

@section("content")
    <p class="login-box-msg">{{ \Lang::get("auth.sign_in") }}</p>

    <form method="post" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ \Lang::get('auth.email') }}" class="form-control @error('email') is-invalid @enderror">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error("email")
                <span class="error invalid-feedback">{!! $message !!}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" placeholder="{{ \Lang::get('auth.password') }}" class="form-control @error('password') is-invalid @enderror">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error("password")
                <span class="error invalid-feedback">{!! $message !!}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-sm-6 mb-2" style="align-self:center">
                <div class="icheck-material-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">{{ \Lang::get("auth.remember") }}</label>
                </div>
            </div>
    
            <div class="col-sm-6 mb-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt" style="margin-right:5px"></i>
                    {{ \Lang::get("auth.button_sign_in") }}
                </button>
            </div>
        </div>
    </form>

    <a href="{{ url('/password/reset') }}">{{ \Lang::get("auth.forgot_password") }}</a>
    <hr/>
    <p class="login-box-msg" style="padding-bottom:0;">{!! str_replace(":link", url("/register"), \Lang::get("auth.new_user")) !!}</p>
@endsection
