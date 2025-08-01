<div {{ $attributes->merge(['class' => 'form__group form__group--radio']) }}>
    <input type="hidden" name="{{ $name }}">

    {{ $slot }}

</div>

@error($name)
<div class="form__field-error">{{ $message }}</div>
@enderror
