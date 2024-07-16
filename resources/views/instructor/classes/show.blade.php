@extends('admin.layout.app')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Class Details
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Course: {{ $period->course->title }}</h5>
                            <p class="card-text">Start Time: {{ $period->start_time }}</p>
                            <p class="card-text">End Time: {{ $period->end_time }}</p>
                            <p class="card-text">Created At: {{ $period->created_at }}</p>
                            <p class="card-text">Updated At: {{ $period->updated_at }}</p>
                            
                        

                            <a href="{{ route('instructor.periods.display') }}" class="btn btn-primary">Back to Periods</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
