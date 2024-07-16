<!-- dropdown-single.blade.php -->

@props(['courses', 'name' => 'course_id', 'id' => 'course_id', 'selected' => null])

<div class="form-group">
    <label for="{{ $id }}" class="control-label">Courses</label>
    <select id="{{ $id }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
        <option value="">Select a course</option>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}" @if($selected == $course->id) selected @endif>{{ $course->title }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="text-danger text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
