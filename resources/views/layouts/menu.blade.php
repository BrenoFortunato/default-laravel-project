{{-- User --}}
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
        <i class="fas fa-users sidebar-icons"></i><p>{{ Lang::choice("tables.users", "p") }}</p>
    </a>
</li>

