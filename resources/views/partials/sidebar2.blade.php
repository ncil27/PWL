<div class="sidebar sidebar-style-2" data-background-color="dark">
  <div class="sidebar-logo">
      <div class="logo-header" data-background-color="dark">
          <a href="{{ route('dashboard') }}" class="logo">
              <img src="{{ asset('kai-admin/assets/img/kaiadmin/logo_light.svg') }}" 
                   alt="Kai Admin Logo" class="navbar-brand" height="20"/>
          </a>
          <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                  <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                  <i class="gg-menu-left"></i>
              </button>
          </div>
          <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
          </button>
      </div>
  </div>

  <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
          <ul class="nav nav-secondary">
              <li class="nav-item">
                  <a href="{{ route('dashboard') }}">
                      <i class="fas fa-home"></i>
                      <p>Dashboard</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('users.index') }}">
                      <i class="fas fa-user"></i>
                      <p>Users</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('settings') }}">
                      <i class="fas fa-cogs"></i>
                      <p>Settings</p>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>
