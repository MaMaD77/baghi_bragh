<div class="{{ $cols }}">
    <div>
        @if ($label)
            <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
        @endif
        <textarea {{ $attributes->class(['form-control','is-invalid' => $errors->first($attributes['error'] ?? $attributes['name'])]) }}>{{ $slot }}</textarea>
        @error($attributes['error'] ?? $attributes['name'])
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
