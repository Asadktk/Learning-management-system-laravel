@extends('instructor.layout.app')

@section('content')
    <x-forms.form-card>

        <div class="card-header">Edit Period</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Period</h3>
            </div>
            <hr>
            {{-- @include('partials.messages') <!-- Include error messages --> --}}

            <x-forms.form method="POST" action="instructor.periods.update" :params="['id' => $period->id]">

                <x-forms.select-course :courses="$courses" name="course_id" :selected="$period->course_id" />

                <div class="row">
                    <x-forms.input label="Start Date" name="start_time" type="datetime-local" :colMd6="true"
                        :value="$period->start_time->format('Y-m-d\TH:i')" />
                    <x-forms.input label="End Date" name="end_time" type="datetime-local" :colMd6="true"
                        :value="$period->end_time->format('Y-m-d\TH:i')" />
                </div>

                <div class="form-group">
                    <x-forms.button>Update</x-forms.button>

                </div>
            </x-forms.form>
        </div>
    </x-forms.form-card>
@endsection
