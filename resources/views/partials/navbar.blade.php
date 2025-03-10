<nav class="navbar">
    <div class="navbar-content">
        <span>Welcome, {{ Auth::user()->name ?? 'Guest' }}</span>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
</nav>
