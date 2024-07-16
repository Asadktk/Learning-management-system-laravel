@extends('student.layouts.app') 

@section('content')
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Course Details</h1>
                        <p class="mb-0">{{ $course->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">Course Details</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Courses Course Details Section -->
    <section id="courses-course-details" class="courses-course-details section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-8">
                    <img src="{{ asset('assets/img/course-details.jpg') }}" class="img-fluid" alt="">
                    <h3>{{ $course->title }}</h3>
                    <p>{{ $course->description }}</p>
                </div>
                <div class="col-lg-4">
                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Trainers</h5>
                        @if ($course->instructors->isNotEmpty())
                            @foreach ($course->instructors as $instructor)
                                <p><a href="#">{{ $instructor->user->name }}</a></p>
                            @endforeach
                        @else
                            <p>Unknown Instructors</p>
                        @endif
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Course Fee</h5>
                        <p>${{ number_format($course->fee, 2) }}</p>
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Available Seats</h5>
                        <p>{{ $availableSeats }}</p> <!-- Display available seats here -->
                    </div>

                    <div class="course-info d-flex justify-content-between align-items-center">
                        <h5>Schedule</h5>
                        <p>
                            @if ($course->start_date && $course->end_date)
                                {{ date('F j, Y', strtotime($course->start_date)) }} - {{ date('F j, Y', strtotime($course->end_date)) }}
                            @else
                                Schedule not available
                            @endif
                        </p>
                    </div>

                    <!-- enroll cta -->
                    {{-- {{ route('course.enroll', $course->id) }} --}}
                    <a href="{{ route('courses.create', $course->id) }}"
                        style="background-color: #04AA6D; border: none; color: white; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; padding: 6px 18px; border-radius: 7px;">
                        Enroll
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
