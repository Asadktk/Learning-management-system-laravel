<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="/">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                   
                </li>
                <li>
                    {{-- {{ route('admin.courses') }} --}}
                    <a href="{{ route('instructor.periods.display') }}">
                        <i class="fas fa-table"></i>Classes</a>

                </li>
                {{-- <li>
                    {{ route('admin.instructors') 
                        <a href="#">
                            <i class="fas fa-chart-bar"></i>Instructors</a>
                </li> --}}
                <li>
                    {{-- {{ route('admin.students') }} --}}
                    <a href="{{ route('instructor.students') }}">
                        <i class="far fa-check-square"></i>Students</a>
                </li>
                <li>
                    {{-- {{ route('admin.instructors.request') }} --}}
                    <a href="{{ route('instructor.courses.display') }}">
                        <i class="fas fa-calendar-alt"></i>Add Request</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>