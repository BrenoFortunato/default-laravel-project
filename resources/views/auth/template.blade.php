<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ config('app.name') }} | Autenticação</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/icon_color.png') }}">

    {{-- AdminLTE v3.0.5 --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    {{-- iCheck Material v1.0.0 --}}
    <link rel="stylesheet" href="{{ asset('css/icheck-material.css') }}">

    {{-- Font Awesome v5.15.3 --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.css') }}">
    
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom_auth.css') }}">
    
    @stack("css")
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img class="logo-img" src="{{ asset("images/logo_color.png") }}" alt=""/>
        </div>

        <div class="login-card-body">
            @include("flash::message")
            <div class="alert-ajax"></div>

            @yield("content")
        </div>
    </div>
    
    {{-- jQuery v3.5.1 --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    {{-- Bootstrap v4.5.3 --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    {{-- AdminLTE v3.0.5 --}}
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    @stack("js")
</body>
</html>
