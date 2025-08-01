@props([
    'file' => asset('img/icon/icon.svg'),
    'name'
])

<svg {{ $attributes->merge(['class' => 'icon-svg icon-'. $name]) }}>
    <use href="{{ $file }}#{{ $name }}"></use>
</svg>
