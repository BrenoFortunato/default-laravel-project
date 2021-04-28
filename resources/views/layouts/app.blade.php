<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>{{ config('app.name') }} | Painel Administrativo</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('images/icon_color.png') }}">

    {{-- Bootstrap Toggle v3.6.1 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap4-toggle.min.css') }}">

    {{-- AdminLTE v3.0.5 --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    {{-- Select2 v4.0.13 --}}
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

    {{-- iCheck Material v1.0.0 --}}
    <link rel="stylesheet" href="{{ asset('css/icheck-material.css') }}">

    {{-- Font Awesome v5.15.3 --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.css') }}">
    
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_colors.css') }}">
    
    @include("vendor.input-customizer.masks")
    @stack("css")
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- Main Header --}}
        @include("layouts.navbar")

        {{-- Sidebar --}}
        @include("layouts.sidebar")

        {{-- Content --}}
        <div class="content-wrapper">
            <section class="content">
                @yield("content")
            </section>
        </div>

        {{-- Footer --}}
        <footer class="main-footer">Copyright © <?php echo date("Y"); ?> <a href="https://pandoapps.com.br/" target="_blank">Pandô APPs</a></footer>
    </div>

    {{-- jQuery v3.5.1 --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    {{-- Popper v1.16.1 --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>

    {{-- Bootstrap v4.5.3 --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    
    {{-- Bootstrap Toggle v3.6.1 --}}
    <script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>

    {{-- Bootstrap Switch v3.3.4 --}}
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>

    {{-- Bootstrap Custom File Input v1.3.4 --}}
    <script src="{{ asset('js/bs-custom-file-input.min.js') }}"></script>

    {{-- LoadingOverlay v2.1.7 --}}
    <script src="{{ asset('js/loadingoverlay.min.js') }}"></script>

    {{-- AdminLTE v3.0.5 --}}
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

    {{-- Select2 v4.0.13 --}}
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/select2-pt-br.min.js') }}"></script>

    {{-- Moment v2.27.0 --}}
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment-pt-br.min.js') }}"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/custom.js') }}"></script>

    @stack("js")
</body>
</html>
