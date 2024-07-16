@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table id="requestsTable" class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Instructor</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#requestsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.requests.index') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'instructor', name: 'instructor.user.name' },
                    { data: 'course', name: 'course.title' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });

            window.handleRequestAction = function(id, action) {
                $.ajax({
                    url: `/admin/requests/${id}/${action}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#requestsTable').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>
@endpush
