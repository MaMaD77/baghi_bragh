<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="@error($attributes['error'] ?? $attributes['name']) has-error @enderror">
        <div wire:ignore>
            @if ($label)
                <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
                <span class="float-end">{!! $labelToolbar !!}</span>
            @endif
            <select {{ $attributes->whereDoesntStartWith('wire:key')->class(['form-control']) }} data-minimum-results-for-search="10">
                <option></option>
                @isset($value)
                    <option value="{{ $value }}" selected>{{ $value }}</option>
                @endisset
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

                window['select-ajax'](id, value, @this);
            });
        </script>
    @endpush
@else
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', function() {
                let id = "{{ $attributes['id'] }}";
                let value = "{{ $value }}";

                window['select-ajax'](id, value);
            });
        </script>
    @endpush
@endif
