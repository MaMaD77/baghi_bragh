<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="form-check form-switch {{ $colorClass ?? '' }}">
        <input type="checkbox" {{ $attributes->whereDoesntStartWith('wire:key')->class(['form-check-input']) }}>
        <label class="form-check-label" for="{{ $attributes['id'] }}">{{ $label }}</label>
    </div>
</div>
