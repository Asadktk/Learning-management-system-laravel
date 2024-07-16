@extends('admin.layout.app')

@section('content')
    <x-forms.form-card>

        <div class="card-header">Create Course</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Course</h3>
            </div>
            <hr>
            {{-- @include('partials.messages') <!-- Include error messages --> --}}
            {{-- {{ route('admin.course.store') }} --}}
            <x-forms.form method="POST" action="admin.courses.store">
                

                <x-forms.select-instructors :instructors="$instructors" name="instructor_ids" id="instructors" />

                <x-forms.input label="Title" name="title" placeholder="Management..." />


                <x-forms.textarea name="description" id="description" rows="9" placeholder="Course Description..."
                    label="Course Description" />


                <div class="row">
                    <x-forms.input label="Fee" name="fee" type="number" :colMd6="true" />
                    <x-forms.input label="Available Seat" name="available_seat" type="number" :colMd6="true" />
                </div>

                <div class="row">
                    <x-forms.input label="Start Date" name="start_date" type="date" :colMd6="true" />
                    <x-forms.input label="End Date" name="end_date" type="date" :colMd6="true" />

                </div>

                <div class="form-group">
                    <x-forms.button>Save</x-forms.button>

                </div>
            </x-forms.form>
        </div>
    </x-forms.form-card>
@endsection
