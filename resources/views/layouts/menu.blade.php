<!-- menu list -->
<li class="nav-item">

    @php
        
        $user_role = Auth::user()->role_id;
        
        $permissions_for_home = [1, 2];
        $permissions_for_user = [1, 2];
        $permissions_for_location = [1, 2];
        $permissions_for_location = [1, 2];
        $permissions_for_job = [1, 2];
        $permissions_for_client = [1, 2];
        $permissions_for_department = [1, 2];
        $permissions_for_client = [1, 2];
        $permissions_for_department = [1, 2];
        $permissions_for_job_mobile = [3];
        $permissions_for_tv = [1, 2];
        $permissions_for_tv = [1, 2];
        
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

    {{-- Tokens --}}
    @if (in_array($user_role, $permissions_for_job))
        <a href="{{ route('job_department_token') }}"
            class="nav-link {{ Request::is('job_department_token') ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>Tokens</p>
        </a>
    @endif

    {{-- Job (mobile view) --}}
    @if (in_array($user_role, $permissions_for_job_mobile))
        <a href="{{ route('job-list') }}" class="nav-link {{ Request::is('job-list') ? 'active' : '' }}">
            <i class="nav-icon fas fa-dolly"></i>
            <p>Job List</p>
        </a>
    @endif

    {{-- Client --}}
    @if (in_array($user_role, $permissions_for_client))
        <a href="client" class="nav-link {{ Request::is('client') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>Client</p>
        </a>
    @endif

    {{-- Department --}}
    @if (in_array($user_role, $permissions_for_department))
        <a href="department" class="nav-link {{ Request::is('department') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>Department</p>
        </a>
    @endif

    {{-- TV --}}
    @if (in_array($user_role, $permissions_for_tv))
        <a href="designing" class="nav-link">
            <i class="fas fa-tv" aria-hidden="true"></i>
            <p>Designing</p>
        </a>
    @endif

    {{-- TV --}}
    @if (in_array($user_role, $permissions_for_tv))
        <a href="cutting" class="nav-link">
            <i class="fas fa-tv" aria-hidden="true"></i>
            <p>Cutting</p>
        </a>
    @endif

    {{-- TV --}}
    @if (in_array($user_role, $permissions_for_tv))
        <a href="printing" class="nav-link">
            <i class="fas fa-tv" aria-hidden="true"></i>
            <p>Printing</p>
        </a>
    @endif


    {{-- TV --}}
    @if (in_array($user_role, $permissions_for_tv))
        <a href="sewing" class="nav-link">
            <i class="fas fa-tv" aria-hidden="true"></i>
            <p>Sewing</p>
        </a>
    @endif

    {{-- TV --}}
    @if (in_array($user_role, $permissions_for_tv))
        <a href="pressing" class="nav-link">
            <i class="fas fa-tv" aria-hidden="true"></i>
            <p>Pressing</p>
        </a>
    @endif


</li>
