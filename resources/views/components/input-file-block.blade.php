<div class="mb-3">
    <label for="form-label" style="text-transform: capitalize;">{{ $label ? $label : Str::replace('_',' ', $name) }}</label>
    <input type="file" class="form-control" name="{{ $name }}">
        <x-input-error :messages="$errors->get($name)" class="mt-2"/>
</div>
