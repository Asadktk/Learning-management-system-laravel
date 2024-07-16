@extends('student.layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section">

        <img src="{{ asset('student/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

        <div class="container">
            <h2 data-aos="fade-up" data-aos-delay="100">Learning Today,<br>Leading Tomorrow</h2>
            <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with Bootstrap</p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="courses.html" class="btn-get-started">Get Started</a>
            </div>
        </div>

    </section>
    <!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('student/assets/img/about.jpg') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 order-2 order-lg-1 content" data-aos="fade-up" data-aos-delay="200">
                    <h3>Voluptatem dignissimos provident quasi corporis</h3>
                    <p class="fst-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et dolore magna aliqua.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate
                                velit.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                                consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda
                                mastiro dolore eu fugiat nulla pariatur.</span></li>
                    </ul>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

            </div>

        </div>

    </section>
    <!-- /About Section -->

    <!-- Counts Section -->
    <section id="counts" class="section counts">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $studentCount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Students</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $courseCount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Courses</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $eventCount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Classes</p>
                    </div>
                </div><!-- End Stats Item -->

                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $trainerCount }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>Trainers</p>
                    </div>
                </div><!-- End Stats Item -->
            </div>
        </div>
    </section>
    <!-- /Counts Section -->

    <!-- Courses Section -->
    <section id="courses" class="courses section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Courses</h2>
            <p>Popular Courses</p>
        </div>
        <!-- End Section Title -->

        <div class="container">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="course-item">
                            <img src="{{ asset('student/assets/img/course-1.jpg') }}" class="img-fluid" alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="category">{{ $course->title }}</p>
                                    <p class="price">${{ $course->fee }}</p>
                                </div>

                                <h3><a href="{{ route('student.courses.show', $course->id) }}">{{ $course->title }}</a>
                                </h3>
                                <p class="description">{{ $course->description }}</p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    @foreach ($course->instructors as $instructor)
                                        <div class="trainer-profile d-flex align-items-center">
                                            <img src="{{ $instructor->user->image ? asset('student/assets/img/trainers/' . $instructor->user->image) : asset('student/assets/img/default-avatar.png') }}"
                                                class="img-fluid" alt="">

                                            <a href="" class="trainer-link">{{ $instructor->user->name }}</a>
                                        </div>
                                    @endforeach
                                    <div class="trainer-rank d-flex align-items-center">
                                        <i class="bi bi-person user-icon"></i>&nbsp;{{ $course->students_count }}
                                        &nbsp;&nbsp;
                                        <i class="bi bi-heart heart-icon"></i>&nbsp;{{ $course->likes_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- /Courses Section -->

    <!-- Trainers Index Section -->
    <section id="trainers" class="section trainers">

        <div class="container">

            <div class="row gy-5">
                @foreach ($instructors as $instructor)
                    <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                        <div class="member-img">
                            <img src="{{ asset('student/assets/img/trainers/trainer-1.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="social">
                                <div class="social">
                                    <a href="{{ $instructor->user->twitter }}"><i class="bi bi-twitter-x"></i></a>
                                    <a href="{{ $instructor->user->facebook }}"><i class="bi bi-facebook"></i></a>
                                    <a href="{{ $instructor->user->instagram }}"><i class="bi bi-instagram"></i></a>
                                    <a href="{{ $instructor->user->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="member-info text-center">
                            <h4>{{ $instructor->user->name }}</h4>
                            <span>Business</span>
                            <p>Aliquam iure quaerat voluptatem praesentium possimus unde laudantium vel dolorum distinctio
                                dire flow</p>
                        </div>
                    </div><!-- End Team Member -->
                @endforeach
            </div>

        </div>

    </section>
    <!-- /Trainers Index Section -->
@endsection
