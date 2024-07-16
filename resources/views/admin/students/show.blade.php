@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Student Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Student Name: {{ $student->user->name }}</h5>
                            <p class="card-text">Email: {{ $student->user->email }}</p>
                            <p class="card-text">Created At: {{ $student->created_at }}</p>
                            <p class="card-text">Updated At: {{ $student->updated_at }}</p>

                            @if ($student->deleted_at)
                                <p class="card-text text-danger">Status: Blocked</p>
                            @else
                                <p class="card-text text-success">Status: Active</p>
                            @endif

                            <p class="card-text mt-4">Assigned Courses:</p>
                            <ul>
                                @forelse ($student->enrollments as $enrollment)
                                    <li>
                                        {{ $enrollment->instructorCourse->course->title }} 
                                        - Instructor: {{ $enrollment->instructorCourse->instructor->user->name }}
                                    </li>
                                @empty
                                    <p class="card-text text-danger">This student is not assigned to any courses</p>
                                @endforelse
                            </ul>

                            <a href="{{ route('admin.students.index') }}" class="btn btn-primary">Back</a>
                            <button data-id="{{ $student->id }}" class="btn btn-danger block-student">
                                {{ $student->deleted_at ? 'Unblock' : 'Block' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle block/unblock student action
            $(document).on('click', '.block-student', function() {
                var studentId = $(this).data('id');
                var action = $(this).text().trim().toLowerCase();
                $.ajax({
                    url: '/admin/students/' + studentId + '/' + action,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
