<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    {{-- Sidebar Toogle Button --}}
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    {{-- User Menu --}}
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            {{-- User Toggle Button --}}
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ Auth::user()->photo }}" class="user-image img-circle elevation-1" alt=""/>
                <span class="d-none d-md-inline"><b>{{ Auth::user()->name }}</b></span>
            </a>

            {{-- Dropdown Menu --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                {{-- User Image --}}
                <li class="user-header">
                    <img src="{{ Auth::user()->photo }}" class="img-circle" alt=""/>
                    <p>
                        <b>{{ Auth::user()->name }}</b>
                        <small>{{ \Lang::choice('text.member_since','p') }} {{ Auth::user()->readable_created_at }}</small>
                    </p>
                </li>

                {{-- Menu Footer --}}
                <li class="user-footer">
                    <a href="{{ route('home') }}" class="btn btn-default btn-flat">{{ \Lang::choice('text.home','p') }}</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ \Lang::choice('text.logout','p') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </li>
    </ul>
</nav>