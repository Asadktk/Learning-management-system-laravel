@extends('admin.layout.app')

@section('content')
    <x-forms.form-card>
        <div class="card-header">Edit Course</div>
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Course</h3>
            </div>
            <hr>

            <x-forms.form method="POST" action="admin.courses.update" :params="['id' => $course->id]">
                <x-forms.select-instructors :instructors="$instructors" name="instructor_ids[]" id="instructors" :selected="$course->instructors->pluck('id')->toArray()" />
                    <x-forms.input label="Title" name="title" placeholder="Management..." :value="$course->title" />
                <x-forms.textarea name="description" id="description" rows="9" label="Course Description"
                    :value="$course->description" />
                {{-- <x-textarea :value="$model->content" /> --}}
                <div class="row">
                    <x-forms.input label="Fee" name="fee" type="number" :colMd6="true" :value="$course->fee" />
                    <x-forms.input label="Available Seat" name="available_seat" type="number" :colMd6="true"
                        :value="$course->available_seat" />
                </div>

                <div class="row">
                    <x-forms.input label="Start Date" name="start_date" type="date" :colMd6="true"
                        :value="$course->start_date->format('Y-m-d')" />
                    <x-forms.input label="End Date" name="end_date" type="date" :colMd6="true" :value="$course->end_date->format('Y-m-d')" />
                </div>

                <div class="form-group">
                    <x-forms.button>Update</x-forms.button>
                </div>
            </x-forms.form>
        </div>
    </x-forms.form-card>
@endsection
