<div class="{{ $formGroupClass ?? 'mb-3' }}">
    @isset($label)
        <label class="form-label {{ isset($required) ? 'required' : '' }}"
            for="{{ $name }}">{{ $label }}</label>
    @endisset

    <div class="input-icon">
        @isset($icon)
            <span class="input-icon-addon">
                <i class="las la-{{ $icon }}"></i>
            </span>
        @endisset

        <select class="form-select {{ $formControlClass ?? '' }} @error($name) is-invalid @enderror"
            id="{{ $name }}" name="{{ $name }}" {{ $attributes }}>
            {{ $slot }}
        </select>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <small class="text-muted">
            @isset($optional)
                Kosongkan jika tidak ingin mengubah
            @endisset
        </small>
    </div>
</div>
