@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Course Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">Start Date: {{ $course->start_date }}</p>
                            <p class="card-text">End Date: {{ $course->end_date }}</p>
                            <p class="card-text">Course Fee: {{ $course->fee }}</p>
                            <p class="card-text">Description: {{ $course->description }}</p>

                            @if ($course->deleted_at)
                                <p class="card-text text-danger">Status: Blocked</p>
                            @else
                                <p class="card-text text-success">Status: Active</p>
                            @endif

                            <p class="card-text mt-4">Assigned Instructors:</p>
                            <ul>
                                @forelse ($course->instructors as $instructor)
                                <li>{{ $instructor->user->name }}</li>
                                @empty
                                <p class="card-text text-danger">There is no instructor for this course</p>
                                @endforelse
                               
                            </ul>

                            <a href="{{ route('admin.courses.display') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
