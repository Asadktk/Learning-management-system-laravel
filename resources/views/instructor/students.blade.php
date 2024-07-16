@extends('instructor.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table id="studentsTable" class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Course Title</th>
                                    <th>Operation</th>
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
                const showRoute = '{{ route('instructor.students.show', ':id') }}';

                $('#studentsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('instructor.students.data') }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'course_title', name: 'course_title' },
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var showUrl = showRoute.replace(':id', full.id);
                                var blockButton = full.deleted_at ? 'Unblock' : 'Block';
                                var blockClass = full.deleted_at ? 'unblock-student' : 'block-student';
                                return `
                                    <a href="${showUrl}" class="btn btn-info btn-sm">View</a>
                                    <button data-id="${full.id}" class="btn btn-danger btn-sm ${blockClass}">${blockButton}</button>
                                    <button data-id="${full.id}" class="btn btn-warning btn-sm delete-student">Delete</button>
                                `;
                            }
                        }
                    ]
                });

                // Handle block/unblock student action
                $(document).on('click', '.block-student, .unblock-student', function() {
                    var studentId = $(this).data('id');
                    var action = $(this).hasClass('block-student') ? 'block' : 'unblock';
                    $.ajax({
                        url: '/instructor/students/' + studentId + '/' + action,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#studentsTable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                // Handle delete student action
                $(document).on('click', '.delete-student', function() {
                    var studentId = $(this).data('id');
                    if (confirm('Are you sure you want to delete this student?')) {
                        $.ajax({
                            url: '/instructor/students/' + studentId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $('#studentsTable').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });

            });
        </script>
    @endpush
@endsection
