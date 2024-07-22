@extends('instructor.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <a class="mb-4 au-btn au-btn-icon au-btn--green au-btn--small"
                            href="{{ route('instructor.periods.create') }}">Add Period</a>
                        <table class="table table-striped table-bordered" id="periodsTable">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions</th>
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

                const showRoute = '{{ route('instructor.periods.show', ':id') }}';
                const editRoute = '{{ route('instructor.periods.edit', ':id') }}';

                $('#periodsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('instructor.periods.index') }}',
                    columns: [{
                            data: 'course.title',
                            name: 'course.title',
                            title: 'Course Name',
                            defaultContent: 'No Course'
                        },
                        {
                            data: 'start_time_formatted',
                            name: 'start_time',
                            title: 'Start Time'
                        },
                        {
                            data: 'end_time_formatted',
                            name: 'end_time',
                            title: 'End Time'
                        },
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var showUrl = showRoute.replace(':id', full.id);
                                var editUrl = editRoute.replace(':id', full.id);

                                return `
                                    <a href="${showUrl}" class="btn btn-info btn-sm">View</a>
                                    <a href="${editUrl}" class="btn btn-warning btn-sm">Edit</a>
                                    <button data-id="${full.id}" class="btn btn-danger btn-sm delete-period">Delete</button>
                                `;
                            }
                        }
                    ]
                });

                $(document).on('click', '.delete-period', function() {
                    var periodId = $(this).data('id');
                    if (confirm('Are you sure you want to delete this period?')) {
                        $.ajax({
                            url: '/instructor/periods/' + periodId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                $('#periodsTable').DataTable().ajax.reload();
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
