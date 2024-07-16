@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        {{-- <button id="toggleNonActiveButton" class="btn btn-primary">Show Non-Active Instructors</button> --}}
                        <table id="instructorsTable" class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Courses</th>
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
                const showRoute = '{{ route('admin.instructors.show', ':id') }}';

                $('#instructorsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('admin.instructors.data') }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'courses', name: 'courses' },
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var showUrl = showRoute.replace(':id', full.id);
                                var blockButton = full.deleted_at ? 'Unblock' : 'Block';
                                var blockClass = full.deleted_at ? 'unblock-instructor' : 'block-instructor';
                                return `
                                    <a href="${showUrl}" class="btn btn-info btn-sm">View</a>
                                    <button data-id="${full.id}" class="btn btn-danger btn-sm ${blockClass}">${blockButton}</button>
                                    <button data-id="${full.id}" class="btn btn-warning btn-sm delete-instructor">Delete</button>
                                `;
                            }
                        }
                    ]
                });

                // Handle block/unblock instructor action
                $(document).on('click', '.block-instructor, .unblock-instructor', function() {
                    var instructorId = $(this).data('id');
                    var action = $(this).hasClass('block-instructor') ? 'block' : 'unblock';
                    $.ajax({
                        url: '/admin/instructors/' + instructorId + '/' + action,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $('#instructorsTable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                // Handle delete instructor action
                $(document).on('click', '.delete-instructor', function() {
                    var instructorId = $(this).data('id');
                    if (confirm('Are you sure you want to delete this instructor?')) {
                        $.ajax({
                            url: '/admin/instructors/' + instructorId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $('#instructorsTable').DataTable().ajax.reload();
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
