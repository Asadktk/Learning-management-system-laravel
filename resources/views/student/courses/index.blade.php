@extends('student.layouts.app')

@section('content')
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Courses</h1>
                        <p class="mb-0">Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint
                            voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi
                            ratione sint. Sit quaerat ipsum dolorem.</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Courses</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->


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

                                <h3><a href="{{ route('student.courses.show', $course->id) }}">{{ $course->title }}</a></h3>
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
   
@endsection
