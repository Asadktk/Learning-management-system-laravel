@props(['error' => false])

@if ($error)
        <p class="text-sm text-danger mb-0">{{ $error }}</p>
@endif

