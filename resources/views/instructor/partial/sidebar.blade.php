<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('instructor.dashboard') }}">
            <img src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ request()->routeIs('instructor.dashboard') ? 'active' : '' }}">
                    <a class="js-arrow" href="{{ route('instructor.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('instructor.periods.display') ? 'active' : '' }}">
                    <a href="{{ route('instructor.periods.display') }}">
                        <i class="fas fa-table"></i>Classes</a>
                </li>
                <li class="{{ request()->routeIs('instructor.students.display') ? 'active' : '' }}">
                    <a href="{{ route('instructor.students.display') }}">
                        <i class="far fa-check-square"></i>Students</a>
                </li>
                <li class="{{ request()->routeIs('instructor.courses.display') ? 'active' : '' }}">
                    <a href="{{ route('instructor.courses.display') }}">
                        <i class="fas fa-calendar-alt"></i>Add Request</a>
                </li>
            </ul>
        </nav>
    </div>

</aside>
