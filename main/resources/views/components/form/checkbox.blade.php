<div class="form__group form__group--checkbox">
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox"
           name="{{ $name }}"
           id="{{ $attributes->get('id') ?: $name }}"
           {{ $attributes->merge(['class' => 'form__input form__input--checkbox']) }}
           value="{{ $value }}"
           @if ($checked) checked @endif>

    @if ($label)
        <label for="{{ $attributes->get('id') ?: $name }}" class="form__label">{{ $label }}</label>
    @endif

    @error($name)
    <div class="form__field-error">{{ $message }}</div>
    @enderror
</div>

