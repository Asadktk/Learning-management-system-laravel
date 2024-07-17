<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="js-arrow" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('admin.courses.display') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.display') }}">
                        <i class="fas fa-table"></i>Courses</a>
                </li>
                <li class="{{ request()->routeIs('admin.instructors.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.instructors.index') }}">
                        <i class="fas fa-chart-bar"></i>Instructors</a>
                </li>
                <li class="{{ request()->routeIs('admin.students.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.students.index') }}">
                        <i class="far fa-check-square"></i>Students</a>
                </li>
                <li class="{{ request()->routeIs('admin.requests.display') ? 'active' : '' }}">
                    <a href="{{ route('admin.requests.display') }}">
                        <i class="fas fa-calendar-alt"></i>Instructors Request</a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
