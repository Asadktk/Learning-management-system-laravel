@props(['method' => 'POST', 'action', 'params' => []])

<form action="{{ Str::contains($action, '.') ? route($action, $params) : $action }}" method="{{ strtoupper($method) }}" class="">
    @if ($method !== 'GET')
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>




{{-- <form {{ $attributes(["class" => "", "method" => "GET"]) }}>

    @if ($attributes->get('method', 'GET') !== 'GET')
    @csrf
    @method($attributes->get('method'))
        
    @endif

    {{ $slot }}
</form> --}}