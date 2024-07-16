@extends('instructor.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <h3>Available Courses</h3>
                        <table class="table table-striped" id="coursesTable">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Action</th>
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
            $('#coursesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('instructor.courses.request') }}',
                columns: [
                    { data: 'title', name: 'title' },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            return '<button class="btn btn-primary btn-sm request-course" data-id="' + full.id + '">Request to Teach</button>';
                        }
                    }
                ]
            });

            $(document).on('click', '.request-course', function() {
                var courseId = $(this).data('id');
                if (confirm('Are you sure you want to request to teach this course?')) {
                    $.ajax({
                        url: '{{ route('instructor.courses.store_request') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            course_id: courseId
                        },
                        success: function(response) {
                            alert('Request sent successfully.');
                            $('#coursesTable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Failed to send request. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
