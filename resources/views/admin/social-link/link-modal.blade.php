<form id="{{ $editMode ? 'updateLink' : 'addLink' }}"
    action="{{ $editMode ? route('admin.social-links.update', $socialLink->id) : route('admin.social-links.store') }}"
    method="POST">

    @csrf
    @if ($editMode)
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Social Link' : 'Add Social Link' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <x-input-block name="icon" placeholder="Enter icon" value="{{ $socialLink->icon ?? '' }}" />
                                                 <p>Search Icon : <a href="https://fontawesome.com/icons" target="_blank" class="text-red">FontAwesome.com</a> </p>
                      <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-icon' : 'error-icon' }}"></div>
            </div>
            <div class="col-md-6 mb-3">
                <x-input-block name="url" value="{{ $socialLink->url ?? '' }}" placeholder="Enter Url" />
                      <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-url' : 'error-url' }}"></div>
            </div>
            <div class="col-md-12 mb-3">
                <x-input-toggle-block name="status" label="Status" :checked="($socialLink->status ?? 0) == 1" />
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
