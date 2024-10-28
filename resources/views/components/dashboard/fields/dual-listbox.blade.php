<div class="{{ $cols }}">
    <select required multiple="multiple" name="favorite_cars" {{ $attributes }}>
        @foreach ($options as $option)
            <option @if (in_array($option[$optionValue], $values)) selected @endif value="{{ $option[$optionValue] }}">{{ $option[$optionText] }}</option>
        @endforeach
    </select>
    @error($attributes['error'] ?? $attributes['name'])
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
