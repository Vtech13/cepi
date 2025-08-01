<div class="form__group {{ !empty($fluid) ? 'form__group--fluid' : '' }}">
    @if ($label)
        <label for="{{ $name }}" class="form__label">{{ $label }}</label>
    @endif

    <textarea name="{{ $name }}"
              id="{{ $attributes->get('id') ?: $name }}"
              {{ $attributes->merge(['class' => 'form__input form__input--textarea']) }}
              @if ($placeholder) placeholder="{{ $placeholder }}" @endif
              @if ($count) data-count="{{ $count }}" @endif
              {{ $attributes }}>{{ old($name, $bind) }}</textarea>

    @error($name)
    <div class="form__field-error">{{ $message }}</div>
    @enderror

    @if ($count)
        <div class="form__count-character">
            <span id="char-count"></span>/{{ $count }}
        </div>
    @endif
</div>
