<div class="form__group">
    @if ($label)
        <label for="{{ $attributes->get('id') ?: $name }}" class="form__label">{!! $label !!}</label>
    @endif

    <div class="form__input-file-container">
        <div class="form__input form__input--file">
            <span class="form__input-file-title">{!! $title !!}</span>
            <span class="form__input-file-name"></span>
            <span class="icon icon-link"></span>
        </div>
        <input type="file" name="{{ $name }}" id="{{ $attributes->get('id') ?: $name }}" {{ $attributes }}>
    </div>

    @if ($help)
        <div class="form__field--help-text">{{ $help }}</div>
    @endif

    @error($nameArray)
    <div class="form__field-error">{{ $message }}</div>
    @enderror
</div>
