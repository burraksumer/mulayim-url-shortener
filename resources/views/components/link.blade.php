@props([
    'href' => null,
    'external' => null,
    'target' => null,
    'className' => '',
    'variant' => 'dark',
    'iconName' => null,
    'iconNameEnd' => null,
])

<a
    class='font-semibold text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 transition-colors duration-200 rounded-md {{ $className }}'
    target={{ $target ?? '_self' }}
    @if ($href) href="{{ route($href) }}" @endif
    @if ($external) href="{{ $external }}" @endif
    @if (($target ?? '_self') !== '_blank')  @endif
>
    @isset($iconName)
        <x-v-icon name='{{ $iconName }}' />
    @endisset
    {{ $slot }}
    @isset($iconNameEnd)
        <x-v-icon
            class='ml-auto'
            name='{{ $iconNameEnd }}'
        />
    @endisset
</a>
