<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div {{ $attributes->whereStartsWith('wire:ignore') }}>
        @if ($label)
            @isset($labelToolbar)
                <div class="float-end">
                    {{ $labelToolbar }}
                </div>
            @endisset
            <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
        @endif
        <input {{ $attributes->whereDoesntStartWith('wire:key')->whereDoesntStartWith('wire:ignore')->class(['form-control', 'is-invalid' => $errors->first($attributes['error'] ?? $attributes['name'])]) }} />
        @error($attributes['error'] ?? $attributes['name'])
            <span class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
