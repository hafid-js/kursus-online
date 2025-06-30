<div class="mb-3">
    <label for="form-label" style="text-transform: capitalize;">{{ $label ? $label : str_replace('_',' ', $name )}}</label>
    <input type="text" class="form-control" name="{{ $name }}"
        placeholder="{{ $placeholder }}" value="{{ $value }}">
        <x-input-error :messages="$errors->get($name)" class="mt-2"/>
            @isset($hint)
            {{ $hint }}
            @endisset
</div>
