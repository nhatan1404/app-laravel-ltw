@props([
    'name' => '',
    'property' => '',
    'placeholder' => '',
    'value' => null,
    'rows' => '0',
    'columns' => '0',
])

<div class="form-group">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <textarea class="form-control" id="input{{ ucfirst($property) }}" name="{{ $property }}"
        placeholder="{{ $placeholder }}"{{ $rows > 0 ? ' rows="' + $rows + '"' : '' }}
        {{ $columns > 0 ? ' columns="' + $columns + '"' : '' }}>{{ $value }}</textarea>
    @error($property)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
