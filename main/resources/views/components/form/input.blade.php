<div class="form__group">
    @if ($label)
        <label for="{{ $attributes->get('id') ?: $name }}" class="form__label">{!! $label !!}</label>
    @endif

    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $attributes->get('id') ?: $name }}"
           {{ $attributes->merge(['class' => 'form__input']) }}
           @if ($placeholder) placeholder="{{ $placeholder }}" @endif
           value="{{ old($nameArray, $bind) }}"
        {{ $attributes }}>

    @if ($help)
        <div class="form__field--help-text">{!! $help !!}</div>
    @endif

    @error($nameArray)
    <div class="form__field-error">{{ $message }}</div>
    @enderror
</div>
