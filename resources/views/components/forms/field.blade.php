@props(['label', 'name', 'colMd6' => false])

@if ($colMd6)
    <div class="col-md-6">
@endif

    <div class="form-group">
        @if ($label)
            <label for="{{ $name }}" class="control-label">{{ $label }}</label>
        @endif

        <div class="mt-1">
            {{ $slot }}

            @error($name)
                <p class="text-danger text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

@if ($colMd6)
    </div>
@endif
