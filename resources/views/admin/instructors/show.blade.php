@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Instructor Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Instructor Name: {{ $instructor->user->name }}</h5>
                            <p class="card-text">Email: {{ $instructor->user->email }}</p>
                            <p class="card-text">Created At: {{ $instructor->created_at }}</p>
                            <p class="card-text">Updated At: {{ $instructor->updated_at }}</p>

                            @if ($instructor->deleted_at)
                                <p class="card-text text-danger">Status: Blocked</p>
                            @else
                                <p class="card-text text-success">Status: Active</p>
                            @endif

                            <p class="card-text mt-4">Assigned Courses:</p>
                            <ul>
                                @forelse ($instructor->courses as $course)
                                    <li>{{ $course->title }}</li>
                                @empty
                                    <p class="card-text text-danger">This instructor is not assigned to any courses</p>
                                @endforelse
                            </ul>

                            <a href="{{ route('admin.instructors.index') }}" class="btn btn-primary">Back</a>
                            <button data-id="{{ $instructor->id }}" class="btn btn-danger block-instructor">
                                {{ $instructor->deleted_at ? 'Unblock' : 'Block' }}
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
            // Handle block/unblock instructor action
            $(document).on('click', '.block-instructor', function() {
                var instructorId = $(this).data('id');
                var action = $(this).text().trim().toLowerCase();
                $.ajax({
                    url: '/admin/instructors/' + instructorId + '/' + action,
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
