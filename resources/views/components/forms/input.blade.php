@props(['label', 'name', 'colMd6' => false])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'au-input au-input--full',
        'value' => old($name)
];
@endphp

<x-forms.field :$label :$name :$colMd6>

    <input {{ $attributes($defaults) }}>
</x-forms.field>


