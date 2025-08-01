<div class="{{ $inline ? 'form__radio form__radio--inline' : 'form__radio' }}">
    <input type="radio"
           name="{{ $name }}"
           id="{{ $attributes->get('id') }}"
           value="{{ $value }}"
           {{ $attributes->merge(['class' => 'form__input']) }}
           @if ($checked) checked @endif>

    @if ($label)
        <label for="{{ $attributes->get('id') }}" class="form__label">{{ $label }}</label>
    @endif
</div>
