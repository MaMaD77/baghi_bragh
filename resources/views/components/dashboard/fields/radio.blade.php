<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="form-check form-check-sm form-check-custom">
        <input type="radio" {{ $attributes->whereDoesntStartWith('wire:key')->merge(['class' => 'form-check-input']) }} />
        <label for="{{ $attributes['id'] }}" class="form-check-label text-gray-600 fw-bold">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center flex-grow-1">
                    @isset($imageUrl)
                        <span class="symbol symbol-45px me-1">
                            <img class="cover" src="{{ $imageUrl }}">
                        </span>
                    @endisset
                    <div class="d-flex flex-column">
                        <span class="text-gray-900 fs-6 fw-bolder">{{ $label }}</span>
                        @isset($subLabel)
                            <span class="text-muted fw-bold">{{ $subLabel }}</span>
                        @endisset
                    </div>
                </div>
            </div>
        </label>
    </div>
</div>
