<div class="form-group">
    <label for="input{{ ucfirst($property) }}">{{ $name }}: <span class="text-danger">*</span></label>
    <select name="{{ $property }}" id="input{{ ucfirst($property) }}" class="form-control">
        <option value="">Chọn {{ strtolower($name) }}</option>
        {{ $slot }}
    </select>
    @error($property)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
