<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="@error($attributes['error'] ?? $attributes['name']) has-error @enderror">
        <div wire:ignore>
            @if ($label)
                <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
            @endif
            <select {{ $attributes->class(['form-control']) }} data-minimum-results-for-search="10">
                @foreach ($options as $key => $name)
                    <option value="{{ $key }}" @if ($key == $value) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @error($attributes['error'] ?? $attributes['name'])
        <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@if (!$attributes->whereStartsWith('wire:model')->isEmpty())
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', function() {
                let id = "{{ $attributes['id'] }}";
                let value = "{{ $value }}";

                window['select'](id, value, @this);
            });
        </script>
    @endpush
@else
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', function() {
                let id = "{{ $attributes['id'] }}";
                let value = "{{ $value }}";

                window['select'](id, value);
            });
        </script>
    @endpush
@endif
