<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div {{ $attributes->whereStartsWith('wire:ignore') }}>
        @if ($label)
            <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
        @endif

        <div class="input-group input-group-merge @error($attributes['error'] ?? $attributes['name']) has-error @enderror">
            @if ($addonPrepend)
                <span class="input-group-text">{!! $addonPrepend !!}</span>
            @endif
            <input {{ $attributes->whereDoesntStartWith('wire:key')->whereDoesntStartWith('wire:ignore')->class(['form-control']) }} />

            @if ($addonAppend)
                <span class="input-group-text">{!! $addonAppend !!}</span>
            @endif
            @error($attributes['error'] ?? $attributes['name'])
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
