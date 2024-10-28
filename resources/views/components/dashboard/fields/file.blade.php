<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div {{ $attributes->whereStartsWith('wire:ignore') }} class="@error($attributes['error'] ?? $attributes['name']) is-invalid @enderror">
        <label for="{{ $attributes['id'] }}" class="form-label mb-1 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
        <input type="file" {{ $attributes->whereDoesntStartWith('wire:key')->whereDoesntStartWith('wire:ignore')->class(['', 'is-invalid' => $errors->first($attributes['error'] ?? $attributes['name'])]) }}>
    </div>
    @error($attributes['error'] ?? $attributes['name'])
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', function() {
            let id = "{{ $attributes['id'] }}";
            let model = "{{ $attributes->get('wire:model') }}";
            let isMultiple = "{{ $attributes['multiple'] }}";

            @this.dispatch('init-filepond', [{
                componentId: @this.id,
                id: id,
                name: model,
                isMultiple: isMultiple == 1 ? true : false,
                model: 'defer',
                urls: @json($urls),
            }])
        });
    </script>
@endpush
