<form id="{{ $editMode ? 'updateCourseLang' : 'addCourseLang' }}"
      action="{{ $editMode ? route('admin.course-languages.update', $course_language->id) : route('admin.course-languages.store') }}"
      method="POST">

    @csrf
    @if($editMode)
        @method('PUT')
    @endif

    <div class="modal-header">
        <h5 class="modal-title">{{ $editMode ? 'Edit Language' : 'Add Language' }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <x-input-block name="name" :value="$course_language->name ?? ''" placeholder="Enter language name" />
            <div class="text-danger mt-1" id="{{ $editMode ? 'error-update-name' : 'error-name' }}"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">
            {{ $editMode ? 'Update' : 'Create' }}
        </button>
    </div>
</form>
