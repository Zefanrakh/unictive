<nav class="navbar">
    @auth
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>

        <a class="nav-link" href="{{ route('profile') }}">Profile</a>

        @if (auth()->user() && auth()->user()->role->value === 'admin')
            <a class="nav-link" href="{{ route('users.index') }}">Users</a>

            <a class="nav-link" href="{{ route('users.create') }}">Create User</a>
        @endif

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    @endauth
</nav>
