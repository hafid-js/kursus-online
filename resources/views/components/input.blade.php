<div class="mb-3">
    <label for="form-label">Name</label>
    <input type="text" class="form-control" name="name"
        placeholder="Enter language name">
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
</div>
