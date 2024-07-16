@extends('student.layouts.app')

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>My Courses<br></h1>
                        <p class="mb-0">My enrolled courses.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">My Courses<br></li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Add this section to your mycourse.blade.php file -->
    <section id="my-courses" class="courses section">
        <div class="container">
            <div class="row">

                @forelse ($enrollments as $enrollment)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="course-item">
                            <img src="{{ asset('student/assets/img/hero-bg.jpg') }}" class="img-fluid" alt="...">
                            <div class="course-content">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="category">{{ $enrollment->instructorCourse->course->title }}</p>
                                    <p class="price">${{ $enrollment->instructorCourse->course->fee }}</p>
                                </div>

                                <h3><a
                                        href="{{ route('student.courses.show', $enrollment->instructorCourse->course->id) }}">{{ $enrollment->instructorCourse->course->title }}</a>
                                </h3>
                                <p class="description">{{ $enrollment->instructorCourse->course->description }}</p>
                                <div class="trainer d-flex justify-content-between align-items-center">
                                    <div class="trainer-profile d-flex align-items-center">
                                        <img src="{{ $enrollment->instructorCourse->instructor->user->profile_image }}"
                                            class="img-fluid" alt="">
                                        <a href="#"
                                            class="trainer-link">{{ $enrollment->instructorCourse->instructor->user->name }}</a>
                                    </div>
                                    <div class="trainer-rank d-flex align-items-center">
                                        <i
                                            class="bi bi-person user-icon"></i>&nbsp;{{ $enrollment->instructorCourse->instructor->students_count }}
                                        &nbsp;&nbsp;
                                        <i
                                            class="bi bi-heart heart-icon"></i>&nbsp;{{ $enrollment->instructorCourse->instructor->likes_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Course Item-->
                @empty
                    <h5 class="text-danger">You are not enrolled in any course</h5>
                @endforelse

            </div>
        </div>
    </section>
@endsection
