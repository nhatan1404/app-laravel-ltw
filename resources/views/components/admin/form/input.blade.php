@props([
    'name' => '',
    'property' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'min' => 0,
    'max' => PHP_INT_MAX,
])

<div class="form-group">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <input class="form-control" type="{{ $type }}" id="input{{ ucfirst($property) }}"
        name="{{ $property }}" placeholder="{{ $placeholder }}" value="{{ $value }}"
        {{ $type == 'number' ? ' min=' . $min . '' : '' }} {{ $type == 'number' ? ' max=' . $max . '' : '' }} />
    @error($property)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
