@extends('student.layouts.app')

@section('content')

    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Course Enrolled</h1>
                        <p class="mb-0">{{ $course->description ?? 'Course Description' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li class="current">Course Enrolled</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->
    <section id="courses-course-details" class="courses-course-details section">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        @if (session('error'))
                            @if (session('error') === 'no_seats_available')
                                <div class="alert alert-danger" role="alert">
                                    There are no available seats for this course at the moment.
                                </div>
                            @elseif (session('error') === 'already_enrolled')
                                <div class="alert alert-danger" role="alert">
                                    You are already enrolled in this course.
                                </div>
                            @endif
                            @php
                                session()->forget('error');
                            @endphp
                        @elseif (session('success') === 'enrollment_success')
                            <div class="alert alert-success" role="alert">
                                You have successfully enrolled in the course.
                            </div>
                            @php
                                session()->forget('success');
                            @endphp
                        @endif
                    </div>
                    {{-- {{ url('/course-enroll/' . $course->id) }} --}}
                    <form action="{{ route('student.courses.store', $course->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="instructor_id">Trainer</label>
                            <select id="instructor_id" name="instructor_id" class="form-control mb-3">
                                @forelse ($course->instructors as $instructor)
                                    <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
                                @empty
                                    <option value="">Unknown Instructor</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fee">Course Fee</label>
                            <input type="text" id="fee" name="fee" class="form-control mb-3"
                                value="{{ $course->fee ?? '0.00$' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="available_seat">Available Seats</label>
                            <input type="text" id="available_seat" name="available_seat" class="form-control mb-3"
                                value="{{ $availableSeats ?? '00' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="schedule">Schedule</label>
                            <input type="text" id="schedule" name="schedule" class="form-control mb-3"
                                value="{{ $course->start_date && $course->end_date ? date('F j, Y', strtotime($course->start_date)) . ' - ' . date('F j, Y', strtotime($course->end_date)) : 'Schedule not available' }}"
                                readonly>
                        </div>

                        <!-- Enroll CTA -->
                        <input type="submit" class="btn btn-primary" value="Enroll" style="width: 100%;">
                    </form>


                    <a href="/" class="btn btn-primary mt-3">Back to Courses</a>
                </div>
            </div>
        </div>
    </section>

@endsection
