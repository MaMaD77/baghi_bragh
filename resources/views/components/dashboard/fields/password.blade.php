<div class="{{ $cols }}" data-kt-password-meter="true" {{ $attributes->whereStartsWith('wire:key') }}>
    <div>
        <label class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
        <div class="position-relative mb-3 @error('password') is-invalid @enderror">
            <input type="password" {{ $attributes->class(['form-control']) }} name="password" />
            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                <i class="bi bi-eye-slash fs-2"></i>
                <i class="bi bi-eye fs-2 d-none"></i>
            </span>
        </div>
        @error('password')
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
        </div>
    </div>
    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
</div>
