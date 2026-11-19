@props(['value'])

@php
    $filled = (int) round($value);
@endphp

<span class="text-yellow-500" title="{{ $value }} out of 5">
    {{ str_repeat('★', $filled) }}{{ str_repeat('☆', 5 - $filled) }}
</span>