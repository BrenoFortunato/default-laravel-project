<aside class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- Logo --}}
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset("images/logo_white.png") }}" class="brand-image" alt=""/>
    </a>

    {{-- Menu --}}
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>
</aside>