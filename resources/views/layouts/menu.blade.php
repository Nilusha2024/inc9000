<!-- menu list -->
<li class="nav-item">

    {{-- items --}}
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

    <a href="{{ route('general') }}" class="nav-link {{ Request::is('general') ? 'active' : '' }}">
        <i class="nav-icon fas fa-box"></i>
        <p>General</p>
    </a>

    <a href="{{ route('user') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Users</p>
    </a>

    <a href="{{ route('job') }}" class="nav-link {{ Request::is('job') ? 'active' : '' }}">
        <i class="nav-icon fas fa-dolly"></i>
        <p>Jobs</p>
    </a>
</li>
