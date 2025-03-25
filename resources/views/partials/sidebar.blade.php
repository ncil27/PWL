<div class="sidebar">
    <ul>
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li><a href="{{ route('users.index') }}">Users</a></li>
        <li><a href="{{ route('settings') }}">Settings</a></li>
    </ul>
</div>
