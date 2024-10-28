<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="form-check form-check-sm form-check-custom">
        <input type="checkbox" {{ $attributes->whereDoesntStartWith('wire:key')->class(['form-check-input']) }} />
        <label for="{{ $attributes['id'] }}" class="form-check-label text-gray-600 fw-bold">
            {{ $label }}
        </label>
    </div>
</div>
