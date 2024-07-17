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
                $('#studentsTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('instructor.students.index') }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'course_title',
                            name: 'course_title'
                        }, // Updated column
                        {
                            data: 'id',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, full, meta) {
                               
                                return `
                            `;
                            }
                        }
                    ]
                });


            });
        </script>
    @endpush
@endsection
