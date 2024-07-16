<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="/" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="{{ asset('student/img/logo.png') }}" alt=""> -->
            <h1 class="sitename">Mentor</h1>
        </a>

        <nav id="navmenu navbar-expand-lg" class="navmenu">
            <ul>
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('students.about') }}"
                        class="{{ request()->routeIs('students.about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('student.courses.index') }}"
                        class="{{ request()->routeIs('student.courses.index') ? 'active' : '' }}">All Courses</a></li>
                <li><a href="{{ route('student.instructors.index') }}"
                        class="{{ request()->routeIs('student.instructors.index') ? 'active' : '' }}">Trainers</a></li>
                <li><a href="{{ route('students.contact') }}"
                        class="{{ request()->routeIs('students.contact') ? 'active' : '' }}">Contact Us</a></li>
                <li><a href="{{ route('students.mycourses') }}"
                        class="{{ request()->routeIs('students.mycourses') ? 'active' : '' }}">My Enroll Courses</a>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @guest()
            <a class="btn-getstarted" href="{{ route('login') }}">Get Started</a>
        @endguest

        @auth
            {{-- {{ route('student.profife') }} --}}
            <a class="btn-getstarted" href="{{ route('edit.profile') }}">My Profile</a>
            <a class="btn-getstarted" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out
            </a>
        @endauth

        <form method="POST" action="/logout" id="logout-form" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</header>
