<form id="{{ $editMode ? 'updateContactForm' : 'contactForm' }}"
    action="{{ $editMode ? route('admin.contact.update', $contact->id) : route('admin.contact.store') }}" method="POST"
    enctype="multipart/form-data">

    @csrf
    @if ($editMode)
        @method('PUT')
    @endif
    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Contact' : 'Add Contact' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <label for="form-label">Icon</label>
        <div class="mb-3">
            @if($editMode)
            <x-image-preview src="{{ asset($contact->icon) }}" />
                @endif
            <input type="file" class="form-control" name="icon" placeholder="">
            <input type="hidden" name="old_icon" value="{{ $contact->icon ?? '' }}">
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-icon' : 'error-icon' }}"></div>
        </div>
        <div class="mb-3">
            <label for="form-label">Title</label>
            <input type="text" class="form-control" name="title" placeholder=""
                value="{{ $contact->title ?? '' }}">
           <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-title' : 'error-title' }}"></div>
        </div>
        <div class="mb-3">
            <label for="form-label">Line One</label>
            <input type="text" class="form-control" name="line_one" placeholder=""
                value="{{ $contact->line_one ?? '' }}">
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-line_one' : 'error-line_one' }}"></div>
        </div>
        <div class="mb-3">
            <label for="form-label">Line Two</label>
            <input type="text" class="form-control" name="line_two" placeholder=""
                value="{{ $contact->line_two ?? '' }}">
          <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-line_two' : 'error-line_two' }}"></div>
        </div>
        <div class="mb-3">
          <x-input-toggle-block name="status" label="Status" :checked="($contact->status ?? 0) == 1" />
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
