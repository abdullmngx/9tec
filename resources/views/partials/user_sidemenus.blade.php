<div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
    <!-- Collapse -->
    <div class="nav-item">
      <a class="nav-link dropdown-toggle {{ request()->routeIs('user.dashboard') ? 'active' : '' }} {{ request()->routeIs('user.affiliate_dashboard') ? 'active' : '' }}" href="#navbarVerticalMenuDashboards" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
        <i class="bi-house-door nav-icon"></i>
        <span class="nav-link-title">Dashboards</span>
      </a>

      <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse {{ request()->routeIs('user.dashboard') ? 'show' : '' }} {{ request()->routeIs('user.affiliate_dashboard') ? 'show' : '' }}" data-bs-parent="#navbarVerticalMenu">
        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Main</a>
        <a class="nav-link {{ request()->routeIs('user.affiliate_dashboard') ? 'active' : '' }}" href="{{ route('user.affiliate_dashboard') }}">Affiliate</a>
      </div>
    </div>
    <!-- End Collapse -->

    <div id="navbarVerticalMenuPagesMenu">

      <div class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.courses') ? 'active' : '' }}" href="{{ route('user.courses') }}" data-placement="left">
          <i class="bi-book nav-icon"></i>
          <span class="nav-link-title">My Courses</span>
        </a>
      </div>

      <div class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.find_courses') ? 'active' : '' }}" href="{{ route('user.find_courses') }}" data-placement="left">
          <i class="bi-book nav-icon"></i>
          <span class="nav-link-title">Find Courses</span>
        </a>
      </div>

      <div class="nav-item">
        <a class="nav-link" href="{{ route('user.logout') }}" data-placement="left">
          <i class=" bi-power nav-icon"></i>
          <span class="nav-link-title">Loogut</span>
        </a>
      </div>

    </div>
    <!-- End Collapse -->
  </div>