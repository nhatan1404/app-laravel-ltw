@props([
    'name' => '',
    'property' => '',
    'placeholder' => '',
    'value' => null,
])

<div class="form-group">
    <label for="input{{ ucfirst($property) }}" class="col-form-label">{{ $name }}: </label>
    <input class="form-control" id="input{{ ucfirst($property) }}" name="{{ $property }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}" />
    @error($property)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
