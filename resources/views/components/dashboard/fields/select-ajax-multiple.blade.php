<div class="{{ $cols }}" {{ $attributes->whereStartsWith('wire:key') }}>
    <div class="@error($attributes['error'] ?? $attributes['name']) has-error @enderror">
        <div wire:ignore>
            @if ($label)
                <label for="{{ $attributes['id'] }}" class="form-label fs-6 fw-bolder text-gray-700 {{ $attributes['required'] ? 'required' : '' }}">{{ $label }}</label>
                <span class="float-end">{!! $labelToolbar !!}</span>
            @endif
            <select {{ $attributes->whereDoesntStartWith('wire:key')->class(['form-select']) }} multiple data-control="select2" data-close-on-select="false">
                <option></option>
                @isset($value)
                    @foreach ($value as $key => $val)
                        <option value="{{ $val }}" selected>{{ $val }}</option>
                    @endforeach
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
                let value = @json($value);

                window['select-ajax-multiple'](id, value, @this);
            });
        </script>
    @endpush
@else
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', function() {
                let id = "{{ $attributes['id'] }}";
                let value = @json($value);

                window['select-ajax-multiple'](id, value);
            });
        </script>
    @endpush
@endif
