<button type="{{ $type }}" {{ $attributes->merge(['class' => 'form__button']) }}>
    {{ $slot }}
</button>
