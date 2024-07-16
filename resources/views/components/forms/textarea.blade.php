@props([
    'name' => 'textarea',
    'id' => 'textarea',
    'rows' => 9,
    'placeholder' => 'Content...',
    'label' => 'Textarea',
    'value' => '', // Add a 'value' prop to accept the current value
])

<div class="form-group">
    @if ($label)
        <x-forms.label :name="$name" :label="$label" /> {{-- Adjusted syntax --}}
    @endif
    <textarea name="{{ $name }}" id="{{ $id }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}"
        class="form-control @error($name) is-invalid @enderror">{{ old($name, $value) }}</textarea>
    {{-- Use old() to retain the previous input or $value for current model data --}}

    @error($name)
        <p class="text-danger text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
