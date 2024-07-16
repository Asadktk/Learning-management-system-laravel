@props(['instructors', 'name' => 'instructor_ids', 'id' => 'instructors', 'selected' => []])

<div class="form-group">
    <label for="{{ $id }}" class="control-label">Instructors</label>
    <select id="{{ $id }}" name="{{ $name }}[]" multiple class="form-control @error($name) is-invalid @enderror">
        @foreach ($instructors as $instructor)
            <option value="{{ $instructor->id }}" @if(in_array($instructor->id, $selected)) selected @endif>{{ $instructor->user->name }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="text-danger text-sm mt-2">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#{{ $id }}').select2({
                placeholder: "Select instructors",
                allowClear: true,
                tags: true
            });
        });
    </script>
@endpush



{{-- @props(['instructors', 'name' => 'instructor_ids', 'id' => 'instructors'])

<div class="form-group">
    <label for="{{ $id }}" class="control-label">Instructors</label>
    <select id="{{ $id }}" name="{{ $name }}[]" multiple class="form-control @error($name) is-invalid @enderror">
        @foreach ($instructors as $instructor)
            <option value="{{ $instructor->id }}">{{ $instructor->user->name }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="text-danger text-sm mt-2">{{ $message }}</p>
    @enderror
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#{{ $id }}').select2({
            placeholder: "Select instructors",
            allowClear: true,
            tags: true
        });
    });
</script> --}}
