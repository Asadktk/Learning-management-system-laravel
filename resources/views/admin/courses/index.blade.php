@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <a class="mb-4 au-btn au-btn-icon au-btn--green au-btn--small"
                            href="{{ route('admin.courses.create') }}">Add Course</a>

                        {{-- <button id="toggleNonActiveButton" class="btn btn-primary">Show Non-Active Courses</button> --}}

                        <table class="table table-striped table-bordered" id="coursesTable">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Course Fee</th>
                                    <th>Actions</th> <!-- Added Actions header -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Pass the named routes to JavaScript
                const showRoute = '{{ route('admin.courses.show', ':id') }}';
                const editRoute = '{{ route('admin.courses.edit', ':id') }}';

                $('#coursesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.courses.index') }}',
                    columns: [{
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                        {
                            data: 'fee',
                            name: 'fee'
                        },
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var showUrl = showRoute.replace(':id', full.id);
                                var editUrl = editRoute.replace(':id', full.id);
                                var blockButton = full.deleted_at ? 'Unblock' : 'Block';
                                var blockClass = full.deleted_at ? 'unblock-course' : 'block-course';
                                return `
                                <a href="${showUrl}" class="btn btn-info btn-sm">View</a>
                                <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                                <button data-id="${full.id}" class="btn btn-danger btn-sm ${blockClass}">${blockButton}</button>
                                <button data-id="${full.id}" class="btn btn-warning btn-sm delete-course">Delete</button>
                            `;
                            }
                        }
                    ]
                });

                // Handle block/unblock course action
                $(document).on('click', '.block-course, .unblock-course', function() {
                    var courseId = $(this).data('id');
                    var action = $(this).hasClass('block-course') ? 'block' : 'unblock';
                    $.ajax({
                        url: '/admin/courses/' + courseId + '/' + action,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#coursesTable').DataTable().ajax.reload();
                            // Optionally show success message or handle UI updates
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText); // Handle error response
                        }
                    });
                });

                // Handle delete course action
                $(document).on('click', '.delete-course', function() {
                    var courseId = $(this).data('id');
                    if (confirm('Are you sure you want to delete this course?')) {
                        $.ajax({
                            url: '/admin/courses/' + courseId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $('#coursesTable').DataTable().ajax.reload();
                                // Optionally show success message or handle UI updates
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText); // Handle error response
                            }
                        });
                    }
                });

            });
        </script>
    @endpush
@endsection
