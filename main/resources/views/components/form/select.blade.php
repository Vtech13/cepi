<div class="form__group">
    @if ($label)
        <label for="{{ $attributes->get('id') ?: $name }}" class="form__label">{{ $label }}</label>
    @endif

    <select name="{{ $name }}"
            id="{{ $attributes->get('id') ?: $name }}"
        {{ $attributes->merge(['class' => 'form__input form__input--select']) }}>
        @forelse($options as $key => $value)
            <option value="{{ $key }}" @if (old($name, $bind) == $key) selected @endif>{{ $value }}</option>
        @empty
            {{ $slot }}
        @endforelse
    </select>

    @error($name)
        <div class="form__field-error">{{ $message }}</div>
    @enderror

</div>
