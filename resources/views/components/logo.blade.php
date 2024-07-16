@props(['src', 'alt', 'href' => '#'])

<div class="login-logo">
    <a href="{{ $href }}">
        <img src="{{ asset($src) }}" alt="{{ $alt }}">
    </a>
</div>