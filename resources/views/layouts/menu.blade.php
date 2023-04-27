<!-- menu list -->
<li class="nav-item">

    @php
        
        $user_role = Auth::user()->role_id;
        
        $permissions_for_general = [1];
        $permissions_for_home = [1, 2];
        $permissions_for_user = [1, 2];
        $permissions_for_location = [1, 2];
        $permissions_for_job = [1, 2];
        $permissions_for_job_mobile = [3];
        
    @endphp

    {{-- items --}}
    {{-- ----- --}}

    {{-- home --}}
    @if (in_array($user_role, $permissions_for_home))
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
        </a>
    @endif

    {{-- General --}}
    @if (in_array($user_role, $permissions_for_general))
        <a href="{{ route('general') }}" class="nav-link {{ Request::is('general') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>General</p>
        </a>
    @endif

    {{-- User --}}
    @if (in_array($user_role, $permissions_for_user))
        <a href="{{ route('user') }}" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>

        </a>
    @endif

    {{-- Job --}}
    @if (in_array($user_role, $permissions_for_job))
        <a href="{{ route('job') }}" class="nav-link {{ Request::is('job') ? 'active' : '' }}">
            <i class="nav-icon fas fa-dolly"></i>
            <p>Jobs</p>
        </a>
    @endif

    {{-- Job (mobile view) --}}
    @if (in_array($user_role, $permissions_for_job_mobile))
        <a href="{{ route('job-list') }}" class="nav-link {{ Request::is('job-list') ? 'active' : '' }}">
            <i class="nav-icon fas fa-dolly"></i>
            <p>Job List</p>
        </a>
    @endif
</li>
