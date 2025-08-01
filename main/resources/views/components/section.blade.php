<section
    {{ $attributes->merge(['class' => 'section ' . $class]) }}>
    <div class="{{ $classContainer }}">
        {{ $slot }}
    </div>
</section>
