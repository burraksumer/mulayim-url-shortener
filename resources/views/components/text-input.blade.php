@props(['disabled' => false, 'readonly' => false])

<input
    @disabled($disabled)
    @readonly($readonly)
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 rounded-md shadow-sm']) }}
>
